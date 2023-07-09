<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\BookController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\RentLogController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\DashboardController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
})->middleware('auth');

Route::get('/test', function () {
    return view('test');
});



// All role
Route::group(['middleware' => 'guest'], function(){
    
    // Auth
    Route::get('/login', [AuthController::class, 'login'])->name('login');
    Route::post('/login-process', [AuthController::class, 'loginProcess']);
    Route::get('/register', [AuthController::class, 'register']);
    Route::post('/register-process', [AuthController::class, 'registerProcess']);
    
});

// All role
Route::group(['middleware' => 'auth'], function(){
    
    // Auth
    Route::get('/logout', [AuthController::class, 'logout']);

    // Book
    Route::get('/books', [BookController::class, 'index']);

    // Category
    Route::get('/categories', [CategoryController::class, 'index']);

    // User
    Route::get('/users', [UserController::class, 'index']);
    
    // Rent Log
    Route::get('/rent-logs', [RentLogController::class, 'index']);

});

// Only admin
Route::group(['middleware' => ['auth', 'only_admin']], function(){

    // Dashboard
    Route::get('/dashboard', [DashboardController::class, 'index']);

});

// Only client
Route::group(['middleware' => ['auth', 'only_client']], function(){

    // User
    Route::get('/user/profile', [UserController::class, 'profile']);

});