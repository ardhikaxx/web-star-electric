<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        User::updateOrCreate(
            ['username' => 'admin'],
            [
                'name' => 'Administrator',
                'phone_number' => '081234567890',
                'pin' => '1234',
                'role' => 'admin',
                'is_active' => true,
                'email' => 'admin@arrrahman-ebike.local',
            ]
        );
    }
}
