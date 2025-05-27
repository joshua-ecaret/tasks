<?php

namespace Tests\Feature;

use App\Models\Package;
use Carbon\Carbon;
use Database\Factories\PackageFactory;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class PackageTest extends TestCase
{


    use RefreshDatabase;

    public static function invalidPackageData(): array
    {
        return [
            'missing package_name' => [['package_name' => null], 'package_name'],
            'long package_name' => [['package_name' => str_repeat('a', 256)], 'package_name'],
            'non-integer credits' => [['credits' => 'abc'], 'credits'],
            'credits below min' => [['credits' => 0], 'credits'],
            'invalid credits_time_unit' => [['credits_time_unit' => 'Per Year'], 'credits_time_unit'],
            'invalid status' => [['status' => 'Archived'], 'status'],
            'missing max_rollover_credits when required' => [['apply_credit_rollover' => true, 'max_rollover_credits' => null], 'max_rollover_credits'],
            'max_rollover_credits too low' => [['apply_credit_rollover' => true, 'max_rollover_credits' => 0], 'max_rollover_credits'],
            'invalid start_date format' => [['start_date' => '01-01-2024'], 'start_date'],
            'start_date in past' => [['start_date' => Carbon::yesterday()->format('Y-m-d')], 'start_date'],
            'start_date after end date' => [['end_date' => now()->addDays(2)->format('Y-m-d'), 'start_date' => now()->addDays(3)->format('Y-m-d')], 'end_date'],
            'end_date before start_date' => [['start_date' => now()->addDays(5)->format('Y-m-d'), 'end_date' => now()->addDays(2)->format('Y-m-d')], 'end_date'],
        ];
    }

    public function test_index_displays_packages()
    {
        $packages = Package::factory()->count(3)->create();

        $response = $this->get('/packages');

        $response->assertStatus(200);
        $response->assertViewIs('packages.index');
        $response->assertViewHas('packages', function ($viewPackages) use ($packages) {
            return $viewPackages->count() === 3;
        });
    }
    public function test_index_displays_no_packages()
    {
        $response = $this->get('/packages');

        $response->assertStatus(200);
        $response->assertViewIs('packages.index');
        $response->assertViewHas('packages', function ($viewPackages) {
            return $viewPackages->isEmpty();
        });
    }
    public function test_get_single_package()
    {
        $package = Package::factory()->create();

        $response = $this->getJson("packages/{$package->id}");

        $response->assertStatus(200)
            ->assertJsonFragment(['id' => $package->id, 'name' => $package->package_name]);
    }
    public function test_store_package(): void
    {
        $packageData = Package::factory()->create()->toArray();
        $response = $this->postJson('/packages', $packageData);

        $response->assertStatus(201)->assertJsonFragment(['message' => 'Package created successfully']);
        $this->assertDatabaseHas('packages', $packageData);
    }



    #[\PHPUnit\Framework\Attributes\DataProvider('invalidPackageData')]
    public function test_store_package_validation_errors(array $overrides, ?string $errorKey)
    {
        $response = $this->postJson('packages', array_merge(Package::factory(1)->make()->toArray(), $overrides));

        $response->assertStatus(422);

        if ($errorKey) {
            $response->assertJsonValidationErrors($errorKey);
        }
    }

    public function test_update_valid_package()
    {
        $package = Package::factory()->create();
        $updateData = [
            'package_name' => 'Updated Package Name',
            'credits' => 200,
            'apply_credit_rollover' => true,
            'max_rollover_credits' => 50,
        ];
        $response = $this->putJson("/packages/{$package->id}", $updateData);

        $response->assertStatus(200)->assertJsonFragment(['message' => 'Package updated successfully']);
        $this->assertDatabaseHas('packages', ['id' => $package->id] + $updateData);
    }



    #[\PHPUnit\Framework\Attributes\DataProvider('invalidPackageData')]
    public function test_update_package_validation_errors(array $overrides, ?string $errorKey)
    {
        $package = Package::factory()->create();

        $response = $this->putJson("packages/{$package->id}", array_merge(Package::factory(1)->make()->toArray(), $overrides));

        $response->assertStatus(422);

        if ($errorKey) {
            $response->assertJsonValidationErrors($errorKey);
        }
    }

    public function test_destroy_package_success()
    {
        $package = Package::factory()->create();

        $response = $this->delete("packages/{$package->id}");

        $this->assertSoftDeleted(
            'packages',
            ['id' => $package->id]
        );
        $response->assertStatus(302);
        $response->assertRedirect(route('packages.index'));
    }
    public function test_update_package_not_found()
    {
        $response = $this->deleteJson('packages/999999'); // unlikely to exist

        $response->assertStatus(404);
    }
    public function test_destroy_package_not_found()
    {
        $response = $this->deleteJson('/api/packages/999999'); // unlikely to exist

        $response->assertStatus(404);
    }
}
