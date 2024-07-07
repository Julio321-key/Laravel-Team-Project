<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

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

Route::get('/', [App\Http\Controllers\ReviewController::class, 'index'])->name('index');

Route::get('/create', [App\Http\Controllers\ReviewController::class, 'create'])->name('create');

Route::post('/create', [App\Http\Controllers\ReviewController::class, 'store'])->name('store');

Route::get('/show/{id}', [App\Http\Controllers\ReviewController::class, 'show'])->name('show');
Route::get('/category/{category}', [App\Http\Controllers\ReviewController::class, 'category'])->name('category');
Route::get('/edit/{id}', [App\Http\Controllers\ReviewController::class, 'edit'])->name('edit');
Route::post('/update', [App\Http\Controllers\ReviewController::class, 'update'])->name('update');
Route::delete('/delete/{id}', [App\Http\Controllers\ReviewController::class, 'destroy'])->name('delete');

Route::post('/comment/create', [App\Http\Controllers\CommentController::class, 'store'])->name('comment.store');

Auth::routes();

Route::get('/home', [App\Http\Controllers\ReviewController::class, 'index'])->name('home');
