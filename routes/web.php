<?php

use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\TagController;
use App\Http\Controllers\PostController;
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

// Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
