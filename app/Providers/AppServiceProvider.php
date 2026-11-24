<?php

namespace App\Providers;

use App\Features\Admin\Services\AdminAccountService;
use App\Features\Contact\Models\ContactMessage;
use App\Features\Teams\Services\TeamMemberSeedService;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;
use Throwable;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        $this->ensureAdminAccountExists();
        $this->ensureTeamMembersExist();

        View::composer('layouts.admin', function ($view) {
            $view->with('unreadMessages', ContactMessage::query()->unread()->count());
        });
    }

    /**
     * Provision the first admin from the .env credentials when the users table
     * is still empty, so a fresh cPanel deploy can log in without a terminal.
     */
    protected function ensureAdminAccountExists(): void
    {
        if ($this->app->runningUnitTests()) {
            return;
        }

        try {
            $this->app->make(AdminAccountService::class)->ensureExistsFromConfig();
        } catch (Throwable) {
            //
        }
    }

    /**
     * Restore bundled team members and their photos after a deploy resets
     * uploads, without duplicating members added from the admin panel.
     */
    protected function ensureTeamMembersExist(): void
    {
        if ($this->app->runningUnitTests()) {
            return;
        }

        try {
            $this->app->make(TeamMemberSeedService::class)->seedMissing();
        } catch (Throwable) {
            //
        }
    }
}
