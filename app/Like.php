<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\User;
use App\Post;

class Like extends Model
{
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function post()
    {
        return $this->belongsTo(Post::class);
    }

    public function likeExists($user_id, $post_id)
    {
        $existingLike = Like::where('user_id', '=', $user_id)->where('post_id', '=', $post_id)->get();

        if ($existingLike->isNotEmpty()) {
            return true;
        } else {
            return false;
        }
    }
}
