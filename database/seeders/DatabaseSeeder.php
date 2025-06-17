<?php

namespace Database\Seeders;

use App\Models\Owner;
use App\Models\Patient;
use App\Models\Treatment;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        Owner::factory(10)->create();
        Patient::factory(10)->create();
        Treatment::factory(10)->create();
    }
}
