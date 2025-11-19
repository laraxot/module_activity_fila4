<?php

declare(strict_types=1);

namespace Modules\Activity\Actions;

use Modules\Xot\Datas\XotData;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Log;
use Modules\Activity\Models\Activity;
use Modules\User\Models\User;
use Spatie\QueueableAction\QueueableAction;
use Webmozart\Assert\Assert;

/**
 * Activity Logger Action.
 *
 * Logs user activities and system events using Queueable Actions
 */
class ActivityLogger
{
    use QueueableAction;

    /**
     * Log activity.
     */
    public function log(
        string $type,
        mixed $user = null,
        ?Model $subject = null,
        ?array $properties = null,
        ?string $description = null,
    ): Activity {
        $userId = null;
        if ($user !== null) {
            // Use XotData to get the user class for type checking
            $userClass = XotData::make()->getUserClass();
            Assert::isInstanceOf($user, $userClass);

            // Type narrowing for user ID - use getAttribute for Eloquent models
            $userId = $user->getAttribute('id');
        } else {
            $userId = auth()->id();
        }

        $activity = Activity::create([
            'type' => $type,
            'user_id' => $userId,
            'subject_type' => $subject ? $subject::class : null,
            'subject_id' => $subject?->getKey(),
            'properties' => $properties,
            'description' => $description,
            'ip_address' => request()->ip(),
            'user_agent' => request()->userAgent(),
        ]);

        Log::info('Activity logged', [
            'activity_id' => $activity->id,
            'type' => $type,
        ]);

        return $activity;
    }

    /**
     * Log created event.
     */
    public function created(Model $model, ?User $user = null): Activity
    {
        $action = new LogModelCreatedAction($model, $user);

        return $action->execute();
    }

    /**
     * Log updated event.
     */
    public function updated(Model $model, ?User $user = null): Activity
    {
        $action = new LogModelUpdatedAction($model, $user);

        return $action->execute();
    }

    /**
     * Log deleted event.
     */
    public function deleted(Model $model, ?User $user = null): Activity
    {
        $action = new LogModelDeletedAction($model, $user);

        return $action->execute();
    }

    /**
     * Log login event.
     */
    public function login(User $user): Activity
    {
        $action = new LogUserLoginAction($user);

        return $action->execute();
    }

    /**
     * Log logout event.
     */
    public function logout(User $user): Activity
    {
        $action = new LogUserLogoutAction($user);

        return $action->execute();
    }

    /**
     * Log custom event.
     */
    public function custom(
        string $type,
        string $description,
        ?Model $subject = null,
        ?array $properties = null,
    ): Activity {
        return $this->log($type, null, $subject, $properties, $description);
    }

    /**
     * Get activities for user.
     */
    public function getUserActivities(User $user, int $limit = 50): Collection
    {
        Assert::positiveInteger($limit, 'Limit must be positive');

        return Activity::with('subject')
            ->where('causer_id', $user->id)
            ->where('causer_type', User::class)
            ->latest()
            ->limit($limit)
            ->get();
    }

    /**
     * Get activities for model.
     */
    public function getModelActivities(Model $model, int $limit = 50): Collection
    {
        return Activity::with('causer')
            ->where('subject_type', $model::class)
            ->where('subject_id', $model->getKey())
            ->latest()
            ->limit($limit)
            ->get();
    }

    /**
     * Get activities by type.
     */
    public function getByType(string $type, int $limit = 50): Collection
    {
        Assert::stringNotEmpty($type, 'Type cannot be empty');
        Assert::positiveInteger($limit, 'Limit must be positive');

        return Activity::with(['causer', 'subject'])
            ->where('description', 'like', '%'.$type.'%')
            ->latest()
            ->limit($limit)
            ->get();
    }

    /**
     * Get recent activities.
     */
    public function getRecent(int $limit = 50): Collection
    {
        return Activity::with(['causer', 'subject'])
            ->latest()
            ->limit($limit)
            ->get();
    }

    /**
     * Clean old activities.
     */
    public function cleanOld(int $days = 90): int
    {
        $deleted = (int) Activity::where('created_at', '<', now()->subDays($days))
            ->delete();

        Log::info('Old activities cleaned', [
            'deleted_count' => $deleted,
            'older_than_days' => $days,
        ]);

        return $deleted;
    }

    /**
     * Get activity statistics.
     */
    public function getStatistics(?User $user = null): array
    {
        $query = Activity::query();

        if ($user) {
            $query->where('user_id', $user->id);
        }

        return [
            'total' => $query->count(),
            'by_type' => $query->clone()
                ->selectRaw('type, COUNT(*) as count')
                ->groupBy('type')
                ->pluck('count', 'type')
                ->toArray(),
            'today' => $query->clone()
                ->whereDate('created_at', today())
                ->count(),
            'this_week' => $query->clone()
                ->whereBetween('created_at', [now()->startOfWeek(), now()->endOfWeek()])
                ->count(),
            'this_month' => $query->clone()
                ->whereMonth('created_at', now()->month)
                ->whereYear('created_at', now()->year)
                ->count(),
        ];
    }
}
