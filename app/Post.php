<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\User;
use App\Comment;
use App\Like;
use App\Ensemble;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Notifications\Notifiable;

class Post extends Model
{
    use SoftDeletes;
    use Notifiable;

    protected $dates = ['deleted_at'];

    protected $guarded = [];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function comments()
    {
        return $this->morphMany(Comment::class, 'commentable')->whereNull('parent_id');
    }

    public function likes()
    {
        return $this->hasMany(Like::class);
    }

    public function categories()
    {
        return $this->belongsToMany(Category::class);
    }

    public function postType()
    {
        return $this->belongsTo(PostType::class);
    }

    public function ensembles()
    {
        return $this->belongsToMany(Ensemble::class);
    }


    public static function countLikes($post)
    {
        $post['likesCount'] = $post->likes()->count();

        return $post;
    }


    public static function likeExists($post, $user)
    {
        $existingLike = Like::where('post_id', '=', $post->id)->where('user_id', '=', $user->id)->get();

        if ($existingLike->isNotEmpty()) {
            $post['isLiked'] = true;
        } else {
            $post['isLiked'] = false;
        }

        return $post;
    }
}
