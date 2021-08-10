<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Post;
use App\User;

class NotificationController extends Controller
{
    public function index()
    {
        // notifiable_idが自分のIDのnotificationを全部取得
        $notifications = auth()->user()->notifications;

        // Activity Logのコレクションをforeachで追加するための空コレクション
        $notifications_for_auth = collect();

        // Activity Log配列を作成するためのキーを定義
        $key_for_notifications_collection = 0;

        foreach ($notifications as $notification) {
            // ログインユーザIDとNotificationテーブルにデータを発行したPostのUser IDが異なる時（Notificationsに格納されているデータが他のユーザの物の時）だけ、
            // Activity Logとして取得
            if (auth()->user()->id !== $notification->data['user_id']) {

                // User name追加済みのNotificationコレクションを notification_for_authコレクションに追加
                $notifications_for_auth = $notifications_for_auth->concat(collect([$key_for_notifications_collection => $notification]));
                
                $key_for_notifications_collection += 1;
            }
        }

        return view('notifications.index', compact('notifications_for_auth'));
    }
}
