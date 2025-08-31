<?php

namespace Database\Seeders;

use App\Models\Role;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RolePermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $adminRole = Role::where('name', 'admin')->first();
        $adminRole->permissions()->attach([1, 2, 3, 4, 5, 6, 7]);
        $user = User::find(1);
        $user->roles()->attach($adminRole->id);
    }
}
