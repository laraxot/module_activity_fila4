<?php

declare(strict_types=1);

namespace Modules\Activity\Actions;

use Illuminate\Database\Eloquent\Model;
use Modules\Activity\Models\Activity;
use Modules\User\Models\User;
use Spatie\QueueableAction\QueueableAction;
use Webmozart\Assert\Assert;

/**
 * Log Model Created Action.
 *
 * Logs when a model is created using Queueable Actions
 */
class LogModelCreatedAction
{
    use QueueableAction;

    public function __construct(
        public Model $model,
        public ?User $user = null,
    ) {
        Assert::isInstanceOf($model, Model::class);
    }

    public function execute(): Activity
    {
        $action = new LogActivityAction(
            type: 'created',
            user: $this->user,
            subject: $this->model,
            properties: ['attributes' => $this->model->getAttributes()],
            description: sprintf('%s created', class_basename($this->model))
        );

        return $action->execute();
    }
}

