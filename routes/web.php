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
    Route::get('/books/show-deleted', [BookController::class, 'showDeleted']);
    Route::get('/books/add', [BookController::class, 'add']);
    Route::post('/books/create', [BookController::class, 'create']);
    Route::get('/books/{slug}/edit', [BookController::class, 'edit']);
    Route::put('/books/{slug}/update', [BookController::class, 'update']);
    Route::get('/books/{slug}/delete', [BookController::class, 'delete']);
    Route::get('/books/{slug}/restore', [BookController::class, 'restore']);

    // Category
    Route::get('/categories', [CategoryController::class, 'index']);
    Route::get('/categories/show-deleted', [CategoryController::class, 'showDeleted']);
    Route::get('/categories/add', [CategoryController::class, 'add']);
    Route::post('/categories/create', [CategoryController::class, 'create']);
    Route::get('/categories/{slug}/edit', [CategoryController::class, 'edit']);
    Route::put('/categories/{slug}/update', [CategoryController::class, 'update']);
    Route::get('/categories/{slug}/delete', [CategoryController::class, 'delete']);
    Route::get('/categories/{slug}/restore', [CategoryController::class, 'restore']);

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