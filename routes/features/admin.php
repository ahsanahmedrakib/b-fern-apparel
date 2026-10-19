<?php

use App\Features\Admin\Http\Controllers\Auth\LoginController;
use App\Features\Admin\Http\Controllers\DashboardController;
use App\Features\Admin\Http\Controllers\MessageController;
use App\Features\Admin\Http\Controllers\TeamMemberController;
use Illuminate\Support\Facades\Route;

Route::prefix('admin')->name('admin.')->group(function () {
    Route::middleware('guest')->group(function () {
        Route::get('login', [LoginController::class, 'create'])->name('login');
        Route::post('login', [LoginController::class, 'store'])
            ->middleware('throttle:10,1')
            ->name('login.store');
    });

    Route::middleware('auth')->group(function () {
        Route::post('logout', [LoginController::class, 'destroy'])->name('logout');

        Route::get('/', DashboardController::class)->name('dashboard');

        Route::get('messages', [MessageController::class, 'index'])->name('messages.index');
        Route::get('messages/{contactMessage}', [MessageController::class, 'show'])->name('messages.show');
        Route::post('messages/{contactMessage}/read', [MessageController::class, 'toggleRead'])->name('messages.read');
        Route::delete('messages/{contactMessage}', [MessageController::class, 'destroy'])->name('messages.destroy');

        Route::get('team', [TeamMemberController::class, 'index'])->name('team.index');
        Route::get('team/create', [TeamMemberController::class, 'create'])->name('team.create');
        Route::post('team', [TeamMemberController::class, 'store'])->name('team.store');
        Route::get('team/{teamMember}/edit', [TeamMemberController::class, 'edit'])->name('team.edit');
        Route::put('team/{teamMember}', [TeamMemberController::class, 'update'])->name('team.update');
        Route::delete('team/{teamMember}', [TeamMemberController::class, 'destroy'])->name('team.destroy');
    });
});
