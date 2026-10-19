<?php

namespace Database\Factories;

use App\Features\Teams\Models\TeamMember;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<TeamMember>
 */
class TeamMemberFactory extends Factory
{
    protected $model = TeamMember::class;

    /**
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => fake()->name(),
            'position' => 'QC Staffs',
            'photo' => fake()->uuid().'.jpg',
        ];
    }
}
