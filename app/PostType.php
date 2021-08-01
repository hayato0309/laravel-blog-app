<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PostType extends Model
{
    protected $fillable = [
        'name', 'slug'
    ];

    public function posts()
    {
        return $this->hasMany(PostType::class);
    }
}
