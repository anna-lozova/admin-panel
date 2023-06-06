<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

class RoleSeeder extends Seeder
{
    public function run(): void
    {
        $managerRole = Role::create(['name' => 'manager',]);
        $adminRole = Role::create(['name' => 'admin',]);
        $guestRole = Role::create(['name' => 'guest',]);
        User::first()->assignRole('admin');
    }
}
