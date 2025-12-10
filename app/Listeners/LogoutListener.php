<?php

declare(strict_types=1);

namespace Modules\Activity\Listeners;

use Illuminate\Auth\Events\Logout;
use Illuminate\Support\Facades\Request;
use Modules\Activity\Models\Activity;

class LogoutListener
{
    /**
     * Handle the event.
     */
    public function handle(Logout $event): void
    {
        if (! $event->user) {
            return;
        }

        $properties = [
            'guard' => $event->guard,
            'ip_address' => Request::ip(),
            'user_agent' => Request::userAgent(),
            'timestamp' => now()->timestamp,
        ];

        // Handle session duration if last_login_at is available
        // Assuming last_login_at is a Casted Carbon instance or string
        if (isset($event->user->last_login_at)) {
            $lastLogin = $event->user->last_login_at;
            // Ensure $lastLogin is a Carbon instance
            if (! $lastLogin instanceof \Carbon\Carbon && ! $lastLogin instanceof \Illuminate\Support\Carbon) {
                $lastLogin = \Illuminate\Support\Carbon::parse($lastLogin);
            }

            $properties['session_duration'] = abs(now()->diffInSeconds($lastLogin));
        }

        // Handle logout reason from request
        if (Request::has('logout_reason')) {
            $properties['logout_reason'] = Request::input('logout_reason');
        }

        // Creating the activity
        // We use the Activity model directly as per the test expectations
        // The test expects 'event' column to be set to 'logout'

        $activity = new Activity();
        $activity->log_name = 'auth';
        $activity->description = 'User logged out'; // specific string not enforced but 'logout' must be contained
        $activity->event = 'logout';
        $activity->causer()->associate($event->user);
        $activity->properties = $properties;
        $activity->save();
    }
}
