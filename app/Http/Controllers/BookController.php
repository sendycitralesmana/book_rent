<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Cviebrock\EloquentSluggable\Services\SlugService;

class BookController extends Controller
{
    public function index()
    {
        $book = Book::all();
        return view('books/index', [
            'book' => $book
        ]);
    }

    public function add()
    {
        $categories = Category::all();
        return view('books/add', [
            'categories' => $categories
        ]);
    }

    public function create(Request $request)
    {
        // php artisan storage:link
        // .env -> FILESYSTEM_DISK=local to FILESYSTEM_DISK=public

        $validated = $request->validate([
            'book_code' => 'required|unique:books',
            'title' => 'required',
        ]);

        $newName = '';

        if ($request->file('cover')) {
            $extension = $request->file('cover')->getClientOriginalExtension();
            $newName = $request->title.'-'.now()->timestamp.'.'.$extension;
            $request->file('cover')->storeAs('cover', $newName);
        }

        $book = new Book;
        $book->book_code = $request->book_code;
        $book->title = $request->title;
        $book->cover = $newName;
        $book->slug = SlugService::createSlug(Book::class, 'slug', $request->title);
        $book->save();

        $book->categories()->sync($request->categories);

        Session::flash('status', 'success');
        Session::flash('message', 'Book added successfully');
        return redirect('/books');
    }

    public function edit($slug)
    {
        $book = Book::where('slug', $slug)->first();
        $categories = Category::all();
        return view('books/edit', [
            'book' => $book,
            'categories' => $categories
        ]);
    }

    public function update(Request $request, $slug)
    {
        // $newName = '';

        if ($request->file('cover')) {
            $extension = $request->file('cover')->getClientOriginalExtension();
            $newName = $request->title.'-'.now()->timestamp.'.'.$extension;
            $request->file('cover')->storeAs('cover', $newName);
            $book->cover = $newName;
        }

        $book = Book::where('slug', $slug)->first();
        $book->book_code = $request->book_code;
        $book->title = $request->title;
        
        $book->slug = SlugService::createSlug(Book::class, 'slug', $request->title);
        $book->update();

        if($request->categories) {
            $book->categories()->sync($request->categories);
        }

        Session::flash('status', 'success');
        Session::flash('message', 'Book updated successfully');
        return redirect('/books');
    }

    public function delete($slug)
    {
        $book = Book::where('slug', $slug)->first();
        $book->delete();

        Session::flash('status', 'success');
        Session::flash('message', 'Book deleted successfully');
        return redirect('/books');
    }

    public function showDeleted()
    {
        $book = Book::onlyTrashed()->get();
        return view('books/show-deleted', [
            'book' => $book
        ]);
    }

    public function restore($slug)
    {
        $book = Book::withTrashed()->where('slug', $slug)->first();
        $book->restore();

        Session::flash('status', 'success');
        Session::flash('message', 'Book restored successfully');
        return redirect('/books');
    }
}
