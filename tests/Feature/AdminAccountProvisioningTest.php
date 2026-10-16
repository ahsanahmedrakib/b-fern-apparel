<?php

namespace Tests\Feature;

use App\Features\Admin\Services\AdminAccountService;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Hash;
use Tests\TestCase;

class AdminAccountProvisioningTest extends TestCase
{
    use RefreshDatabase;

    public function test_it_creates_the_first_admin_from_config_when_no_users_exist(): void
    {
        config()->set('bfern.admin.name', 'Ops Team');
        config()->set('bfern.admin.email', 'ops@example.example');
        config()->set('bfern.admin.password', 'secret-password');

        $user = app(AdminAccountService::class)->ensureExistsFromConfig();

        $this->assertNotNull($user);
        $this->assertDatabaseHas('users', [
            'name' => 'Ops Team',
            'email' => 'ops@example.example',
        ]);
        $this->assertTrue(Hash::check('secret-password', $user->password));
    }

    public function test_it_does_not_create_a_user_when_one_already_exists(): void
    {
        User::factory()->create();

        $user = app(AdminAccountService::class)->ensureExistsFromConfig();

        $this->assertNull($user);
        $this->assertDatabaseCount('users', 1);
    }
}
