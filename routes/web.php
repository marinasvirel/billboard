<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Http\Request;

Route::get('/', function () {
    return view('home');
})->name('home');

Route::middleware('guest')->group(function () {
    Route::controller(UserController::class)->group(function () {
        Route::get('register', 'create')->name('register');
        Route::post('register', 'store')->name('user.store');
        Route::get('login', 'login')->name('login');
        Route::post('login', 'authenticate')->name('user.authenticate');
        Route::post('/forgot-password', 'forgotPasswordStore')->name('password.email');
        Route::post('/reset-password', 'resetPasswordUpdate')->name('password.update');
    });

    Route::get('/forgot-password', function () {
        return view('user.forgot-password');
    })->name('password.request');

    Route::get('/reset-password/{token}', function (string $token) {
        return view('user.reset-password', ['token' => $token]);
    })->name('password.reset');
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

Route::middleware(['auth', 'verified', 'check.banned'])->group(function () {
    Route::controller(UserController::class)->group(function () {
        Route::get('profile', 'profile')->name('profile');
        Route::get('announcement/create', 'announcementCreate')->name('announcement.create');
    });

    Route::middleware('admin')->prefix('admin')->group(function () {
        Route::controller(AdminController::class)->group(function () {
            Route::get('/', 'index')->name('admin');
            Route::prefix('bearers')->group(function () {
                Route::get('/', 'bearersView')->name('bearers');
                Route::get('/{id}/edit', 'bearersEdit')->name('bearers.edit');
                Route::post('/{id}', 'bearersUpdate')->name('bearers.update');
                Route::post('/{user}/ban', 'ban')->name('admin.ban');
                Route::post('/{user}/unban', 'unban')->name('admin.unban');
            });
            Route::prefix('announcements')->group(function () {
                Route::get('/', 'announcementsView')->name('announcements');
            });
        });
    });
});

// Route::get('user/delete/{id}', [UserController::class, 'delete'])->name('user.delete');
// Route::get('user/restore/{id}', [UserController::class, 'restore'])->name('user.restore');
