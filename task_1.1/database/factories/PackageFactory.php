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
        // Generate a random start date from today up to 1 month in the future
        $startDate = $this->faker->dateTimeBetween('now', '+1 month');

        // Generate an end date that is always after or equal to the start date (up to 3 months after)
        $endDate = $this->faker->dateTimeBetween($startDate, '+3 months');

        return [
            'package_name' =>(string) $this->faker->randomElement(['Starter', 'Pro', 'Premium', 'Basic', 'Advanced', 'Enterprise']) . ' ' .
                $this->faker->randomElement(['Plan', 'Package', 'Bundle', 'Subscription']),
            'credits' => $this->faker->numberBetween(1, 100),
            'credits_time_unit' => $this->faker->randomElement(['Per Month', 'Per Week']),
            'status' => $this->faker->randomElement(['Active', 'Inactive', 'Draft']),
            'apply_credit_rollover' => $this->faker->boolean(),
            'max_rollover_credits' => function (array $attributes) {
                return $attributes['apply_credit_rollover'] ? $this->faker->numberBetween(1, 50) : null;
            },
            'start_date' => $startDate->format('Y-m-d'),
            'end_date' => $endDate->format('Y-m-d'),
        ];
    }

}
