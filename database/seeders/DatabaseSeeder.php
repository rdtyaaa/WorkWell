<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\JobVacancy;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        JobVacancy::factory(20)->create();
        User::factory(20)->create();
    }
}
