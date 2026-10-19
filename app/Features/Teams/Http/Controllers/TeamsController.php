<?php

namespace App\Features\Teams\Http\Controllers;

use App\Features\Shared\Http\Controllers\Controller;
use App\Features\Teams\Models\TeamMember;
use Illuminate\Contracts\View\View;

class TeamsController extends Controller
{
    public function index(): View
    {
        return view('features.teams.index', [
            'teamMembers' => TeamMember::query()->ordered()->get(),
        ]);
    }
}
