<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\PostController;
use App\Http\Controllers\TagController;
use App\Models\Post;
use App\Models\Tag;


Route::get('/', function () {
    return ('welcome');
});

Route::get('post', function() {

    $posts = Post::all();

    return view('posts', ['posts'=>$posts]);
});

Route::get('tag', function() {

    $tags = Tag::all();

    return view('tag', ['tags'=>$tags]);
});

Route::get('posts/{page}', [PostController::class, 'index'])->name('post.index');

Route::get('posts/code/{page}', [PostController::class, 'code'])->name('post.code');