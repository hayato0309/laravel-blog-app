<?php

namespace App\Listeners;

use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use App\Events\UserFollowedEvent;
use Illuminate\Support\Facades\Notification;
use App\Notifications\UserFollowedNotification;

class UserFollowedListener
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  object  $event
     * @return void
     */
    public function handle(UserFollowedEvent $event)
    {
        $followed_user = $event->user;
        $following_user = auth()->user();

        Notification::send($followed_user, new UserFollowedNotification($following_user));
    }
}
