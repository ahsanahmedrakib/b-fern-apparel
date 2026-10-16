<?php

namespace App\Features\About\Http\Controllers;

use App\Features\Shared\Http\Controllers\Controller;
use Illuminate\Contracts\View\View;

class AboutController extends Controller
{
    public function index(): View
    {
        return view('features.about.index');
    }
}
