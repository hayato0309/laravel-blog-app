<?php

namespace App\Http\Composers;

use Illuminate\View\View;

class AdminSidebarComposer
{
    public function compose(View $view)
    {
        $num_of_unread_notifications_for_admin = auth()->user()->unreadNotifications()
            ->where('type', 'App\Notifications\UserRegisteredNotification')
            ->count();

        $view->with('num_of_unread_notifications_for_admin', $num_of_unread_notifications_for_admin);
    }
}
