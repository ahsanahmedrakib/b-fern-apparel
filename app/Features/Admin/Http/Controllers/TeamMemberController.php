<?php

namespace App\Features\Admin\Http\Controllers;

use App\Features\Admin\Http\Requests\StoreTeamMemberRequest;
use App\Features\Admin\Http\Requests\UpdateTeamMemberRequest;
use App\Features\Shared\Http\Controllers\Controller;
use App\Features\Teams\Models\TeamMember;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class TeamMemberController extends Controller
{
    public function index(Request $request): View
    {
        $editingMember = null;

        if ($editingId = $request->old('team_member_id')) {
            $editingMember = TeamMember::query()->find($editingId);
        }

        return view('features.admin.team.index', [
            'teamMembers' => TeamMember::query()->ordered()->paginate(12)->withQueryString(),
            'editingMember' => $editingMember,
        ]);
    }

    public function store(StoreTeamMemberRequest $request): RedirectResponse
    {
        TeamMember::query()->create([
            'name' => $request->validated('name'),
            'position' => $request->validated('position'),
            'photo' => $request->file('photo')->store('', 'teams'),
            'is_active' => $request->boolean('is_active', true),
        ]);

        return redirect()
            ->route('admin.team.index')
            ->with('status', 'Team member added.');
    }

    public function update(UpdateTeamMemberRequest $request, TeamMember $teamMember): RedirectResponse
    {
        $teamMember->name = $request->validated('name');
        $teamMember->position = $request->validated('position');
        $teamMember->is_active = $request->boolean('is_active', $teamMember->is_active);

        if ($request->hasFile('photo')) {
            Storage::disk('teams')->delete($teamMember->photo);
            $teamMember->photo = $request->file('photo')->store('', 'teams');
        }

        $teamMember->save();

        return redirect()
            ->route('admin.team.index')
            ->with('status', 'Team member updated.');
    }

    public function toggleActive(TeamMember $teamMember): RedirectResponse
    {
        $teamMember->update(['is_active' => ! $teamMember->is_active]);

        return redirect()
            ->route('admin.team.index')
            ->with('status', $teamMember->is_active
                ? 'Team member is now active and visible on the website.'
                : 'Team member is now inactive and hidden from the website.');
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
