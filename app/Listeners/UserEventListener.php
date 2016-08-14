<?php

namespace App\Listeners;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Auth\Events\Login;
use Illuminate\Auth\Events\Failed;

class UserEventListener
{
    protected $request;

    public function __construct(Request $request)
    {
        $this->request = $request;
    }
    /**
     * Handle user login events.
     */
    public function onUserLoginAttempt($event)
    {
        if (! is_null($event->user)) {
            $this->attemptLogin($event->user, get_class($event));

            //
        }
    }

    /**
     * @param  \App\User  $user
     * @param  string     $eventType
     * @return void
     */
    protected function attemptLogin($user, $eventType)
    {
        switch ($eventType) {
            case Login::class:
                $user->increment('sign_in_count');

                $user->last_sign_in_at = $user->current_sign_in_at;
                $user->last_sign_in_ip = $user->current_sign_in_ip;

                $user->current_sign_in_at = Carbon::now();
                $user->current_sign_in_ip = $this->request->ip();

                $user->save();
                break;

            case Failed::class:
                $user->increment('failed_attempts');
                break;
        }
    }

    /**
     * Register the listeners for the subscriber.
     *
     * @param  Illuminate\Events\Dispatcher  $events
     */
    public function subscribe($events)
    {
        $events->listen(
            [Login::class, Failed::class],
            'App\Listeners\UserEventListener@onUserLoginAttempt'
        );
    }
}
