<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<User>
 */
class UserFactory extends Factory
{
    public function definition(): array
    {
        return [
            'name' => fake()->name(),
            'username' => fake()->unique()->userName(),
            'phone_number' => '08' . fake()->unique()->numerify('##########'),
            'pin' => '1234',
            'role' => 'employee',
            'is_active' => true,
            'email' => fake()->unique()->safeEmail(),
        ];
    }
}
