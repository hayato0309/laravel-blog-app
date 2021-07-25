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

    public function getAllCategories()
    {
        $categories = $this->orderBy('name', 'asc')->get();

        return $categories;
    }

    public function getCategoriesForPost($post)
    {
        $categories = $post->categories->sortBy('name');

        return $categories;
    }
}
