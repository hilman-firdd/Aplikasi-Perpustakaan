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
    
    Route::get('books', [BookController::class, 'index']);
    
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
    
    Route::get('users', [UserController::class, 'index']);
    
    Route::get('rent-logs', [RentLogController::class, 'index']);
});