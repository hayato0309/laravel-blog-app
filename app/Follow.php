<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\User;

class Follow extends Model
{
    protected $fillable = [
        'following_id', 'follower_id'
    ];

    public function users()
    {
        return $this->belongsToMany(User::class);
    }

    public function followingExists($following_id, $follower_id)
    {
        $existingFollow = Follow::where('following_id', '=', $following_id)->where('follower_id', '=', $follower_id)->get();

        if ($existingFollow->isNotEmpty()) {
            return true;
        } else {
            return false;
        }
    }
}
