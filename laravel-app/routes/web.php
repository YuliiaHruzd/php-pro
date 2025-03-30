<?php

use App\Http\Controllers\Admin\AuthorController as AdminAuthorController;
use App\Http\Controllers\Admin\LoginController ;
use App\Http\Controllers\Admin\PostController as AdminPostController;
use App\Http\Controllers\Admin\RegisterController;
use App\Http\Controllers\AuthorController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\PostController;
use Illuminate\Support\Facades\Route;

Route::get('/admin', function () {
    return view('welcome');
})->name('main');

Route::get('/', function () {
    return view('main');
})->name('main');

Route::get('/login', function () {
    return view('welcome');
})->name('login');

Route::get('/register', function () {
    return view('welcome');
})->name('register');

Route::post('/login', [LoginController::class, 'index']);

Route::post('/register', [RegisterController::class, 'index']);

Route::get('admin/posts', [AdminPostController::class, 'index']);
Route::get('admin/post/create', [AdminPostController::class, 'createView']);
Route::post('admin/post/create', [AdminPostController::class, 'create']);
Route::post('admin/post/update/{id}', [AdminPostController::class, 'update']);
Route::get('admin/post/update/{id}', [AdminPostController::class, 'updateView']);
Route::get('admin/post/delete/{id}', [AdminPostController::class, 'delete']);

Route::get('admin/authors', [AdminAuthorController::class, 'index']);
Route::get('admin/authors/create', [AdminAuthorController::class, 'createView']);
Route::post('admin/authors/create', [AdminAuthorController::class, 'create']);
Route::post('admin/authors/update/{id}', [AdminAuthorController::class, 'update']);
Route::get('admin/authors/update/{id}', [AdminAuthorController::class, 'updateView']);
Route::get('admin/authors/delete/{id}', [AdminAuthorController::class, 'delete']);

Route::get('posts', [PostController::class, 'index']);
Route::get('posts/view/{id}', [PostController::class, 'view']);
Route::get('authors', [AuthorController::class, 'index']);
Route::get('authors{id}', [AuthorController::class, 'view']);

Route::get('cart', [CartController::class, 'index']);
Route::get('cart/create/{postId}', [CartController::class, 'create']);
Route::get('cart/delete/{id}', [CartController::class, 'delete']);
Route::get('cart/update/{id}', [CartController::class, 'updateView']);
Route::post('cart/update/{id}', [CartController::class, 'update']);
