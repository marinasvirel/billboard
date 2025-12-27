<?php

use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('home');
})->name('home');

Route::get('register', [UserController::class, 'create'])->name('register');
Route::post('register', [UserController::class, 'store'])->name('userStore');
Route::get('login', [UserController::class, 'login'])->name('login');
Route::get('logout', [UserController::class, 'logout'])->name('logout');
Route::get('delete/user/{id}', [UserController::class, 'delete'])->name('userDelete');
Route::get('restore/user/{id}', [UserController::class, 'restore'])->name('userRestore');
