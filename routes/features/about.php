<?php

use App\Features\About\Http\Controllers\AboutController;
use Illuminate\Support\Facades\Route;

Route::get('/about', [AboutController::class, 'index'])->name('about');
