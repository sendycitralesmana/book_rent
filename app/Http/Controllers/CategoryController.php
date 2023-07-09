<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Cviebrock\EloquentSluggable\Services\SlugService;

class CategoryController extends Controller
{
    public function index()
    {
        $category = Category::all();
        return view('categories/index', [
            'category' => $category
        ]);
    }

    public function add()
    {
        return view('categories/add');
    }

    public function create(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|unique:categories'
        ]);

        $user = new Category;
        $user->name = $request->name;
        $user->slug = SlugService::createSlug(Category::class, 'slug', $request->name);
        $user->save();

        Session::flash('status', 'success');
        Session::flash('message', 'Category added successfully');
        return redirect('/categories');
    }

    public function edit($slug)
    {
        $category = Category::where('slug', $slug)->first();
        return view('categories/edit', [
            'category' => $category
        ]);
    }

    public function update(Request $request, $slug)
    {
        $validated = $request->validate([
            'name' => 'required|unique:categories'
        ]);

        $category = Category::where('slug', $slug)->first();
        $category->name = $request->name;
        $category->slug = SlugService::createSlug(Category::class, 'slug', $request->name);
        $category->update();

        Session::flash('status', 'success');
        Session::flash('message', 'Category updated successfully');
        return redirect('/categories');
    }

    public function delete($slug)
    {
        $category = Category::where('slug', $slug)->first();
        $category->delete();

        Session::flash('status', 'success');
        Session::flash('message', 'Category deleted successfully');
        return redirect('/categories');
    }

    public function showDeleted()
    {
        $category = Category::onlyTrashed()->get();
        return view('categories/show-deleted', [
            'category' => $category
        ]);
    }

    public function restore($slug)
    {
        $category = Category::withTrashed()->where('slug', $slug)->first();
        $category->restore();

        Session::flash('status', 'success');
        Session::flash('message', 'Category restore successfully');
        return redirect('/categories');
    }
}
