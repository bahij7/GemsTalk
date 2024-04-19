<?php

use App\Http\Middleware\AdminMiddleware;
use App\Http\Middleware\CheckAuth;

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UsersController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\CategoriesController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\ChatController;
use App\Http\Controllers\PostsController;
use App\Http\Controllers\CreatePostController;

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
})->name('welcome');

Route::get('/chat', [ChatController::class, 'index'])->name('chat.index');
Route::post('/chat', [ChatController::class, 'store'])->name('chat.store');


Route::get('/', [PostsController::class, 'index'])->name('posts.index');
Route::get('/posts', [PostsController::class, 'myposts'])->name('posts.myposts');
Route::get('/posts/create', [CreatePostController::class, 'create'])->name('posts.create');
Route::post('/posts/comments/{post_id}', [CommentController::class, 'store'])->name('comments.store');

Route::post('/posts', [PostsController::class, 'store'])->name('posts.store');
Route::get('/posts/{id}', [PostsController::class, 'show'])->name('posts.show');
Route::delete('/posts/{id}', [PostsController::class, 'destroy'])->name('post.delete');





Route::middleware([AdminMiddleware::class])->group(function () {
    Route::get('/admin', function () {
        return view('pages.admin.admin');
    });
    
    Route::get('/admin', [DashboardController::class, 'index']);
    Route::get('/admin/download-pdf', [DashboardController::class, 'downloadPDF']);
    Route::get('/admin/users', [UsersController::class, 'index']);
    Route::get('/admin/posts', [PostsController::class, 'adminPost'])->name('posts.index');
    Route::get('/admin/chat', [ChatController::class, 'adminChat'])->name('chat.index');
    Route::get('/admin/categories', [CategoriesController::class, 'index'])->name('categories.index');

    Route::get('/admin/comments', function(){
        return view('pages.admin.comments');
    });
  
});






// Route::get('/dashboard', function () {
//     return redirect('/');
// })->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';