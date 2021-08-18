<?php

namespace App\Http\Composers;

use Illuminate\View\View;
use App\Inquiry;

class AdminSidebarComposer
{
    public function compose(View $view)
    {
        // 未読のUserRegisterNotificationsをカウント
        $num_of_unread_notifications_for_admin = auth()->user()->unreadNotifications()
            ->where('type', 'App\Notifications\UserRegisteredNotification')
            ->count();

        // 未解決のinquiriesをカウント
        $num_of_unsolved_inquiries = Inquiry::where('is_solved', 0)->count();

        $view->with('num_of_unread_notifications_for_admin', $num_of_unread_notifications_for_admin)
            ->with('num_of_unsolved_inquiries', $num_of_unsolved_inquiries);
    }
}
