<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Category;
use Illuminate\Support\Str;

class CategoryController extends Controller
{
    public function index()
    {
        $categories = Category::orderBy('name', 'asc')->simplePaginate(10);

        return view('admin.categories.index', compact('categories'));
    }

    public function store()
    {
        $input = request()->validate([
            'name' => ['required', 'min:3', 'max:30', 'unique:categories'],
        ]);

        $category = new Category();
        $category->name = $input['name'];
        $category->slug = Str::lower($input['name']);

        $category->save();

        session()->flash('category-created-message', 'Category was created successfully. : ' . $category->name);

        return back();
    }
}
