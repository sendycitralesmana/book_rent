<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Book;
use App\Models\User;
use App\Models\RentLog;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class BookRentController extends Controller
{
    public function index()
    {
        $users = User::where('role_id', '!=', 1)->get();
        $books = Book::all();
        return view('books/book-rent', [
            'users' => $users,
            'books' => $books
        ]);
    }

    public function create(Request $request)
    {
        $validated = $request->validate([
            'user_id' => 'required',
            'book_id' => 'required'
        ]);

        $book = Book::findOrFail($request->book_id)->only('status');
        if ($book['status'] != 'in stock') {
            Session::flash('status', 'alert-danger');
            Session::flash('btn-class', 'btn-danger');
            Session::flash('message', 'Cannot rent, the book is not available');
            return redirect('/book-rent');
        } else {
            $rentCount = RentLog::where('user_id', $request->user_id)->where('actual_return_date', null)->count();
            if ($rentCount >= 3) {
                Session::flash('status', 'alert-danger');
                Session::flash('btn-class', 'btn-danger');
                Session::flash('message', 'Cannot rent, user has reach limit of book');
                return redirect('/book-rent');
            } else {
                try {
                    DB::beginTransaction();
                    // process insert to rent_logs table
                    $rent = new RentLog;
                    $rent->user_id = $request->user_id;
                    $rent->book_id = $request->book_id;
                    $rent->rent_date = Carbon::now()->toDateString();
                    $rent->return_date = Carbon::now()->addDay(3)->toDateString();
                    $rent->save();
    
                    //process update books table
                    $book = Book::findOrFail($request->book_id);
                    $book->status = 'not available';
                    $book->update();
                    DB::commit();
                    Session::flash('status', 'alert-success');
                    Session::flash('btn-class', 'btn-success');
                    Session::flash('message', 'Rent book success');
                    return redirect('/book-rent');
                } catch (\Throwable $th) {
                    DB::rollBack();
                }
            }
        }

        // Session::flash('status', 'success');
        // Session::flash('message', 'Book Rent added successfully');
        // return redirect('/book-rent');
    }
}
