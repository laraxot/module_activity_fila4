<?php

declare(strict_types=1);

namespace Modules\Activity\Actions;

use Illuminate\Database\Eloquent\Model;
use Modules\Activity\Models\Activity;
use Modules\Xot\Datas\XotData;
use Spatie\QueueableAction\QueueableAction;

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
        public ?Model $user = null,
        public ?Model $subject = null,
        public ?array $properties = null,
        public ?string $description = null,
    ) {
        if ($type === '') {
            throw new \InvalidArgumentException('Type cannot be empty');
        }
        if ($user !== null) {
            // Type already narrowed to Model|null, assertion not needed
        }
    }

    public function execute(): Activity
    {
        $userClass = XotData::make()->getUserClass();

        $causerId = null;
        if ($this->user !== null) {
            if (! is_object($this->user)) {
                throw new \InvalidArgumentException('User must be an object');
            }
            // Type narrowing for user ID - use getAttribute for Eloquent models
            /** @var int|string $causerId */
            $causerId = $this->user->getAttribute('id');
        }
        if ($causerId === null) {
            $causerId = auth()->id();
        }

        $activityClass = Activity::class;

        return $activityClass::create([
            'log_name' => $this->type,
            'description' => $this->description ?? sprintf('Activity: %s', $this->type),
            'subject_type' => $this->subject ? get_class($this->subject) : null,
            'subject_id' => $this->subject?->getKey(),
            'causer_type' => $this->user ? $userClass : null,
            'causer_id' => $causerId,
            'properties' => $this->properties,
            'event' => $this->type,
        ]);
    }
}
