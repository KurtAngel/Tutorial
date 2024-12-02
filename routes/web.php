<?php

use App\Models\Post;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\MessageController;

Route::get('/', function () {
    $posts = [];
    if(auth()->check()) {
        $posts = auth()->user()->usersCoolPosts()->latest()->get();
    }
    // $posts = Post::where('user_id', auth()->id())->get();
    return view('home', ['posts' => $posts]);
});

//user authentications
Route::post('/register', [UserController::class, 'register']);
Route::post('/logout', [UserController::class, 'logout']);
Route::post('/login', [UserController::class, 'login']);

//Blog post related routes
Route::post('/create-post', [PostController::class, 'createPost']);
Route::get('/edit-post/{post}', [PostController::class, 'showEditScreen']);
Route::put('/edit-post/{post}', [PostController::class, 'UpdatePost']);
Route::delete('/delete-post/{post}', [PostController::class, 'DeletePost']);

//send message
Route::post('/send-message', [MessageController::class, 'sendMessage']);