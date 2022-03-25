<?php

use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\PostController;
use App\Http\Controllers\Admin\RoleController;
use App\Http\Controllers\Admin\TagController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\CommentController;
use App\Http\Controllers\User\ProfileController;
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

Route::prefix('admin')->name('admin.')
    ->middleware(['AdminMiddleware:edit-users,delete-users,moderate-posts,roles-management,update-comments,creation-posts,update-posts'])
    ->group(function () {

        Route::get('/', function () {
            return view('admin.pages.index');
        })->name('index');

        Route::resource('posts', PostController::class)
            ->only(['index', 'destroy']);
        Route::get('/posts/create', [PostController::class, 'create'])
            ->name('posts.create')
            ->middleware(['AdminMiddleware:creation-posts']);
        Route::post('/posts/create', [PostController::class, 'store'])
            ->name('posts.store')
            ->middleware(['AdminMiddleware:creation-posts']);
        Route::get('/posts/{id}/edit', [PostController::class, 'edit'])
            ->name('posts.edit')
            ->where(['id' => '[0-9]+'])
            ->middleware(['AdminMiddleware:update-posts']);
        Route::patch('/posts/{id}/edit', [PostController::class, 'update'])
            ->name('posts.update')
            ->where(['id' => '[0-9]+'])
            ->middleware(['AdminMiddleware:update-posts']);

        Route::resource('categories', CategoryController::class)
            ->except(['show']);

        Route::resource('tags', TagController::class)
            ->except(['show']);

        Route::resource('roles', RoleController::class)
            ->except(['show'])
            ->middleware(['AdminMiddleware:roles-management']);

        Route::resource('users', UserController::class)
            ->except(['show'])
            ->middleware(['AdminMiddleware:edit-users,delete-users']);

        Route::resource('comments', CommentController::class)
            ->only(['index', 'destroy']);

        Route::get('/comments/{id}/edit', [CommentController::class, 'edit'])
            ->name('comments.edit')
            ->where(['id' => '[0-9]+'])
            ->middleware(['AdminMiddleware:update-comments']);

        Route::patch('/comments/{id}/edit', [CommentController::class, 'update'])
            ->name('comments.update')
            ->where(['id' => '[0-9]+'])
            ->middleware(['AdminMiddleware:update-comments']);

        Route::get('/moderate', [PostController::class, 'moderationList'])
            ->name('posts.moderate.index')
            ->middleware(['AdminMiddleware:moderate-posts']);
        Route::get('/moderate/{id}/edit', [PostController::class, 'checkPost'])
            ->name('posts.moderate.edit')
            ->where(['id' => '[0-9]+'])
            ->middleware(['AdminMiddleware:moderate-posts']);
        Route::patch('/moderate/{id}/edit', [PostController::class, 'allow'])
            ->name('posts.moderate.update')
            ->where(['id' => '[0-9]+'])
            ->middleware(['AdminMiddleware:moderate-posts']);

        Route::prefix('garbage')->name('garbage.')->middleware(['AdminMiddleware:basket-access'])
            ->group(function () {
                Route::resource('posts', \App\Http\Controllers\Admin\Garbage\PostController::class)
                    ->except(['create', 'store']);
                Route::get('/posts/{id}/restore', [App\Http\Controllers\Admin\Garbage\PostController::class, 'restore'])->name('posts.restore')->where(['id' => '[0-9]+']);

                Route::resource('users', \App\Http\Controllers\Admin\Garbage\UserController::class)
                    ->except(['create', 'store']);
                Route::get('/users/{id}/restore', [App\Http\Controllers\Admin\Garbage\UserController::class, 'restore'])->name('users.restore')->where(['id' => '[0-9]+']);

                Route::resource('comments', \App\Http\Controllers\Admin\Garbage\CommentController::class)
                    ->except(['show', 'create', 'store']);
                Route::get('/comments/{id}/restore', [App\Http\Controllers\Admin\Garbage\CommentController::class, 'restore'])->name('comments.restore')->where(['id' => '[0-9]+']);
            });

    });

Route::get('/', [\App\Http\Controllers\User\PostController::class, 'index'])
    ->name('index');

Route::resource('posts', \App\Http\Controllers\User\PostController::class)
    ->only(['index', 'show']);

Route::get('/categories', App\Http\Controllers\User\CategoryController::class)
    ->name('categories');

Route::get('/category/{id?}', App\Http\Controllers\User\CategoryController::class)
    ->name('category')
    ->where(['id' => '[0-9]+']);

Route::get('/tags', App\Http\Controllers\User\TagController::class)
    ->name('tags');

Route::get('/tag/{id?}', App\Http\Controllers\User\TagController::class)
    ->name('tag')
    ->where(['id' => '[0-9]+']);

Route::get('/comments', [\App\Http\Controllers\User\CommentController::class, 'index'])
    ->name('user.comments.list');

Route::post('/post/{id}/comment', [\App\Http\Controllers\User\CommentController::class, 'store'])
    ->name('user.comments.store')
    ->where(['id' => '[0-9]+']);

Route::delete('/post/{id}/comment', [\App\Http\Controllers\User\CommentController::class, 'destroy'])
    ->name('user.comments.delete')
    ->where(['id' => '[0-9]+']);

Route::get('/comment/{id}/edit', [\App\Http\Controllers\User\CommentController::class, 'edit'])
    ->name('user.comments.edit')
    ->where(['id' => '[0-9]+']);

Route::patch('/comment/{id}/edit', [\App\Http\Controllers\User\CommentController::class, 'update'])
    ->name('user.comments.update')
    ->where(['id' => '[0-9]+']);

Route::get('/users', [\App\Http\Controllers\User\UserController::class, 'index'])->name('user.users.list');
Route::get('/users/role/{id}', [\App\Http\Controllers\User\UserController::class, 'roles'])
    ->name('role.users')
    ->where(['id' => '[0-9]+']);

Route::prefix('profile/{name}')->group(function () {
    Route::get('/', [ProfileController::class, 'index'])->name('profile.index');
    Route::get('/comments', [ProfileController::class, 'comments'])->name('profile.comments.index');
    Route::get('/posts', [ProfileController::class, 'posts'])->name('profile.posts.index');
    Route::get('/edit', [ProfileController::class, 'edit'])
        ->name('profile.edit')
        ->middleware(['AdminMiddleware:edit-users']);
    Route::patch('/edit', [ProfileController::class, 'update'])
        ->name('profile.update')
        ->middleware(['AdminMiddleware:cedit-users']);
    Route::delete('/', [ProfileController::class, 'delete'])
        ->middleware(['AdminMiddleware:creation-posts'])
        ->name('delete-users');
});

Route::get('/offer', [App\Http\Controllers\User\OfferController::class, 'create'])->name('user.posts.offer');
Route::post('/offer', [App\Http\Controllers\User\OfferController::class, 'store'])->name('user.posts.store');

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
