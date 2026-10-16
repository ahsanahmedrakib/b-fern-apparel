<?php

use App\Features\Locations\Http\Controllers\LocationsController;
use Illuminate\Support\Facades\Route;

Route::get('/global-presence', [LocationsController::class, 'index'])->name('locations');
