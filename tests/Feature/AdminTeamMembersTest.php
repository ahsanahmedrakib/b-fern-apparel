<?php

namespace Tests\Feature;

use App\Features\Teams\Models\TeamMember;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;

class AdminTeamMembersTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();

        Storage::fake('teams');
    }

    public function test_guests_cannot_manage_the_team(): void
    {
        $this->get(route('admin.team.index'))
            ->assertRedirect(route('admin.login'));
    }

    public function test_an_admin_can_view_the_team_list(): void
    {
        $member = TeamMember::factory()->create(['name' => 'Listed Member']);

        $this->actingAs(User::factory()->create())
            ->get(route('admin.team.index'))
            ->assertOk()
            ->assertSee('Listed Member')
            ->assertSee($member->position);
    }

    public function test_an_admin_can_add_a_team_member(): void
    {
        $photo = UploadedFile::fake()->image('portrait.jpg', 600, 750);

        $this->actingAs(User::factory()->create())
            ->post(route('admin.team.store'), [
                'name' => 'New Recruit',
                'position' => 'QC Staffs',
                'photo' => $photo,
            ])
            ->assertRedirect(route('admin.team.index'));

        $member = TeamMember::query()->sole();

        $this->assertSame('New Recruit', $member->name);
        $this->assertSame('QC Staffs', $member->position);
        Storage::disk('teams')->assertExists($member->photo);
    }

    public function test_a_team_member_requires_a_name_position_and_photo(): void
    {
        $this->actingAs(User::factory()->create())
            ->post(route('admin.team.store'), [])
            ->assertSessionHasErrors(['name', 'position', 'photo']);

        $this->assertDatabaseCount('team_members', 0);
    }

    public function test_an_admin_can_update_a_team_member_without_replacing_the_photo(): void
    {
        $member = TeamMember::factory()->create([
            'name' => 'Old Name',
            'photo' => 'existing.jpg',
        ]);

        $this->actingAs(User::factory()->create())
            ->put(route('admin.team.update', $member), [
                'name' => 'Updated Name',
                'position' => 'Lead QC',
            ])
            ->assertRedirect(route('admin.team.index'));

        $member->refresh();

        $this->assertSame('Updated Name', $member->name);
        $this->assertSame('Lead QC', $member->position);
        $this->assertSame('existing.jpg', $member->photo);
    }

    public function test_an_admin_can_replace_a_team_member_photo(): void
    {
        Storage::disk('teams')->put('old-photo.jpg', 'contents');

        $member = TeamMember::factory()->create(['photo' => 'old-photo.jpg']);
        $photo = UploadedFile::fake()->image('new-photo.jpg', 600, 750);

        $this->actingAs(User::factory()->create())
            ->put(route('admin.team.update', $member), [
                'name' => $member->name,
                'position' => $member->position,
                'photo' => $photo,
            ])
            ->assertRedirect(route('admin.team.index'));

        $member->refresh();

        Storage::disk('teams')->assertMissing('old-photo.jpg');
        Storage::disk('teams')->assertExists($member->photo);
        $this->assertNotSame('old-photo.jpg', $member->photo);
    }

    public function test_an_admin_can_remove_a_team_member(): void
    {
        Storage::disk('teams')->put('remove-me.jpg', 'contents');

        $member = TeamMember::factory()->create(['photo' => 'remove-me.jpg']);

        $this->actingAs(User::factory()->create())
            ->delete(route('admin.team.destroy', $member))
            ->assertRedirect(route('admin.team.index'));

        $this->assertDatabaseMissing('team_members', ['id' => $member->id]);
        Storage::disk('teams')->assertMissing('remove-me.jpg');
    }
}
