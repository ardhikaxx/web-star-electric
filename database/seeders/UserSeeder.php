<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        User::updateOrCreate(
            ['username' => 'admin'],
            [
                'name' => 'Administrator',
                'phone_number' => '081234567890',
                'pin' => Hash::make('2222'), // Hash the PIN
                'role' => 'admin',
                'is_active' => true,
                'email' => 'admin@arrrahman-ebike.local',
            ]
        );
    }
}

