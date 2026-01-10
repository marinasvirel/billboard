<?php

use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Http\Request;

Route::get('/', function () {
    return view('home');
})->name('home');

Route::middleware('guest')->group(function () {
    Route::get('register', [UserController::class, 'create'])->name('register');
    Route::post('register', [UserController::class, 'store'])->name('user.store');
    Route::get('login', [UserController::class, 'login'])->name('login');
    Route::post('login', [UserController::class, 'authenticate'])->name('user.authenticate');

    Route::get('/forgot-password', function () {
        return view('user.forgot-password');
    })->name('password.request');

    Route::post('/forgot-password', [UserController::class, 'forgotPasswordStore'])->name('password.email');

    Route::get('/reset-password/{token}', function (string $token) {
        return view('user.reset-password', ['token' => $token]);
    })->name('password.reset');

    Route::post('/reset-password', [UserController::class, 'resetPasswordUpdate'])->name('password.update');
});

Route::middleware('auth')->group(function () {
    Route::get('verify', function () {
        return view('user.verify');
    })->name('verification.notice');

    Route::get('/email/verify/{id}/{hash}', function (EmailVerificationRequest $request) {
        $request->fulfill();
        return redirect()->route('announcement.create');
    })->middleware('signed')->name('verification.verify');

    Route::post('/email/verification-notification', function (Request $request) {
        $request->user()->sendEmailVerificationNotification();
        return back()->with('message', 'Verification link sent!');
    })->middleware('throttle:6,1')->name('verification.send');

    Route::get('logout', [UserController::class, 'logout'])->name('logout');
});

Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('announcement/create', function () {
        return view('announcement.create');
    })->name('announcement.create');

    Route::get('user/delete/{id}', [UserController::class, 'delete'])->name('user.delete');
    Route::get('user/restore/{id}', [UserController::class, 'restore'])->name('user.restore');
});
