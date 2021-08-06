<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use App\Post;
use App\User;
use App\Like;
use App\Category;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\RequestException;
use GuzzleHttp\Psr7;
use App\PostType;

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
        $categories = Category::orderBy('slug', 'asc')->get();

        // Count articles and questions for the specific category
        $post_types = PostType::all();

        foreach ($categories as $category) {
            $count_for_each_post_type = [];

            foreach ($post_types as $post_type) {
                $num_of_posts = $category->posts->where('post_type_id', '=', $post_type->id)->count();
                array_push($count_for_each_post_type, ['name' => $post_type->name, 'num_of_posts' => $num_of_posts]);
            }

            $category->count_for_each_post_type = $count_for_each_post_type;
        }

        $posts = Post::orderBy('created_at', 'desc')->paginate(10);

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
        $post_search = $request->input('post_search');
        // Create query instance
        $query = Post::query();

        // When there is a category search keyword
        if (!empty($post_search)) {
            $query->where('title', 'like', '%' . $post_search . '%');
            $posts = $query->paginate(10);
        }

        // Get news with News API
        if (session()->get('news_list')) {
            $news_list = session()->get('news_list');
        } else {
            try {
                $url = config('newsapi.news_api_url') . "everything?q=violinist&apiKey=" . config('newsapi.news_api_key');
                $method = "GET";
                $count = 5;

                $client = new Client();
                $response = $client->request($method, $url);

                $results = $response->getBody();
                $articles = json_decode($results, true);

                $news_list = [];

                for ($id = 0; $id < $count; $id++) {
                    array_push($news_list, [
                        'title' => $articles['articles'][$id]['title'],
                        'url' => $articles['articles'][$id]['url'],
                        'thumbnail' => $articles['articles'][$id]['urlToImage'],
                    ]);
                }

                session()->put('news_list', $news_list);
            } catch (RequestException $e) {
                echo Psr7\Message::toString($e->getRequest());
                if ($e->hasResponse()) {
                    echo Psr7\Message::toString($e->getResponse());
                }
            }
        }

        return view('home', compact('post_search', 'categories', 'posts', 'news_list'));
    }
}
