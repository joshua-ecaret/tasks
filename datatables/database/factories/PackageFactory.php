<?php

namespace Database\Factories;

use App\Models\Package;
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
        $startDate = $this->faker->dateTimeBetween('now', '+1 week');
        $endMin = clone $startDate;
        $endMax = (clone $startDate)->modify('+1 week');
        $endDate = $this->faker->dateTimeBetween($endMin, $endMax);
        $applyRollover = $this->faker->boolean();
        return [
            'package_name' => $this->faker->name(),
            'credits' => $this->faker->randomDigitNotZero(),
            'credits_time_unit' => $this->faker->randomElement(['Per Month', 'Per Week']),
            'status' => $this->faker->randomElement(['Active', 'Inactive', 'Draft']),
            'apply_credit_rollover' => $applyRollover,
            'max_rollover_credits' => $applyRollover
                ? $this->faker->numberBetween(1, 100)
                : null,
            'start_date' => $startDate->format('Y-m-d'),
            'end_date' => $endDate->format('Y-m-d'),
        ];
    }
}