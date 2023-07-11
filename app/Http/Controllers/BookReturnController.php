<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Book;
use App\Models\User;
use App\Models\RentLog;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class BookReturnController extends Controller
{
    public function index()
    {
        $users = User::where('role_id', '!=', 1)->where('status', '!=', 'inactive')->get();
        $books = Book::all();
        return view('rent_logs/book-return', [
            'users' => $users,
            'books' => $books
        ]);
    }

    public function create(Request $request)
    {
        $rent = RentLog::where('user_id', $request->user_id)
                        ->where('book_id', $request->book_id)
                        ->where('actual_return_date', null);
        $rentData = $rent->first();
        $rentCount = $rent->count();

        if ($rentCount == 1) {
            try {
                DB::beginTransaction();
                $rentData->actual_return_date = Carbon::now()->toDateString();
                $rentData->update();

                $book = Book::findOrFail($request->book_id);
                $book->status = 'in stock';
                $book->update();
                DB::commit();
            } catch (\Throwable $th) {
                DB::rollBack();
            }
            Session::flash('status', 'alert-success');
            Session::flash('btn-class', 'btn-success');
            Session::flash('message', 'The book is returned successfully');
            return redirect('/book-return');
        } else {
            Session::flash('status', 'alert-danger');
            Session::flash('btn-class', 'btn-danger');
            Session::flash('message', 'There is error in process');
            return redirect('/book-return');
        }
    }
}
