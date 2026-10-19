<?php

namespace App\Features\Home\Http\Controllers;

use App\Features\Shared\Http\Controllers\Controller;
use App\Features\Teams\Models\TeamMember;
use Illuminate\Contracts\View\View;

class HomeController extends Controller
{
    public function index(): View
    {
        return view('features.home.index', [
            'teamMembers' => TeamMember::query()->ordered()->get(),
        ]);
    }
}
