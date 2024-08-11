<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\Dashboard\Post\PostController;
use App\Http\Controllers\Dashboard\User\UserController;
use App\Http\Controllers\Front\Comment\CommentController;

Route::get('/', function () {
    return view('welcome');
});


Auth::routes();

Route::resource('comments', CommentController::class);
Route::resource('dashboard/post', PostController::class);
Route::resource('dashboard/users', UserController::class);
// Route::resource('comments', CommentController::class);


Route::put('dashboard/post/blog/{post}',[PostController::class,'updateBlog'])->name('updateBlog');
Route::get('/user/profile', [UserController::class, 'profile'])->name('profile');
Route::get('/user/post/{post}', [UserController::class, 'userPost'])->name('userPost');


Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::get('/{page}', [AdminController::class,'index']);
