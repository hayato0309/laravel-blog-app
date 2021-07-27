<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Post;

class Category extends Model
{
    protected $fillable = [
        'name', 'slug'
    ];

    public function posts()
    {
        return $this->belongsToMany(Post::class);
    }

    public function getCategoriesForPost($post)
    {
        $categories = $post->categories->sortBy('slug');

        return $categories;
    }
}
