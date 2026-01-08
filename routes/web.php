<?php

use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Http\Request;

Route::get('/', function () {
    return view('home');
})->name('home');

Route::get('register', [UserController::class, 'create'])->name('register');
Route::post('register', [UserController::class, 'store'])->name('user.store');
Route::get('login', [UserController::class, 'login'])->name('login');

Route::middleware('auth')->group(function () {
    Route::get('verify', function () {
        return view('user.verify');
    })->name('verification.notice');

    Route::get('/email/verify/{id}/{hash}', function (EmailVerificationRequest $request) {
        $request->fulfill();
        return redirect()->route('announcement.create');
    })->middleware('signed')->name('verification.verify');
});

Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('announcement/create', function () {
        return view('announcement.create');
    })->name('announcement.create');

    Route::get('logout', [UserController::class, 'logout'])->name('logout');

    Route::get('user/delete/{id}', [UserController::class, 'delete'])->name('user.delete');
    Route::get('user/restore/{id}', [UserController::class, 'restore'])->name('user.restore');
});
