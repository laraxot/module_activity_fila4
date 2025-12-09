<?php

declare(strict_types=1);

namespace Modules\Activity\Actions;

use Illuminate\Database\Eloquent\Model;
use Modules\Activity\Models\Activity;
use Modules\Xot\Contracts\UserContract;
use Modules\Xot\Datas\XotData;
use Spatie\QueueableAction\QueueableAction;

/**
 * Log User Login Action
 *
 * Logs when a user logs in using Queueable Actions
 */
class LogUserLoginAction
{
    use QueueableAction;

    public function __construct(
        public mixed $user
    ) {
        $userClass = XotData::make()->getUserClass();
        if (! $user instanceof $userClass) {
            throw new \InvalidArgumentException('User must be an instance of '.$userClass);
        }
    }

    public function execute(): Activity
    {
        // Cast user to Model for type safety
        $userClass = XotData::make()->getUserClass();
        if (! $this->user instanceof $userClass) {
            throw new \InvalidArgumentException('User must be an instance of '.$userClass);
        }

        /** @var Model&UserContract $userModel */
        $userModel = $this->user;

        $action = new LogActivityAction(
            type: 'login',
            user: $this->user,
            subject: $userModel,
            description: 'User logged in'
        );

        return $action->execute();
    }
}
