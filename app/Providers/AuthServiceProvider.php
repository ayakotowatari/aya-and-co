<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        // 'App\Model' => 'App\Policies\ModelPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        //Only institution admin can access.
        Gate::define('admin', function($user){
            return $user -> user_type_id == 5 || 6;
        });

        Gate::define('super-admin', function($user){
            return $user -> user_type_id == 5;
        });

        Gate::define('normal-user', function($user){
            return $user -> user_type_id == 1 || 2;
        });

        //
    }
}
