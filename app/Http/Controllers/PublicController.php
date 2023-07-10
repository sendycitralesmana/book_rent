<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Category;
use Illuminate\Http\Request;

class PublicController extends Controller
{
    public function index(Request $request)
    {
        $categories = Category::all();

        if ($request->category || $request->title) {
            // $book = Book::where('title', 'like', '%'.$request->title.'%')->get();
            $book = Book::where('title', 'like', '%'.$request->title.'%')
                    ->orWhereHas('categories', function($q) use($request) {
                        $q->where('categories.id', $request->category);
                    })->get();
            
            // $book = Book::whereHas('categories', function($q) use($request) {
            //     $q->where('categories.id', $request->category);
            // })->get();
        } else {
            $book = Book::all();
        }

        return view('public/book-list', [
            'book' => $book,
            'categories' => $categories
        ]);
    }
}
