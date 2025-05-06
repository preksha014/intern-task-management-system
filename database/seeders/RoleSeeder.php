<?php

namespace Database\Seeders;

use App\Models\Role;
use App\Models\Permission;
use Illuminate\Database\Seeder;

class RoleSeeder extends Seeder
{
    public function run()
    {
        // Create Admin Role
        $adminRole = Role::create(['name' => 'admin', 'description' => 'Administrator Role']);
        $adminRole->permissions()->attach(
            Permission::whereIn('name', ['create-task', 'edit-task', 'delete-task', 'assign-task', 'view-all-tasks', 'manage-users'])->pluck('id')
        );

        // Create Intern Role
        $internRole = Role::create(['name' => 'intern', 'description' => 'Intern Role']);
        $internRole->permissions()->attach(
            Permission::whereIn('name', ['view-all-tasks'])->pluck('id')
        );
    }
}