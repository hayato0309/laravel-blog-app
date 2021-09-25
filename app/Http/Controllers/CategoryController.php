<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Category;
use Illuminate\Support\Str;
use Symfony\Component\VarDumper\VarDumper;

class CategoryController extends Controller
{
    public function index(Request $request)
    {
        $categories = Category::orderBy('name', 'asc')->paginate(10);

        // search keywardを取得
        $category_search = Str::lower($request->input('category_search'));

        if (!empty($category_search)) {
            // queryインスタンスを作る
            $query = Category::query();
            $query->where('slug', 'like', '%' . $category_search . '%');

            $categories = $query->paginate(10);
        }
        return view('admin.categories.index', compact('category_search', 'categories'));
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
