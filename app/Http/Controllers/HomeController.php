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
use Illuminate\Support\Facades\DB;

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
        $categories = Category::countForEachPostType($categories); // 各カテゴリに属するPostの中に、ArticleとQuestionが何件あるのか取得

        $posts = Post::orderBy('created_at', 'desc')->paginate(10);

        $user = auth()->user();

        foreach ($posts as $post) {
            $post = Post::countLikes($post, $user); // ポストのLike数をカウントし、"likesCount"キーで配列に追加
            $post = Post::likeExists($post, $user); // Auth UserがポストをすでにLikeしたかどうかを確認
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
                $url = config('newsapi.news_api_url') . "everything?q=(orchestra OR violin OR violinist) &apiKey=" . config('newsapi.news_api_key');
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
