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

        $posts = Post::orderBy('created_at', 'desc')->paginate(5);

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

        // If there is a category search keyword...
        if (!empty($post_search)) {
            $query->where('title', 'like', '%' . $post_search . '%');
            $posts = $query->paginate(5);
        }

        // Get news with News API
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
        } catch (RequestException $e) {
            echo Psr7\Message::toString($e->getRequest());
            if ($e->hasResponse()) {
                echo Psr7\Message::toString($e->getResponse());
            }
        }

        return view('home', compact('post_search', 'categories', 'posts', 'news_list'));
    }
}
