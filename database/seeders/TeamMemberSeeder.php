<?php

namespace Database\Seeders;

use App\Features\Teams\Services\TeamMemberSeedService;
use Illuminate\Database\Seeder;

class TeamMemberSeeder extends Seeder
{
    /**
     * Seed the team members that ship with the site. Names are derived from
     * the photo file names in public/images/teams.
     */
    public function run(): void
    {
        app(TeamMemberSeedService::class)->seed();
    }
}
