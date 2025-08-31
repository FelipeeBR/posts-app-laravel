<?php

namespace Database\Seeders;

use App\Models\Permission;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $permissions = [
            [
                'name' => 'create_post',
            ],
            [
                'name' => 'edit_post',
            ],
            [
                'name' => 'delete_post',
            ],
            [
                'name' => 'create_tag',
            ],
            [
                'name' => 'edit_tag',
            ],
            [
                'name' => 'delete_tag',
            ],
            [
                'name' => 'create_permission',
            ]
        ];

        if(Permission::count() > 0) {
            return;
        }

        foreach ($permissions as $permission) {
            Permission::create($permission);
        }
    }
}
