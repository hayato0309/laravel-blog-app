<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\User;

class Inquiry extends Model
{
    protected $fillable = [
        'user_id', 'title', 'content', 'inquiry_image',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
