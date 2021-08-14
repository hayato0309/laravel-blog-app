<?php

namespace App\Listeners;

use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use App\Events\UserRegisteredEvent;
use Illuminate\Support\Facades\Notification;
use App\Notifications\UserRegisteredNotification;
use App\Role;

class UserRegisteredListener
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
    public function handle(UserRegisteredEvent $event)
    {
        $user = $event->user;

        $admin_role = Role::find(1); // Admin roleを取得
        $admin_users = $admin_role->users()->get(); // Adminを持つUserを取得

        Notification::send($admin_users, new UserRegisteredNotification($user));
    }
}
