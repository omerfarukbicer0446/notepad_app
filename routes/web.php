<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Home;
use App\Http\Controllers\Login;
use App\Http\Controllers\Logout;
use App\Http\Controllers\Register;
use App\Http\Controllers\Note;

/* GET Methods */
    // Home
    Route::get('/', [Home::class, 'show'])->name("get.home"); // +

    // Notes
    Route::get('/note/add', [Note::class, 'new'])->name("get.new.note"); // +
    Route::get('/note/list/{slug}', [Note::class, 'show'])->name("get.list.note"); // +

    // Users login-logout
    Route::get('/login', [Login::class, 'show'])->name("get.login"); // +
    Route::get('/logout', [Logout::class, 'run'])->name("get.logout"); // +

    // Users register
    Route::get('/register', [Register::class, 'show'])->name("get.register"); // +

/* POST Methods */
    // Users login
    Route::post('/login', [Login::class, 'control'])->name("post.login"); // +

    // Users register
    Route::post('/register', [Register::class, 'control'])->name("post.register"); // +

    // Notes
    Route::post('/note/update', [Note::class, 'update'])->name("post.update.note"); // +
    Route::post('/note/add', [Note::class, 'add'])->name("post.add.note"); // +
    Route::post('/note/delete', [Note::class, 'delete'])->name("post.delete.note"); // +
