<?php

namespace App\Http\Controllers;

use App\Models\RentLog;
use Illuminate\Http\Request;

class RentLogController extends Controller
{
    public function index()
    {
        $rent = RentLog::with(['user', 'book'])->get();
        return view('rent_logs/index', [
            'rent' => $rent
        ]);
    }
}
