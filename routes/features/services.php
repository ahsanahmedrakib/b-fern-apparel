<?php

use App\Features\Services\Http\Controllers\ServicesController;
use Illuminate\Support\Facades\Route;

Route::get('/what-we-do', [ServicesController::class, 'index'])->name('services');
