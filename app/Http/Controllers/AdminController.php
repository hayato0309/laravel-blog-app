<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Post;
use App\Role;
use App\Inquiry;
use Illuminate\Support\Facades\DB;
use App\Ensemble;
use Carbon\Carbon;

class AdminController extends Controller
{
    public function index()
    {
        $num_of_total_users = User::all()->count();
        $num_of_total_posts = Post::all()->count();

        $periods = [1, 7, 31, 365]; // User数、Post数を調べる期間を入れた配列

        foreach ($periods as $period) {
            $current_period_from = date('Y-m-d' . ' 00:00:00', strtotime('-' . ($period - 1) . ' day')); // 計測を開始する日付。periods配列の数字をそのまま使うと1日分多く引いてしまうのでさらにマイナス1している
            $previous_period_from = date('Y-m-d' . ' 00:00:00', strtotime('-' . ($period * 2 -1) . ' day')); // 古い期間の計測開始日
            $previous_period_until = date('Y-m-d' . ' 23:59:59', strtotime('-' . ($period) . ' day')); // 古い期間の計測終了日

            // 新しい期間と古い期間の新規User数の取得
            $num_of_users_current_period = User::where('created_at', '>=', $current_period_from)->count(); // 新しい（当）期間中の新規User数の取得
            $num_of_users_previous_period = User::whereBetween('created_at', [$previous_period_from, $previous_period_until])->count(); // 古い期間中の新規User数の取得
            
            // Userの増加率の計算
            if($num_of_users_previous_period === 0) {
                $users_increase_rate = "-";
            } else {
                $users_increase_rate = sprintf('%+.1f', round(($num_of_users_current_period / $num_of_users_previous_period - 1), 3) * 100);
            }

            $users_per_period[$period] = [$num_of_users_current_period, $users_increase_rate];

            // 新しい期間と古い期間の新規Post数の取得
            $num_of_posts_current_period = Post::where('created_at', '>=', $current_period_from)->count(); // 新しい（当）期間中の新規Post数の取得
            $num_of_posts_previous_period = Post::whereBetween('created_at', [$previous_period_from, $previous_period_until])->count(); // 古い期間中の新規Post数の取得
            
            // Postの増加率の計算
            if($num_of_posts_previous_period === 0) {
                $posts_increase_rate = "-";
            } else {
                $posts_increase_rate = sprintf('%+.1f', round(($num_of_posts_current_period / $num_of_posts_previous_period - 1), 3) * 100);
            }

            $posts_per_period[$period] = [$num_of_posts_current_period, $posts_increase_rate];
        }

        // Followerの多いUser Top5
        $popular_users_top5 = User::withCount('followers')->orderBy('followers_count', 'desc')->take(5)->get();

        // Postの多いUser Top5
        $contributors_top5 = User::withCount('posts')->orderBy('posts_count', 'desc')->take(5)->get();

        // Likeの多いPost Top5
        $popular_posts_top5 = Post::withCount('likes')->orderBy('likes_count', 'desc')->take(5)->get();

        // Applicationの多いEnsemble Top5
        $popular_ensembles_top5 = Ensemble::withCount('ensembleApplications')->orderBy('ensemble_applications_count', 'desc')->take(5)->get();

        return view('admin.index', compact('num_of_total_users', 'num_of_total_posts', 'users_per_period', 'posts_per_period', 'popular_users_top5', 'contributors_top5', 'popular_posts_top5', 'popular_ensembles_top5'));
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
