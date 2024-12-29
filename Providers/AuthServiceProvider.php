<?php

namespace App\Providers;

// use Illuminate\Support\Facades\Gate;

use App\Models\roles;
use App\Models\roles_permission;
use App\Models\User;
use App\Policies\PolicyAuther;
use App\Policies\PolicyName;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Routing\Route;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The model to policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        // 'App\Models\Model' => 'App\Policies\ModelPolicy',
        roles_permission::class => PolicyName::class,
        // roles_permission::class => PolicyAuther::class,


    ];

    /**
     * Register any authentication / authorization services.
     */
    public function boot(): void
    {
        $this->registerPolicies();
        Gate::define('is-Admin', function (User $user) {
            // Assuming you have a roles table and role_id in users table
            $role = roles::where('name', 'admin')->first();

            // Check if the user's role matches the admin role
            return $user->role_id == $role->id;
        });

        Gate::define('is-student', function (User $user) {

            $role = roles::where('name', 'student')->first();

            return $user->role_id == $role->id;
        });

        // Gate::define('viewAny',function(){

        //    return roles_permission::getPermission('categori', Auth::user()->role_id);

        // });
        // public function viewAny()
        // {
            // roles_permission::getPermission('categori', Auth::user()->role_id);
        // }

    }
}
