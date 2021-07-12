<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\User;

class Follow extends Model
{
    protected $fillable = [
        'following_id', 'followed-id'
    ];

    public function users()
    {
        return $this->belongsToMany(User::class);
    }

    public function followingExists($following_user_id, $followed_user_id)
    {
        $existingFollow = Follow::where('following_id', '=', $following_user_id)->where('followed_id', '=', $followed_user_id)->get();

        if ($existingFollow->isNotEmpty()) {
            return true;
        } else {
            return false;
        }
    }
}
