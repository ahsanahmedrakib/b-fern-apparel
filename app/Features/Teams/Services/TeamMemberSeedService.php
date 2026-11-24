<?php

namespace App\Features\Teams\Services;

use App\Features\Teams\Models\TeamMember;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\Storage;

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
            ['name' => 'Brad Fern', 'position' => 'President', 'photo' => 'brad-fern.jpg'],
            ['name' => 'Md. Akmol Hossain Raki', 'position' => 'QC Staffs', 'photo' => 'akmol-hossain-raki.jpeg'],
            ['name' => 'Md. Al Shakib', 'position' => 'QC Staffs', 'photo' => 'al-shakib.jpeg'],
            ['name' => 'Md. Fazlul Huque (Shopon)', 'position' => 'QC Staffs', 'photo' => 'fazlul-huque.jpeg'],
            ['name' => 'Md. Ibrahim', 'position' => 'QC Staffs', 'photo' => 'ibrahim.jpeg'],
            ['name' => 'Robiul Islam Hiron', 'position' => 'QC Staffs', 'photo' => 'robiul-islam-hiron.jpeg'],
            ['name' => 'Md. Sobuz Mia', 'position' => 'QC Staffs', 'photo' => 'sobuz-mia.jpeg'],
            ['name' => 'S.M. Nure Azam', 'position' => 'QC Staffs', 'photo' => 's-m-nure-azam.jpeg'],
            ['name' => 'Md. Abdul Kader', 'position' => 'QC Staffs', 'photo' => 'md-abdul-kader.jpeg'],
        ];
    }

    /**
     * Ensure every bundled member exists with a committed photo.
     *
     * Runs on every request (see AppServiceProvider) so a deploy that wipes
     * uploads restores the bundled photos without duplicating or removing
     * members added from the admin panel.
     */
    public function seedMissing(): void
    {
        $this->syncBundledMembers();
    }

    public function seed(): void
    {
        $this->syncBundledMembers();
    }

    private function syncBundledMembers(): void
    {
        if (! Schema::hasTable('team_members')) {
            return;
        }

        $existingMembers = TeamMember::query()->get()->keyBy(
            fn (TeamMember $member): string => $this->normalizeName($member->name),
        );

        foreach ($this->members() as $member) {
            $existing = $existingMembers->get($this->normalizeName($member['name']));

            if ($existing === null) {
                TeamMember::query()->create([
                    'name' => $member['name'],
                    'position' => $member['position'],
                    'photo' => $member['photo'],
                    'is_active' => true,
                ]);

                continue;
            }

            if (! Storage::disk('teams')->exists($existing->photo)) {
                $existing->update(['photo' => $member['photo']]);
            }
        }
    }

    private function normalizeName(string $name): string
    {
        return preg_replace('/[^a-z0-9]/', '', mb_strtolower($name)) ?? '';
    }
}
