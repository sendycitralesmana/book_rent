<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\User;
use App\Models\RentLog;
use App\Models\Category;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $bookCount = Book::count();
        $categoryCount = Category::count();
        $userCount = User::count();
        $rentLogCount = RentLog::count();
        $rentLog = RentLog::all();
        
        return view('dashboards/index', [
            'bookCount' => $bookCount,
            'categoryCount' => $categoryCount,
            'userCount' => $userCount,
            'rentLogCount' => $rentLogCount,
            'rentLog' => $rentLog,
        ]);
    }
}
