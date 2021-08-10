<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\TagController;
use App\Http\Controllers\Admin\PostController;
use App\Http\Controllers\Admin\CategoryController;

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
});

Route::prefix('admin')->middleware(['auth'])->group(function () {
    Route::resource('tag', TagController::class);
    Route::resource('category', CategoryController::class);
    Route::resource('post', PostController::class);
});

Auth::routes([
    'register' => false
]);

Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/show/{post}', [App\Http\Controllers\HomeController::class, 'show'])->name('show.post');
Route::get('/tag/{tag}', [App\Http\Controllers\HomeController::class, 'tag'])->name('show.tag');
Route::get('/category/{category}', [App\Http\Controllers\HomeController::class, 'category'])->name('show.category');
