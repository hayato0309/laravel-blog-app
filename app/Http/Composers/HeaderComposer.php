<?php

namespace App\Http\Composers;

use Illuminate\View\View;

class HeaderComposer
{
    public function compose(View $view)
    {
        if (auth()->user()) {
            $num_of_unread_notifications = auth()->user()->unreadNotifications()
                ->where('type', '<>', 'App\Notifications\UserRegisteredNotification') // UserRegisterNotificationはAdminだけが確認するので、ここには含めない
                ->count();

            $view->with('num_of_unread_notifications', $num_of_unread_notifications);
        }
    }
}
