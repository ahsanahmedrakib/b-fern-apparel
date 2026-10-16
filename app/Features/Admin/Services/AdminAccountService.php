<?php

namespace App\Features\Admin\Services;

use App\Models\User;
use Illuminate\Support\Facades\Schema;

class AdminAccountService
{
    /**
     * Create the admin account from config when no users exist yet.
     *
     * This lets a fresh cPanel deployment (which has no terminal to run the
     * seeder) provision the first login straight from the .env credentials.
     */
    public function ensureExistsFromConfig(): ?User
    {
        if (! Schema::hasTable('users') || User::query()->exists()) {
            return null;
        }

        return User::query()->create([
            'name' => config('bfern.admin.name'),
            'email' => config('bfern.admin.email'),
            'password' => config('bfern.admin.password'),
        ]);
    }
}
