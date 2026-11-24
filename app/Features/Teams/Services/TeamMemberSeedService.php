<?php

namespace App\Features\Teams\Services;

use App\Features\Teams\Models\TeamMember;
use Illuminate\Support\Facades\Schema;

class TeamMemberSeedService
{
    /**
     * Members that ship with the site. Their photos are committed to the
     * repository, so they survive Clever Cloud's per-deploy filesystem reset.
     *
     * @return list<array{name: string, position: string, photo: string}>
     */
    public function members(): array
    {
        return [
            ['name' => 'Jeffrey Charen', 'position' => 'President', 'photo' => 'jeffrey-charen.jpg'],
            ['name' => 'Md. Akmol Hossain Raki', 'position' => 'QC Staffs', 'photo' => 'akmol-hossain-raki.jpeg'],
            ['name' => 'Md. Al Shakib', 'position' => 'QC Staffs', 'photo' => 'al-shakib.jpeg'],
            ['name' => 'Md. Fazlul Huque (Shopon)', 'position' => 'QC Staffs', 'photo' => 'fazlul-huque.jpeg'],
            ['name' => 'Md. Ibrahim', 'position' => 'QC Staffs', 'photo' => 'ibrahim.jpeg'],
            ['name' => 'Robiul Islam Hiron', 'position' => 'QC Staffs', 'photo' => 'robiul-islam-hiron.jpeg'],
            ['name' => 'Md. Sobuz Mia', 'position' => 'QC Staffs', 'photo' => 'sobuz-mia.jpeg'],
        ];
    }

    /**
     * Seed the default members when the admin has not created any yet.
     *
     * This runs on every request (see AppServiceProvider) so a fresh deploy
     * with an empty table — or one whose uploads were wiped — still shows the
     * bundled team instead of an empty section.
     */
    public function seedMissing(): void
    {
        if (! Schema::hasTable('team_members') || TeamMember::query()->exists()) {
            return;
        }

        $this->seed();
    }

    public function seed(): void
    {
        foreach ($this->members() as $member) {
            TeamMember::query()->firstOrCreate(
                ['photo' => $member['photo']],
                [
                    'name' => $member['name'],
                    'position' => $member['position'],
                    'is_active' => true,
                ],
            );
        }
    }
}
