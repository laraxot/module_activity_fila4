<?php

declare(strict_types=1);

namespace Modules\Activity\Actions;

use Illuminate\Database\Eloquent\Model;
use Modules\Activity\Models\Activity;
use Modules\Xot\Datas\XotData;
use Spatie\QueueableAction\QueueableAction;
use Webmozart\Assert\Assert;

/**
 * Log Model Updated Action.
 *
 * Logs when a model is updated using Queueable Actions
 */
class LogModelUpdatedAction
{
    use QueueableAction;

    public function __construct(
        public Model $model,
        public mixed $user = null,
    ) {
        if ($user !== null) {
            $userClass = XotData::make()->getUserClass();
            Assert::isInstanceOf($user, $userClass);
        }
    }

    public function execute(): Activity
    {
        $action = new LogActivityAction(
            type: 'updated',
            user: $this->user,
            subject: $this->model,
            properties: [
                'old' => $this->model->getOriginal(),
                'new' => $this->model->getAttributes(),
                'changes' => $this->model->getChanges(),
            ],
            description: sprintf('%s updated', class_basename($this->model))
        );

        return $action->execute();
    }
}
