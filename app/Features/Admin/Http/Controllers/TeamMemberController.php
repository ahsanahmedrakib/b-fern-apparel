<?php

namespace App\Features\Admin\Http\Controllers;

use App\Features\Admin\Http\Requests\StoreTeamMemberRequest;
use App\Features\Admin\Http\Requests\UpdateTeamMemberRequest;
use App\Features\Shared\Http\Controllers\Controller;
use App\Features\Teams\Models\TeamMember;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Storage;

class TeamMemberController extends Controller
{
    public function index(): View
    {
        return view('features.admin.team.index', [
            'teamMembers' => TeamMember::query()->ordered()->paginate(12),
        ]);
    }

    public function create(): View
    {
        return view('features.admin.team.create', [
            'teamMember' => new TeamMember,
        ]);
    }

    public function store(StoreTeamMemberRequest $request): RedirectResponse
    {
        TeamMember::query()->create([
            'name' => $request->validated('name'),
            'position' => $request->validated('position'),
            'photo' => $request->file('photo')->store('', 'teams'),
        ]);

        return redirect()
            ->route('admin.team.index')
            ->with('status', 'Team member added.');
    }

    public function edit(TeamMember $teamMember): View
    {
        return view('features.admin.team.edit', [
            'teamMember' => $teamMember,
        ]);
    }

    public function update(UpdateTeamMemberRequest $request, TeamMember $teamMember): RedirectResponse
    {
        $teamMember->name = $request->validated('name');
        $teamMember->position = $request->validated('position');

        if ($request->hasFile('photo')) {
            Storage::disk('teams')->delete($teamMember->photo);
            $teamMember->photo = $request->file('photo')->store('', 'teams');
        }

        $teamMember->save();

        return redirect()
            ->route('admin.team.index')
            ->with('status', 'Team member updated.');
    }

    public function destroy(TeamMember $teamMember): RedirectResponse
    {
        Storage::disk('teams')->delete($teamMember->photo);

        $teamMember->delete();

        return redirect()
            ->route('admin.team.index')
            ->with('status', 'Team member removed.');
    }
}
