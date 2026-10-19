<?php

namespace Tests\Feature;

use App\Features\Teams\Models\TeamMember;
use Database\Seeders\TeamMemberSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class TeamPageTest extends TestCase
{
    use RefreshDatabase;

    public function test_the_team_page_lists_every_member(): void
    {
        $member = TeamMember::factory()->create([
            'name' => 'Jane Coordinator',
            'position' => 'QC Staffs',
        ]);

        $this->get(route('team'))
            ->assertOk()
            ->assertSee('Jane Coordinator')
            ->assertSee('QC Staffs')
            ->assertSee($member->photo)
            ->assertSee(asset('images/teams/'.$member->photo), false);
    }

    public function test_the_home_page_features_the_team_swiper(): void
    {
        $member = TeamMember::factory()->create([
            'name' => 'Swiper Member',
        ]);

        $this->get(route('home'))
            ->assertOk()
            ->assertSee('data-team-swiper', false)
            ->assertSee('data-team-pagination', false)
            ->assertSee('Swiper Member')
            ->assertSee(route('team'), false);
    }

    public function test_the_shipped_team_seeder_registers_every_photo(): void
    {
        $this->seed(TeamMemberSeeder::class);

        $this->assertDatabaseCount('team_members', 6);

        foreach (['akmol-hossain-raki.jpeg', 'al-shakib.jpeg', 'fazlul-huque.jpeg', 'ibrahim.jpeg', 'robiul-islam-hiron.jpeg', 'sobuz-mia.jpeg'] as $photo) {
            $this->assertDatabaseHas('team_members', ['photo' => $photo, 'position' => 'QC Staffs']);
        }
    }
}
