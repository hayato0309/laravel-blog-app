<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\User;
use App\Post;
use App\Comment;
use App\Like;
use App\Category;
use App\PostType;
use App\Events\PostPostedEvent;
use Illuminate\Pagination\LengthAwarePaginator;

class PostController extends Controller
{
    public function show($id)
    {
        $post = Post::findOrFail($id);
        $user = auth()->user();

        $post = Post::countLikes($post, $user); // ポストのLike数をカウントし、"likesCount"キーで配列に追加
        $post = Post::likeExists($post, $user); // Auth UserがポストをすでにLikeしたかどうかを確認

        $comments = $post->comments()->where('parent_id', NULL)->orderBy('created_at', 'desc')->get();

        // Getting categories for the post
        $category = new Category();
        $categories = $category->getCategoriesForPost($post);

        return view('posts.show', compact('post', 'comments', 'categories'));
    }

    public function list()
    {
        $posts = Post::where('user_id', Auth::user()->id)->orderBy('created_at', 'desc')->paginate(10);
        return view('posts.list', compact('posts'));
    }

    public function create()
    {
        $post_types = PostType::orderBy('slug', 'asc')->get();
        $categories = Category::orderBy('slug', 'asc')->get();

        return view('posts.create', compact('post_types', 'categories'));
    }

    public function store()
    {
        $input = request()->validate([
            'post_type' => ['required'],
            'title' => ['required', 'max:255'],
            'content' => ['required', 'max:2000'],
            'post_image' => ['file', 'image', 'max:1024'],
            'categories' => ['required'],
        ]);

        $post = new Post();
        $post->user_id = Auth::user()->id;
        $post->post_type_id = $input['post_type'];
        $post->title = $input['title'];
        $post->content = $input['content'];

        if (request('post_image')) {
            $post['post_image'] = request('post_image')->store('images');
        }

        $post->save();

        // category_idとpost_idをpivot tableに入れるのは$post->save()の後（postができてないのにpivot tableにidを入れることは不可能）
        $post->categories()->sync($input['categories'], false);


        session()->flash('post-created-message', 'Post was created :' . $post['title']);

        // Triger notification
        event(new PostPostedEvent($post));

        return redirect()->route('home');
    }

    public function edit($id)
    {
        $post = Post::findOrFail($id);

        // Checking which categories the post already has
        $categories = Category::all();

        $category = new Category();
        $current_categories_id = array_column($category->getCategoriesForPost($post)->toArray(), "id");

        return view('posts.edit', compact('post', 'categories', 'current_categories_id'));
    }

    public function update(Request $request, $id)
    {

        $input = request()->validate([
            'title' => ['required', 'max:255'],
            'content' => ['required', 'max:2000'],
            'post_image' => ['file', 'image', 'max:1024'],
            'categories' => ['required'],
        ]);

        $post = Post::findOrFail($id);

        $post->title = $input['title'];
        $post->content = $input['content'];

        if (request('post_image')) {
            $post->post_image = $request->file('post_image')->store('images');
        }

        $post->update();

        $post->categories()->sync($input['categories']);

        session()->flash('post-updated-message', 'The post was updated successfully.');

        return back();
    }

    public function destroy($id)
    {
        $post = Post::findOrFail($id);
        $post->delete();

        session()->flash('post-deleted-message', 'Post was deleted successfully. : ' . $post->title);

        return back();
    }

    public function like($id)
    {
        $user = auth()->user();
        $post = Post::findOrFail($id);

        $like = new Like();

        $post = $post->likeExists($post, $user);

        if ($post['isLiked']) {
            // Already liked => Remove Like
            $like = Like::where('user_id', '=', $user->id)->where('post_id', '=', $post->id)->delete();
        } else {
            // Not yet like => Add Like
            $like->user_id = $user->id;
            $like->post_id = $post->id;
            $like->save();
        }

        session()->flash('removed-like-post-message', 'Removed like from the post. : ' . $post->title);

        return back();
    }


    // 選択されたCategoryを持つPostのみを表示
    public function categoryPost($id, Request $request)
    {
        $categories = Category::orderBy('slug', 'asc')->get();
        $categories = Category::countForEachPostType($categories); // 各カテゴリに属するPostの中に、ArticleとQuestionが何件あるのか取得

        $category_selected = Category::findOrFail($id);

        $posts = $category_selected->posts()->orderBy('created_at', 'desc')->paginate(10); // 選択されたCategoryを持つPostのみを取得

        $user = auth()->user();

        foreach ($posts as $post) {
            $post = Post::countLikes($post, $user); // ポストのLike数をカウントし、"likesCount"キーで配列に追加
            $post = Post::likeExists($post, $user); // Auth UserがポストをすでにLikeしたかどうかを確認
        }

        //　作業メモ：countLikesとlikeExistsはメソッド内でLoopにせず、コントローラでLoopする。

        // カテゴリが選択されていたらカードに色を付けるための処理
        foreach ($categories as $category) {
            if ($category->id === $category_selected->id) {
                $category->selected = true;
            } else {
                $category->selected = false;
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

        // Get news from session
        $news_list = session()->get('news_list');

        return view('home_category', compact('categories', 'posts', 'news_list'));
    }

    public function favoritePost(Request $request)
    {
        $favorite_posts = auth()->user()->favoritePosts()->paginate(10);

        return view('posts.favorite', compact('favorite_posts'));
    }
}
