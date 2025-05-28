<?php

namespace Database\Factories;

use App\Models\Package;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Resident>
 */
class ResidentFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'resident_name' => $this->faker->firstName(),
            'email' => $this->faker->unique()->safeEmail(),
            'phone' => $this->faker->phoneNumber(),
            'package_id' => Package::inRandomOrder()->value('id') ?? Package::factory(),
            'status' => $this->faker->randomElement(['Active', 'Inactive']),
            'gender' => $this->faker->randomElement(['Male', 'Female']),
            'is_citizen' => $this->faker->boolean(80),
        ];
    }
}
