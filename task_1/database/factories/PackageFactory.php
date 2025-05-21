<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Package>
 */
class PackageFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'package_name' => $this->faker->randomElement(['Starter', 'Pro', 'Premium', 'Basic', 'Advanced', 'Enterprise']) . ' ' .
                 $this->faker->randomElement(['Plan', 'Package', 'Bundle', 'Subscription']),
            'credits' => $this->faker->numberBetween(1, 100),
            'credits_time_unit' => $this->faker->randomElement(['Per Month', 'Per Week']),
            'status' => $this->faker->randomElement(['Active', 'Inactive', 'Draft']),
            'apply_credit_rollover' => $this->faker->boolean(),
            'max_rollover_credits' => function (array $attributes) {
                // If apply_credit_rollover is true, provide a number; else null
                return $attributes['apply_credit_rollover'] ? $this->faker->numberBetween(1, 50) : null;
            },
        ];
    }
}
