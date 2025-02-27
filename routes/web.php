<?php


use App\Http\Controllers\Admin\UsersController;
use App\Http\Controllers\Admin\PostsController;
use App\Http\Controllers\Admin\CategoriesController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\LikeController;
use App\Http\Controllers\FollowController;
use App\Models\Follow;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;

Auth::routes();

Route::group(
    ['middleware' => 'auth'],
    function () {
        Route::get('/', [HomeController::class, 'index'])->name('index');
        Route::get('/people', [HomeController::class, 'search'])->name('search');


        Route::group(['prefix' => 'post', 'as' => 'post.'], function () {
            Route::get('/create', [PostController::class, 'create'])->name('create');
            Route::post('/store', [PostController::class, 'store'])->name('store');
            Route::get('/{id}/show', [PostController::class, 'show'])->name('show');
            Route::get('/{id}/edit', [PostController::class, 'edit'])->name('edit');
            Route::patch('/{id}/update', [PostController::class, 'update'])->name('update');
            Route::delete('/{id}/destroy', [PostController::class, 'destroy'])->name('destroy');
        });

        Route::group(['prefix' => 'comment', 'as' => 'comment.'], function () {
            // Route::get('/', [PostController::class, 'create'])->name('create');
            Route::post('/{post_id}/store', [CommentController::class, 'store'])->name('store');
            Route::delete('/{id}/destroy', [CommentController::class, 'destroy'])->name('destroy');
        });


        Route::group(['prefix' => 'profile', 'as' => 'profile.'], function () {
            Route::get('/{id}/show', [ProfileController::class, 'show'])->name('show');
            Route::get('/edit', [ProfileController::class, 'edit'])->name('edit');
            Route::patch('/update', [ProfileController::class, 'update'])->name('update');
            Route::patch('/password/update', [ProfileController::class, 'passwordUpdate'])->name('password.update');
            Route::get('/{id}/followers', [ProfileController::class, 'followers'])->name('followers');
            Route::get('/{id}/following', [ProfileController::class, 'following'])->name('following');

        });

        Route::group(['prefix' => 'like', 'as' => 'like.'], function () {
            Route::post('/{post_id}/store', [LikeController::class, 'store'])->name('store');
            Route::delete('/{post_id}/destroy', [LikeController::class, 'destroy'])->name('destroy');
        });

        Route::group(['prefix' => 'follow', 'as' => 'follow.'], function () {
            Route::post('/{user_id}/store', [FollowController::class, 'store'])->name('store');
            Route::delete('/{user_id}/destroy', [FollowController::class, 'destroy'])->name('destroy');
            Route::get('/show', [FollowController::class, 'show'])->name('show');

        });
        Route::group(['prefix' => 'admin', 'as' => 'admin.', 'middleware' => 'admin'], function () {
            Route::get('/users', [UsersController::class, 'index'])->name('users');
            Route::delete('/users/{id}/deactivate', [UsersController::class, 'deactivate'])->name('deactivateuser');
            Route::patch('/users/{id}/activate', [UsersController::class, 'activate'])->name('activateuser');
            Route::get('/users/search', [UsersController::class, 'search'])->name('users.search');

            Route::get('/posts', [PostsController::class, 'index'])->name('posts');
            Route::delete('/posts/{id}/deactivate', [PostsController::class, 'deactivate'])->name('deactivatepost');
            Route::patch('/posts/{id}/activate', [PostsController::class, 'activate'])->name('activatepost');

            Route::get('/categories', [CategoriesController::class, 'index'])->name('categories');
            Route::post('/categories/store', [CategoriesController::class, 'store'])->name('categories.store');
            Route::delete('/categories/{id}/destroy', [CategoriesController::class, 'destroy'])->name('destroyCategory');
            Route::patch('/categories/{id}/update', [CategoriesController::class, 'update'])->name('updateCategory');
        });


    }
);
