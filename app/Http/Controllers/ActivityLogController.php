<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Post;

class ActivityLogController extends Controller
{
    public function index()
    {
        // notifiable_idが自分のIDのnotificationを全部取得
        $activity_logs = auth()->user()->notifications;

        // Activity Logのコレクションをforeachで追加するための空コレクション
        $activity_logs_for_auth = collect();

        // Activity Log配列を作成するためのキーを定義
        $key_for_activity_logs_collection = 0;

        foreach ($activity_logs as $activity_log) {
            // ログインユーザIDとNotificationテーブルにデータを発行したPostのUser IDが同じ時だけ、Activity Logとして取得

            if (auth()->user()->id === $activity_log->data['user_id']) {
                $activity_logs_for_auth = $activity_logs_for_auth->concat(collect([$key_for_activity_logs_collection => $activity_log]));
                $key_for_activity_logs_collection += 1;
            }
        }

        return view('activity_logs.index', compact('activity_logs_for_auth'));
    }
}
