<?php

use App\Http\Middleware\AdminMiddleware;
use App\Http\Middleware\CheckAuth;

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UsersController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\CategoriesController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\ChatController;
use App\Http\Controllers\PostsController;
use App\Http\Controllers\CreatePostController;

use Illuminate\Support\Facades\Route;


Route::get('/', [PostsController::class, 'index'])->name('posts.index');
Route::get('/posts', [PostsController::class, 'myposts'])->name('posts.myposts')->middleware(CheckAuth::class);
Route::get('/posts/create', [CreatePostController::class, 'create'])->name('posts.create')->middleware(CheckAuth::class);
Route::post('/posts/comments/{post_id}', [CommentController::class, 'store'])->name('comments.store')->middleware(CheckAuth::class);

Route::post('/posts', [PostsController::class, 'store'])->name('posts.store')->middleware(CheckAuth::class);
Route::get('/posts/{id}', [PostsController::class, 'show'])->name('posts.show');
Route::get('/posts/edit/{id}', [PostsController::class, 'edit'])->name('posts.edit')->middleware(CheckAuth::class);
Route::post('/posts/edit/{id}', [PostsController::class, 'update'])->name('posts.update')->middleware(CheckAuth::class);
Route::delete('/posts/{id}', [PostsController::class, 'destroy'])->name('posts.delete')->middleware(CheckAuth::class);


Route::get('/chat', [ChatController::class, 'index'])->name('chat.index');
Route::post('/chat', [ChatController::class, 'store'])->name('chat.store');


Route::middleware([AdminMiddleware::class])->group(function () {
    
    Route::get('/admin', [DashboardController::class, 'index']);
    Route::get('/admin/download-pdf', [DashboardController::class, 'downloadPDF']);
    Route::get('/admin/users', [UsersController::class, 'index']);
    Route::get('/admin/admins', [UsersController::class, 'admins'])->name('admins');
    Route::get('/admin/posts', [PostsController::class, 'adminPost'])->name('posts.index');
    Route::get('/admin/chat', [ChatController::class, 'adminChat'])->name('chat.index');
    Route::get('/admin/categories', [CategoriesController::class, 'index'])->name('categories.index');
    Route::post('/admin/categories', [CategoriesController::class, 'store'])->name('categories.store');
    Route::get('/admin/comments', [CommentController::class, 'adminComment'])->name('comments.index');

    Route::delete('/posts/{postId}', [AdminController::class, 'deletep'])->name('adminpost.delete');
    Route::delete('/users/{userId}', [AdminController::class, 'delete'])->name('adminuser.delete');
    Route::delete('/categories/{categoryId}', [AdminController::class, 'deleteeee'])->name('admincategory.delete');
    Route::delete('/chats/{chatId}', [AdminController::class, 'deletee'])->name('adminchat.delete');
    Route::delete('/comments/{commentId}', [AdminController::class, 'deleteee'])->name('admincomment.delete');
    Route::put('/admin/users/{user}', [AdminController::class, 'updateRole'])->name('admin.users.updateRole');
  
});


Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';