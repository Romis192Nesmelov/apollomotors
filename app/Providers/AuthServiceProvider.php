<?php

namespace App\Providers;
use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The model to policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        //
    ];

    /**
     * Register any authentication / authorization services.
     */
    public function boot(): void
    {
        $this->registerPolicies();

        Gate::define('view', function ($user) {
            return $user->type > 0;
        });

        Gate::define('edit', function ($user) {
            return $user->type >= 2;
        });

        Gate::define('delete', function ($user) {
            return $user->type >= 3;
        });

        Gate::define('owner', function ($user, $record) {
            return $user->type > 2 || $user->id == $record->user_id;
        });

        Gate::define('all', function ($user) {
            return $user->type == 4;
        });

        Gate::define('records', function ($user) {
            return $user->type == 4 || $user->type === 0;
        });
    }
}
