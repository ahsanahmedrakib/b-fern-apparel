<?php

namespace App\Features\Locations\Http\Controllers;

use App\Features\Shared\Http\Controllers\Controller;
use Illuminate\Contracts\View\View;

class LocationsController extends Controller
{
    public function index(): View
    {
        return view('features.locations.index');
    }
}
