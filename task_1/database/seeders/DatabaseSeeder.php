<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Package;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        Package::factory(2)->create();


        /* User::factory()->create([ */
        /*     'name' => 'Test User', */
        /*     'email' => 'test@example.com', */
        /* ]); */
    }
}
