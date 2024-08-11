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


Route::put('dashboard/post/blog/{post}',[PostController::class,'updateBlog'])->name('updateBlog');
Route::get('/user/post/{post}', [UserController::class, 'userPost'])->name('userPost');

Route::put('comments/{comment}/hide', [CommentController::class, 'hideComment'])->name('comments.hide');
Route::put('comments/{comment}/show', [CommentController::class, 'showComment'])->name('comments.show');


Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::get('/{page}', [AdminController::class,'index']);
