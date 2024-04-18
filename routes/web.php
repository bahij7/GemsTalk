<?php

use App\Http\Middleware\AdminMiddleware;
use App\Http\Middleware\CheckAuth;

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UsersController;
use App\Http\Controllers\ChatController;
use App\Http\Controllers\PostsController;
use App\Http\Controllers\CreatePostController;

use Illuminate\Support\Facades\Route;


Route::get('/chat', [ChatController::class, 'index'])->name('chat.index');
Route::post('/chat', [ChatController::class, 'store'])->name('chat.store');


Route::get('/topics', function () {
    return view('pages.topic');
});

Route::get('/posts', function () {
    return view('pages.posts');
})->middleware([CheckAuth::class]);


Route::get('/', [PostsController::class, 'index'])->name('posts.index');
Route::post('/posts', [PostsController::class, 'store'])->name('posts.store');
Route::get('/posts/create', [CreatePostController::class, 'create'])->name('posts.create')->middleware([CheckAuth::class]);
Route::delete('/posts/{id}', [PostsController::class, 'destroy'])->name('post.delete');




Route::middleware([AdminMiddleware::class])->group(function () {
    Route::get('/admin/users', [UsersController::class, 'index']);
    Route::get('/admin', function () {
        return view('pages.admin.admin');
    });
    Route::get('/admin/posts', function(){
        return view('pages.admin.posts');
    });
    Route::get('/admin/comments', function(){
        return view('pages.admin.comments');
    });
    Route::get('/admin/chat', function(){
        return view('pages.admin.chat');
    });
    Route::get('/admin/categories', function(){
        return view('pages.admin.categories');
    });
});






Route::get('/dashboard', function () {
    return redirect('/');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';


    
