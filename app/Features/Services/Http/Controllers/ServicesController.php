<?php

namespace App\Features\Services\Http\Controllers;

use App\Features\Shared\Http\Controllers\Controller;
use Illuminate\Contracts\View\View;

class ServicesController extends Controller
{
    public function index(): View
    {
        return view('features.services.index');
    }
}
