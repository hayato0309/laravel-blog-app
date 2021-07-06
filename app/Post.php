<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\User;

class Post extends Model
{
    protected $fillable = [
        'user_id', 'title', 'content', 'post_image'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
