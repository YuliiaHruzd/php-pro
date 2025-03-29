<?php

use App\Http\Controllers\Admin\AuthorController as AdminAuthorController;
use App\Http\Controllers\Admin\LoginController as AdminLoginController;
use App\Http\Controllers\Admin\PostController as AdminPostController;
use App\Http\Controllers\Admin\RegisterController as AdminRegisterController;
use App\Http\Controllers\Api\V1\PostController as ApiV1PostController;
use App\Http\Controllers\Api\V1\AuthorController as ApiV1AuthorController;
use App\Http\Controllers\Api\V2\PostController as ApiV2PostController;
use App\Http\Controllers\Api\V2\AuthorController as ApiV2AuthorController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\AuthorController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\WishListController;
use Illuminate\Support\Facades\Route;

Route::get('/admin', function () {
    return view('admin.welcome');
})->name('main');

Route::get('admin/login', function () {
    return view('admin.welcome');
})->name('login');

Route::get('admin/register', function () {
    return view('admin.welcome');
})->name('register');

Route::post('admin/login', [AdminLoginController::class, 'index']);
Route::post('admin/register', [AdminRegisterController::class, 'index']);

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

Route::get('/login', function () {
    return view('welcome');
})->name('login');

Route::get('/register', function () {
    return view('welcome');
})->name('register');

Route::post('/login', [LoginController::class, 'index']);
Route::post('/register', [RegisterController::class, 'index']);

Route::middleware(['auth'])->group(function () {
    Route::get('/', function () {
        return view('main');
    })->name('main');

    Route::get('posts', [PostController::class, 'index']);
    Route::get('posts/view/{id}', [PostController::class, 'view']);

    Route::get('authors', [AuthorController::class, 'index']);
    Route::get('authors{id}', [AuthorController::class, 'view']);

    Route::get('cart', [CartController::class, 'index']);
    Route::get('cart/create/{postId}', [CartController::class, 'create']);
    Route::get('cart/delete/{id}', [CartController::class, 'delete']);
    Route::get('cart/update/{id}', [CartController::class, 'updateView']);
    Route::post('cart/update/{id}', [CartController::class, 'update']);
    Route::get('cart/checkout', [CartController::class, 'checkout']);

    Route::get('wish-list', [WishListController::class, 'index']);
    Route::get('wish-list/create/{postId}', [WishListController::class, 'create']);
    Route::get('wish-list/delete/{id}', [WishListController::class, 'delete']);

    Route::prefix('api/v1')->group(function () {
        Route::get('/posts', [ApiV1PostController::class, 'index']);
        Route::get('/posts/{id}', [ApiV1PostController::class, 'view']);

        Route::get('/authors', [ApiV1AuthorController::class, 'index']);
        Route::get('/authors/{id}', [ApiV1AuthorController::class, 'view']);
    });

    Route::prefix('api/v2')->group(function () {
        Route::get('/posts', [ApiV2PostController::class, 'index']);
        Route::get('/posts/{id}', [ApiV2PostController::class, 'view']);

        Route::get('/authors', [ApiV2AuthorController::class, 'index']);
        Route::get('/authors/{id}', [ApiV2AuthorController::class, 'view']);
    });
});
