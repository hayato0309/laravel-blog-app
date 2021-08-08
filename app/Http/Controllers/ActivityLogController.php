<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\User;

class ActivityLogController extends Controller
{
    public function index()
    {
        // Get data from notification table only for the user has the post.
        $activity_logs = DB::table('notifications')
            ->join('posts', 'notifications.notifiable_id', '=', 'posts.id')
            ->where('notifications.notifiable_type', 'App\Post')
            ->where('posts.user_id', Auth()->user()->id)
            ->get();

        foreach ($activity_logs as $activity_log) {
            $activity_log->data = json_decode(($activity_log->data));
        }

        return view('activity_logs.index', compact('activity_logs'));
    }
}
