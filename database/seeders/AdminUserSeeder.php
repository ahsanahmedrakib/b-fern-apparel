<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class AdminUserSeeder extends Seeder
{
    public function run(): void
    {
        $email = config('bfern.admin.email');

        User::query()->updateOrCreate(
            ['email' => $email],
            [
                'name' => config('bfern.admin.name'),
                'password' => config('bfern.admin.password'),
            ],
        );

        $this->command->info("Admin user ready: {$email}");
    }
}
