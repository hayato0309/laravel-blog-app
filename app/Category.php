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

    public static function countForEachPostType($categories) // 各カテゴリに属するPostの中に、ArticleとQuestionが何件あるのか取得
    {
        $post_types = PostType::all();

        foreach ($categories as $category) {
            $count_for_each_post_type = [];

            foreach ($post_types as $post_type) {
                $num_of_posts = $category->posts->where('post_type_id', '=', $post_type->id)->count();
                array_push($count_for_each_post_type, ['name' => $post_type->name, 'num_of_posts' => $num_of_posts]);
            }

            $category->count_for_each_post_type = $count_for_each_post_type;
        }

        return $categories;
    }
}
