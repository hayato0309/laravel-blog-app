<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Post;
use App\Role;
use App\Inquiry;
use Illuminate\Support\Facades\DB;

class AdminController extends Controller
{
    public function index()
    {
        $num_of_total_users = User::all()->count();
        $num_of_total_posts = Post::all()->count();

        $periods = [1, 7, 31, 365]; // User数、Post数を調べる期間を入れた配列

        $num_of_posts_per_period = []; // 期間ごとの連想配列を作るようの空配列
        $num_of_users_per_period = []; // 期間ごとの連想配列を作るようの空配列

        foreach ($periods as $period) {
            $start_date = date('Y-m-d', strtotime('-' . ($period - 1) . ' day')); // 計測を開始する日付。periods配列の数字をそのまま使うと1日分多いのでマイナス1している
            
            $num_of_users = User::where('created_at', '>=', $start_date)->count();
            $num_of_users_per_period[$period] = $num_of_users;

            $num_of_posts = Post::where('created_at', '>=', $start_date)->count();
            $num_of_posts_per_period[$period] = $num_of_posts;
        }

        return view('admin.index', compact('num_of_total_users', 'num_of_total_posts', 'num_of_users_per_period', 'num_of_posts_per_period'));
    }


    // About notifications
    public function showNotifications()
    {
        // Authユーザに紐づいている全てのNotificationを取得
        $notifications = auth()->user()->notifications;

        // 整えたNotificationデータを格納する空配列を用意
        // 未読用
        $unread_notifications = [];
        // 既読用
        $read_notifications = [];

        foreach ($notifications as $notification) {
            if (empty($notification->read_at)) {
                // 未読用
                switch ($notification->type) {

                        // PostPostedNotificationの配列データ用意
                    case 'App\Notifications\UserRegisteredNotification':
                        $user_name = DB::table('users')->where('id', $notification->data['user_id'])->value('name');
                        $email = DB::table('users')->where('id', $notification->data['user_id'])->value('email');

                        array_push($unread_notifications, [
                            'type' => 'App\Notifications\UserRegisteredNotification',
                            'user_id' => $notification->data['user_id'],
                            'user_name' => $user_name,
                            'email' => $email,
                            'created_at' => $notification->created_at
                        ]);
                        break;
                }
            } else {
                // 既読用
                switch ($notification->type) {

                        // PostPostedNotificationの配列データ用意
                    case 'App\Notifications\UserRegisteredNotification':
                        $user_name = DB::table('users')->where('id', $notification->data['user_id'])->value('name');
                        $email = DB::table('users')->where('id', $notification->data['user_id'])->value('email');

                        array_push($read_notifications, [
                            'type' => 'App\Notifications\UserRegisteredNotification',
                            'user_id' => $notification->data['user_id'],
                            'user_name' => $user_name,
                            'email' => $email,
                            'created_at' => $notification->created_at
                        ]);

                        break;
                }
            }
        }

        // 未読Notificationsを"既読"にする
        auth()->user()->unreadNotifications
            ->where('type', 'App\Notifications\UserRegisteredNotification')
            ->markAsRead();

        return view('admin.notifications.index', compact('unread_notifications', 'read_notifications'));
    }


    // About inquiries
    public function showInquiries(Request $request)
    {
        $inquiry_filter = $request->inquiry_filter;

        // Inquiryのフィルタリング
        if ($inquiry_filter === 'solved') {
            // 解決したinquiryを取得
            $inquiries = Inquiry::where('is_solved', 1)->orderBy('created_at', 'desc')->paginate(10);
        } elseif ($inquiry_filter === 'unsolved') {
            // 未解決のinquiryを取得
            $inquiries = Inquiry::where('is_solved', 0)->orderBy('created_at', 'desc')->paginate(10);
        } else {
            // 全てのinquiryを取得（inquiry_filterがNULLの時。inquiryページ訪問時はこれ）
            $inquiries = Inquiry::orderBy('created_at', 'desc')->paginate(10);
        }

        return view('admin.inquiries.index', compact('inquiries', 'inquiry_filter'));
    }

    public function solveInquiry($id)
    {
        $inquiry = Inquiry::findOrFail($id);
        $inquiry->is_solved = 1;

        $inquiry->update();

        session()->flash('inquiry-status-solved-message', 'The status of the inquiry was changed to "solved" sccessfully. : ' . $inquiry->title);

        return back();
    }

    public function unsolveInquiry($id)
    {
        $inquiry = Inquiry::findOrFail($id);
        $inquiry->is_solved = 0;

        $inquiry->update();

        session()->flash('inquiry-status-unsolved-message', 'The status of the inquiry was changed to "unsolved" sccessfully. : ' . $inquiry->title);

        return back();
    }


    // About users
    public function showUsers()
    {
        $users = User::withTrashed()->orderBy('name', 'asc')->paginate(10);

        $roles = Role::all();

        $role = new Role();

        foreach ($users as $user) {
            // Getting role ID for iterated users
            $current_role_ids = array_column($role->getRoleIdsForUser($user)->toArray(), 'id');
            // Assigning the role ID array to iterated users
            $user->current_role_ids = $current_role_ids;
        }

        return view('admin.users.index', compact('users', 'roles'));
    }

    public function updateRoles(Request $request, $id)
    {
        $user = User::findOrFail($id);
        $user->roles()->sync($request['roles']);

        return back();
    }

    public function activateUser($id)
    {
        $user = User::onlyTrashed()->findOrFail($id);
        $user->restore();

        session()->flash('user-activated-message', 'User was activated successfully. : ' . $user->name);

        return back();
    }

    public function deactivateUser($id)
    {
        $user = User::findOrFail($id);
        $user->delete();

        session()->flash('user-deactivated-message', 'User was deactivated successfully. : ' . $user->name);

        return back();
    }


    // About posts
    public function showPosts()
    {
        $posts = Post::withTrashed()->orderBy('created_at', 'desc')->paginate(10);

        return view('admin.posts.index', compact('posts'));
    }

    public function unhidePost($id)
    {
        $post = Post::onlyTrashed()->findOrFail($id);
        $post->restore();

        session()->flash('post-unhidden-message', 'User was unhidden successfully. : ' . $post->title);

        return back();
    }

    public function hidePost($id)
    {
        $post = Post::findOrFail($id);
        $post->delete();

        session()->flash('post-hidden-message', 'Post was hidden successfully. : ' . $post->title);

        return back();
    }
}
