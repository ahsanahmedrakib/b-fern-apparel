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
            ['name' => 'Jeffrey Charen', 'position' => 'Vice President', 'photo' => 'jeffrey-charen.jpg'],
            ['name' => 'Md. Akmol Hossain Raki', 'position' => 'QC Staffs', 'photo' => 'akmol-hossain-raki.jpeg'],
            ['name' => 'Md. Al Shakib', 'position' => 'QC Staffs', 'photo' => 'al-shakib.jpeg'],
            ['name' => 'Md. Fazlul Huque (Shopon)', 'position' => 'QC Staffs', 'photo' => 'fazlul-huque.jpeg'],
            ['name' => 'Md. Ibrahim', 'position' => 'QC Staffs', 'photo' => 'ibrahim.jpeg'],
            ['name' => 'Robiul Islam Hiron', 'position' => 'QC Staffs', 'photo' => 'robiul-islam-hiron.jpeg'],
            ['name' => 'Md. Sobuz Mia', 'position' => 'QC Staffs', 'photo' => 'sobuz-mia.jpeg'],
        ];

        foreach ($members as $member) {
            TeamMember::query()->updateOrCreate(
                ['photo' => $member['photo']],
                ['name' => $member['name'], 'position' => $member['position']],
            );
        }
    }
}
