<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;


class NotificationController extends Controller
{
    public function index()
    {
        // Authユーザに紐づいている全てのNotificationを取得
        $notifications = auth()->user()->notifications;

        // 整えたNotificationデータを格納する空配列を用意
        // 未読用
        $unread_notifications = [];
        // 既読用
        $read_notifications = [];

        // 上で作った空配列にデータを入れていく
        foreach ($notifications as $notification) {
            // 未読用
            if (empty($notification->read_at)) {
                switch ($notification->type) {

                        // PostPostedNotificationの配列データ用意
                    case 'App\Notifications\PostPostedNotification':
                        $user_name = DB::table('users')->where('id', $notification->data['user_id'])->value('name');
                        $post_title = DB::table('posts')->where('id', $notification->data['post_id'])->value('title');

                        $post_type_id = DB::table('posts')->where('id', $notification->data['post_id'])->value('post_type_id');
                        $post_type = DB::table('post_types')->where('id', $post_type_id)->value('name');

                        array_push($unread_notifications, [
                            'type' => 'App\Notifications\PostPostedNotification',
                            'user_id' => $notification->data['user_id'],
                            'user_name' => $user_name,
                            'post_id' => $notification->data['post_id'],
                            'post_title' => $post_title,
                            'post_type' => $post_type,
                            'created_at' => $notification->created_at
                        ]);

                        break;

                        // UserFollowedNotificationの配列データ用意
                    case 'App\Notifications\UserFollowedNotification':
                        $user_name = DB::table('users')->where('id', $notification->data['user_id'])->value('name');

                        array_push($unread_notifications, [
                            'type' => 'App\Notifications\UserFollowedNotification',
                            'user_id' => $notification->data['user_id'],
                            'user_name' => $user_name,
                            'created_at' => $notification->created_at
                        ]);

                        break;

                        // EnsembleCreatedNotificationの配列データ用意
                    case 'App\Notifications\EnsembleCreatedNotification':
                        $user_name = DB::table('users')->where('id', $notification->data['user_id'])->value('name');
                        $ensemble_headline = DB::table('ensembles')->where('id', $notification->data['ensemble_id'])->value('headline');

                        array_push($unread_notifications, [
                            'type' => 'App\Notifications\EnsembleCreatedNotification',
                            'user_id' => $notification->data['user_id'],
                            'user_name' => $user_name,
                            'ensemble_id' => $notification->data['ensemble_id'],
                            'ensemble_headline' => $ensemble_headline,
                            'created_at' => $notification->created_at
                        ]);

                        break;
                }
            } else {
                switch ($notification->type) {

                        // PostPostedNotificationの配列データ用意
                    case 'App\Notifications\PostPostedNotification':
                        $user_name = DB::table('users')->where('id', $notification->data['user_id'])->value('name');
                        $post_title = DB::table('posts')->where('id', $notification->data['post_id'])->value('title');

                        $post_type_id = DB::table('posts')->where('id', $notification->data['post_id'])->value('post_type_id');
                        $post_type = DB::table('post_types')->where('id', $post_type_id)->value('name');

                        array_push($read_notifications, [
                            'type' => 'App\Notifications\PostPostedNotification',
                            'user_id' => $notification->data['user_id'],
                            'user_name' => $user_name,
                            'post_id' => $notification->data['post_id'],
                            'post_title' => $post_title,
                            'post_type' => $post_type,
                            'created_at' => $notification->created_at
                        ]);

                        break;

                        // UserFollowedNotificationの配列データ用意
                    case 'App\Notifications\UserFollowedNotification':
                        $user_name = DB::table('users')->where('id', $notification->data['user_id'])->value('name');

                        array_push($read_notifications, [
                            'type' => 'App\Notifications\UserFollowedNotification',
                            'user_id' => $notification->data['user_id'],
                            'user_name' => $user_name,
                            'created_at' => $notification->created_at
                        ]);

                        break;

                        // EnsembleCreatedNotificationの配列データ用意
                    case 'App\Notifications\EnsembleCreatedNotification':
                        $user_name = DB::table('users')->where('id', $notification->data['user_id'])->value('name');
                        $ensemble_headline = DB::table('ensembles')->where('id', $notification->data['ensemble_id'])->value('headline');

                        array_push($read_notifications, [
                            'type' => 'App\Notifications\EnsembleCreatedNotification',
                            'user_id' => $notification->data['user_id'],
                            'user_name' => $user_name,
                            'ensemble_id' => $notification->data['ensemble_id'],
                            'ensemble_headline' => $ensemble_headline,
                            'created_at' => $notification->created_at
                        ]);

                        break;
                }
            }
        }

        // 全ての未読Notificationデータを "既読" にする（UserRegisterNotification以外）
        auth()->user()->unreadNotifications
            ->where('type', '<>', 'App\Notifications\UserRegisteredNotification')
            ->markAsRead();

        return view('notifications.index', compact('unread_notifications', 'read_notifications'));
    }
}
