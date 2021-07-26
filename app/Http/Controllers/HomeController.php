<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use App\Post;
use App\User;
use App\Like;
use App\Category;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index(Request $request)
    {
        $category = new Category();
        $categories = $category->getAllCategories();

        $posts = Post::orderBy('created_at', 'desc')->simplePaginate(5);

        foreach ($posts as $post) {
            $post['likesCount'] = $post->loadCount('likes')->likes_count;

            $like = new Like();
            $user_id = Auth::user()->id;
            $post_id = $post->id;
            if ($like->likeExists($user_id, $post_id)) {
                $post['isLiked'] = true;
            } else {
                $post['isLiked'] = false;
            }
        }

        // Get search keyword
        $category_search = $request->input('category_search');
        // Create query instance
        $query = Category::query();

        // If there is a category search keywaord...
        if (!empty($category_search)) {
            $query->where('slug', 'like', '%' . $category_search . '%');
            $categories = $query->get();
        }

        return view('home', compact('category_search', 'categories', 'posts'));
    }
}
