<?php

declare(strict_types=1);

namespace Modules\Activity\Actions;

use Illuminate\Database\Eloquent\Model;
use Modules\Activity\Models\Activity;
use Modules\User\Models\User;
use Spatie\QueueableAction\QueueableAction;
use Webmozart\Assert\Assert;

/**
 * Log Activity Action.
 *
 * Logs a single activity using Queueable Actions
 */
class LogActivityAction
{
    use QueueableAction;

    public function __construct(
        public string $type,
        public ?User $user = null,
        public ?Model $subject = null,
        public ?array $properties = null,
        public ?string $description = null,
    ) {
        Assert::stringNotEmpty($type, 'Type cannot be empty');
    }

    public function execute(): Activity
    {
        $activity = Activity::create([
            'log_name' => $this->type,
            'description' => $this->description ?? sprintf('Activity: %s', $this->type),
            'subject_type' => $this->subject ? get_class($this->subject) : null,
            'subject_id' => $this->subject?->getKey(),
            'causer_type' => $this->user ? User::class : null,
            'causer_id' => $this->user->id ?? auth()->id(),
            'properties' => $this->properties,
            'event' => $this->type,
        ]);

        return $activity;
    }
}

