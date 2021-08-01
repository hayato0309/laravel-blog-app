<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\PostType;
use Illuminate\Support\Str;

class PostTypeController extends Controller
{
    public function index()
    {
        $post_types = PostType::all();

        return view('admin.postTypes.index', compact('post_types'));
    }

    public function store()
    {
        $input = request()->validate([
            'name' => ['required', 'min:3', 'max:30', 'unique:post_types'],
        ]);

        $post_type = new PostType();
        $post_type->name = Str::ucfirst($input['name']);
        $post_type->slug = Str::slug($input['name']);

        $post_type->save();

        session()->flash('post-type-created-message', 'Post type was created successfully. : ' . $post_type->name);

        return back();
    }

    public function update($id)
    {   
        $input = request()->validate([
            'name' => ['required', 'min:3', 'max:30', 'unique:categories'],
        ]);
        
        $post_type = PostType::findOrFail($id);
        $post_type->name = $input['name'];
        $post_type->update();

        session()->flash('post-type-updated-message', 'Post type was updated successfully. : ' . $post_type->name);

        return back();
    }

    public function destroy($id)
    {
        $post_type = PostType::findOrFail($id);
        $post_type->delete();

        session()->flash('post-type-deleted-message', 'Post type was deleted successfully. : ' . $post_type->name);
        
        return back();
    }
}
