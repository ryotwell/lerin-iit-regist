<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\User>
 */
class UserFactory extends Factory
{
    /**
     * The current password being used by the factory.
     */
    protected static ?string $password;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => fake()->domainName(),
            'email' => fake()->unique()->safeEmail(),
            'password' => static::$password ??= Hash::make('password'),
            'role' => 'user',

            // team information
            'agency' => 'Universitas Hamzanwadi',
            'robot_category' => Arr::random(['sumo', 'avoider']),
            'responsible_person_name' => fake()->name(),
            'whatsapp_number' => fake()->phoneNumber(),

            'participant_one_name' => fake()->name(),
            'participant_one_nim_or_nis' => fake()->randomNumber(9, true),
            'participant_two_name' => fake()->name(),
            'participant_two_nim_or_nis' => fake()->randomNumber(9, true),
        ];
    }

    /**
     * Indicate that the model's email address should be unverified.
     */
    public function unverified(): static
    {
        return $this->state(fn (array $attributes) => [
            'email_verified_at' => null,
        ]);
    }
}
