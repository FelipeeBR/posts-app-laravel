<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $users = [
            [
                'name' => 'John Doe',
                'email' => 'LbHj0@example.com',
                'password' => bcrypt('password'),
            ],
        ];

        if(User::count() > 0) {
            return;
        }

        foreach ($users as $user) {
            User::create($user);
        }
    }
}
