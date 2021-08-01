<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Category;
use Illuminate\Support\Str;

class CategoryController extends Controller
{
    public function index()
    {
        $categories = Category::orderBy('name', 'asc')->paginate(10);

        return view('admin.categories.index', compact('categories'));
    }

    public function store()
    {
        $input = request()->validate([
            'name' => ['required', 'min:3', 'max:30', 'unique:categories'],
        ]);

        $category = new Category();
        $category->name = Str::ucfirst($input['name']);
        $category->slug = Str::slug($input['name']);

        $category->save();

        session()->flash('category-created-message', 'Category was created successfully. : ' . $category->name);

        return back();
    }

    public function update($id)
    {
        $input = request()->validate([
            'name' => ['required', 'min:3', 'max:30', 'unique:categories'],
        ]);

        $category = Category::findOrFail($id);
        $category->name = $input['name'];
        $category->update();

        session()->flash('category-updated-message', 'Category was updated successfully. : ' . $category->name);

        return back();
    }

    public function destroy($id)
    {
        $category = Category::findOrFail($id);
        $category->delete();

        session()->flash('category-deleted-message', 'Category was deleted successfully. : ' . $category->name);

        return back();
    }
}
