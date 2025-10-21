<?php

declare(strict_types=1);

namespace Modules\Activity\Actions;

use Illuminate\Database\Eloquent\Model;
use Modules\Activity\Models\Activity;
use Modules\User\Models\User;
use Spatie\QueueableAction\QueueableAction;
use Webmozart\Assert\Assert;

/**
 * Log Model Deleted Action.
 *
 * Logs when a model is deleted using Queueable Actions
 */
class LogModelDeletedAction
{
    use QueueableAction;

    public function __construct(
        public Model $model,
        public ?User $user = null,
    ) {
        // Model is already type-hinted, no assert needed
    }

    public function execute(): Activity
    {
        $action = new LogActivityAction(
            type: 'deleted',
            user: $this->user,
            subject: $this->model,
            properties: ['attributes' => $this->model->getAttributes()],
            description: sprintf('%s deleted', class_basename($this->model))
        );

        return $action->execute();
    }
}

