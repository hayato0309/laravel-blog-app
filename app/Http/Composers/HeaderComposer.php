<?php

namespace App\Http\Composers;

use Illuminate\View\View;

class HeaderComposer
{
    public function compose(View $view)
    {
        $num_of_unread_notifications = auth()->user()->unreadNotifications()->count();

        $view->with('num_of_unread_notifications', $num_of_unread_notifications);
    }
}
