<?php

use App\Features\Teams\Http\Controllers\TeamsController;
use Illuminate\Support\Facades\Route;

Route::get('/team', [TeamsController::class, 'index'])->name('team');
