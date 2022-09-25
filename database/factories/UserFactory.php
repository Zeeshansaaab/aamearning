<?php

namespace Database\Factories;

use App\Models\Plan;
use App\Models\User;
use Illuminate\Support\Arr;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\User>
 */
class UserFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'firstname' => fake()->firstname(),
            'lastname' => fake()->lastname(),
            'username' => fake()->firstname(),
            'uuid' => \getUserId(),
            'ref_by' => Arr::random(User::all()->pluck('id')->toArray()),
            'country_code' => '+92',
            'mobile' => fake()->numerify('##-###-#######'),
            'email' => fake()->safeEmail(),
            'email_verified_at' => now(),
            'user_type' => Arr::random(['user', 'staff']),
            'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
            'remember_token' => Str::random(10),
        ];
    }

    /**
     * Indicate that the model's email address should be unverified.
     *
     * @return static
     */
    public function unverified()
    {
        return $this->state(function (array $attributes) {
            return [
                'email_verified_at' => null,
            ];
        });
    }
}
