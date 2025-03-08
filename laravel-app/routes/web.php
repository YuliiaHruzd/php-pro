<?php

use App\Http\Controllers\Admin\AuthorController;
use App\Http\Controllers\Admin\PostController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\RegisterController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
})->name('main');

Route::get('/login', function () {
    return view('welcome');
})->name('login');

Route::get('/register', function () {
    return view('welcome');
})->name('register');

Route::post('/login', [LoginController::class, 'index']);

Route::post('/register', [RegisterController::class, 'index']);

Route::get('admin/posts', [PostController::class, 'index']);
Route::get('admin/post/create', [PostController::class, 'createView']);
Route::post('admin/post/create', [PostController::class, 'create']);
Route::post('admin/post/update/{id}', [PostController::class, 'update']);
Route::get('admin/post/update/{id}', [PostController::class, 'updateView']);
Route::get('admin/post/delete/{id}', [PostController::class, 'delete']);

Route::get('admin/authors', [AuthorController::class, 'index']);
Route::get('admin/authors/create', [AuthorController::class, 'createView']);
Route::post('admin/authors/create', [AuthorController::class, 'create']);
Route::post('admin/authors/update/{id}', [AuthorController::class, 'update']);
Route::get('admin/authors/update/{id}', [AuthorController::class, 'updateView']);
Route::get('admin/authors/delete/{id}', [AuthorController::class, 'delete']);
