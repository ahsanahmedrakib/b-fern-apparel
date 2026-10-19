<?php

namespace Database\Seeders;

use App\Features\Teams\Models\TeamMember;
use Illuminate\Database\Seeder;

class TeamMemberSeeder extends Seeder
{
    /**
     * Seed the team members that ship with the site. Names are derived from
     * the photo file names in public/images/teams.
     */
    public function run(): void
    {
        $members = [
            ['name' => 'Akmol Hossain Raki', 'photo' => 'akmol-hossain-raki.jpeg'],
            ['name' => 'Al Shakib', 'photo' => 'al-shakib.jpeg'],
            ['name' => 'Fazlul Huque', 'photo' => 'fazlul-huque.jpeg'],
            ['name' => 'Ibrahim', 'photo' => 'ibrahim.jpeg'],
            ['name' => 'Robiul Islam Hiron', 'photo' => 'robiul-islam-hiron.jpeg'],
            ['name' => 'Sobuz Mia', 'photo' => 'sobuz-mia.jpeg'],
        ];

        foreach ($members as $member) {
            TeamMember::query()->updateOrCreate(
                ['photo' => $member['photo']],
                ['name' => $member['name'], 'position' => 'QC Staffs'],
            );
        }
    }
}
