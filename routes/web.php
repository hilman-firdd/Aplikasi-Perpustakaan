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
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
})->middleware('auth');

Route::middleware('is_guest')->group(function() {
    Route::get('/login', [AuthController::class, 'login'])->name('login');
    Route::post('/login', [AuthController::class, 'authenticate']);
    Route::get('register', [AuthController::class, 'register']);
    Route::post('register', [AuthController::class, 'registerProses']);
});

Route::middleware('auth')->group(function() {
    Route::get('logout', [AuthController::class, 'logout']);

    Route::get('dashboard', [DashboardController::class, 'index'])->middleware('is_admin');
    
    Route::get('profile', [UserController::class, 'profile'])->middleware('is_client');
    
    Route::prefix('books')->group(function() {
        Route::get('/', [BookController::class, 'index'])->name('books.index');
        Route::get('/add', [BookController::class, 'add'])->name('books.add');
        Route::post('/add', [BookController::class, 'store'])->name('books.store');
        Route::get('/edit/{slug}', [BookController::class, 'edit'])->name('books.edit');
        Route::put('/edit/{slug}', [BookController::class, 'update'])->name('books.update');
        Route::delete('/delete/{slug}', [BookController::class, 'delete'])->name('books.delete');
        Route::get('/deleted', [BookController::class, 'deleted'])->name('books.deleted');
        Route::get('/restore/{slug}', [BookController::class, 'restore'])->name('books.restore');
    });

    Route::prefix('categories')->group(function() {
        Route::get('/', [CategoryController::class, 'index'])->name('category.index');
        Route::get('/add', [CategoryController::class, 'add'])->name('category.add');
        Route::post('/add', [CategoryController::class, 'store'])->name('category.store');
        Route::get('/edit/{slug}', [CategoryController::class, 'edit'])->name('category.edit');
        Route::put('/edit/{slug}', [CategoryController::class, 'update'])->name('category.update');
        Route::delete('/delete/{slug}', [CategoryController::class, 'delete'])->name('category.delete');;
        Route::get('/deleted', [CategoryController::class, 'deleted'])->name('category.deleted');
        Route::get('/restore/{slug}', [CategoryController::class, 'restore'])->name('category.restore');
    });
    
    Route::prefix('users')->group(function() {
        Route::get('/', [UserController::class, 'index'])->name('users.index');
        Route::get('/registered-users', [UserController::class, 'registeredUser'])->name('users.registered');
    });

    Route::prefix('rent-logs')->group(function() {
        Route::get('/', [RentLogController::class, 'index'])->name('rent_logs.index');
    });
});