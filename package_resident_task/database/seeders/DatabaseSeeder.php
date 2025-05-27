<?php

namespace Database\Seeders;

use App\Models\Package;
use App\Models\Resident;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        Package::factory(5)->create();
        Resident::factory(10)->create();

    }
}
