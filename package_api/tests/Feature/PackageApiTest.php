<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use Carbon\Carbon;
use App\Models\Package;

class PackageApiTest extends TestCase
{
    use RefreshDatabase;

    /** Returns valid default data */
    private function validData(): array
    {
        return [
            'package_name' => 'Basic Plan',
            'credits' => 10,
            'credits_time_unit' => 'Per Month',
            'status' => 'Active',
            'apply_credit_rollover' => true,
            'max_rollover_credits' => 5,
            'start_date' => now()->addDay()->format('Y-m-d'),
            'end_date' => now()->addDays(10)->format('Y-m-d'),
        ];
    }

    /** INDEX - list packages */
    public function test_index_returns_data()
    {
        Package::factory()->count(3)->create();

        $response = $this->getJson('/api/packages');

        $response->assertStatus(200)
                 ->assertJsonCount(3, 'data'); // Assuming PackageResource wraps in data key
    }

    /** STORE - success */
    public function test_store_package_success()
    {
        $response = $this->postJson('/api/packages', $this->validData());

        $response->assertStatus(201)
                 ->assertJsonFragment(['name' => 'Basic Plan']);
        $this->assertDatabaseHas('packages', ['package_name' => 'Basic Plan']);
    }

    /** STORE - validation errors */
    #[\PHPUnit\Framework\Attributes\DataProvider('invalidStorePackageData')]
    public function test_store_package_validation_errors(array $overrides, ?string $errorKey)
    {
        $response = $this->postJson('/api/packages', array_merge($this->validData(), $overrides));

        $response->assertStatus(422);

        if ($errorKey) {
            $response->assertJsonValidationErrors($errorKey);
        }
    }

    public static function invalidStorePackageData(): array
    {
        return [
            'missing package_name' => [['package_name' => null], 'package_name'],
            'long package_name' => [['package_name' => str_repeat('a', 256)], 'package_name'],
            'non-integer credits' => [['credits' => 'abc'], 'credits'],
            'credits below min' => [['credits' => 0], 'credits'],
            'invalid credits_time_unit' => [['credits_time_unit' => 'Per Year'], 'credits_time_unit'],
            'invalid status' => [['status' => 'Archived'], 'status'],
            'non-boolean rollover' => [['apply_credit_rollover' => 'yes'], 'apply_credit_rollover'],
            'missing max_rollover_credits when required' => [['apply_credit_rollover' => true, 'max_rollover_credits' => null], 'max_rollover_credits'],
            'max_rollover_credits too low' => [['apply_credit_rollover' => true, 'max_rollover_credits' => 0], 'max_rollover_credits'],
            'max_rollover_credits when false' => [['apply_credit_rollover' => false, 'max_rollover_credits' => 0], 'max_rollover_credits'],
            'max_rollover_credits ' => [[ 'max_rollover_credits' => 0], 'max_rollover_credits'],
            'invalid start_date format' => [['start_date' => '01-01-2024'], 'start_date'],
            'start_date in past' => [['start_date' => Carbon::yesterday()->format('Y-m-d')], 'start_date'],
            'start_date after end date' => [['end_date' => Carbon::now()->addDays(2)->format('Y-m-d'),'start_date'=>Carbon::now()->addDays(3)->format('Y-m-d')], 'end_date'],
            'end_date before start_date' => [['start_date' => now()->addDays(5)->format('Y-m-d'), 'end_date' => now()->addDays(2)->format('Y-m-d')], 'end_date'],
        ];
    }

    /** UPDATE - success */
    public function test_update_package_success()
    {
        $package = Package::factory()->create();

        $response = $this->putJson("/api/packages/{$package->id}", $this->validData());

        $response->assertStatus(200)
                 ->assertJsonFragment(['name' => 'Basic Plan']);
        $this->assertDatabaseHas('packages', ['id' => $package->id, 'package_name' => 'Basic Plan']);
    }

    /** UPDATE - validation errors */
    #[\PHPUnit\Framework\Attributes\DataProvider('invalidUpdatePackageData')]
    public function test_update_package_validation_errors(array $overrides, ?string $errorKey)
    {
        $package = Package::factory()->create();

        $response = $this->putJson("/api/packages/{$package->id}", array_merge($this->validData(), $overrides));

        $response->assertStatus(422);

        if ($errorKey) {
            $response->assertJsonValidationErrors($errorKey);
        }
    }

    public static function invalidUpdatePackageData(): array
    {
        return [
            'long package_name' => [['package_name' => str_repeat('a', 256)], 'package_name'],
            'non-integer credits' => [['credits' => 'abc'], 'credits'],
            'credits below min' => [['credits' => 0], 'credits'],
            'invalid credits_time_unit' => [['credits_time_unit' => 'Per Year'], 'credits_time_unit'],
            'invalid status' => [['status' => 'Archived'], 'status'],
            'non-boolean rollover' => [['apply_credit_rollover' => 'yes'], 'apply_credit_rollover'],
            'missing max_rollover_credits when required' => [['apply_credit_rollover' => true, 'max_rollover_credits' => null], 'max_rollover_credits'],
            'max_rollover_credits too low' => [['apply_credit_rollover' => true, 'max_rollover_credits' => 0], 'max_rollover_credits'],
            'invalid start_date format' => [['start_date' => '01-01-2024'], 'start_date'],
            'start_date in past' => [['start_date' => Carbon::yesterday()->format('Y-m-d')], 'start_date'],
            'end_date before start_date' => [['start_date' => now()->addDays(5)->format('Y-m-d'), 'end_date' => now()->addDays(2)->format('Y-m-d')], 'end_date'],
        ];
    }

    /** DELETE - success */
    public function test_destroy_package_success()
    {
        $package = Package::factory()->create();

        $response = $this->deleteJson("/api/packages/{$package->id}");

        $response->assertStatus(204);
        $this->assertDatabaseMissing('packages', ['id' => $package->id]);
    }

    /** DELETE - non-existing package */
    public function test_destroy_package_not_found()
    {
        $response = $this->deleteJson('/api/packages/999999'); // unlikely to exist

        $response->assertStatus(404);
    }
}
