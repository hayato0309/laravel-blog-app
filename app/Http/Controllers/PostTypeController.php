<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\PostType;
use Illuminate\Support\Str;

class PostTypeController extends Controller
{
    public function index()
    {
        return view('admin.postTypes.index');
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
}
