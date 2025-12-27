<?php

use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/delete/user/{id}', [UserController::class, 'delete'])->name('userDelete');
Route::get('/restore/user/{id}', [UserController::class, 'restore'])->name('userRestore');
