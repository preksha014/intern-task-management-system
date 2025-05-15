<?php

namespace App\Providers;

use App\Models\Permission;
use App\Models\User;
use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    public function boot()
    {
        Gate::before(function($user, $permission) {
            return $user->hasPermission($permission);
        });

        // $permissions = Permission::all();
        // foreach ($permissions as $permission) {
        //     Gate::define($permission->name, function (User $user) use ($permission) {
        //         // Super admin has access to all permissions
        //         if ($user->isSuperAdmin()) {
        //             return true;
        //         }
        //         return $user->hasPermission($permission->name);
        //     });
        // }
    }
}