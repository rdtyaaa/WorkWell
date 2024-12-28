<?php

namespace Database\Factories;

use App\Models\Company;
use App\Models\JobVacancy;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\JobVacancy>
 */
class JobVacancyFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    protected $model = JobVacancy::class;

    public function definition()
    {
        return [
            'position' => $this->faker->jobTitle(),
            'description' => $this->faker->paragraph(),
            'qualifications' => $this->faker->sentence(),
            'salary' => $this->faker->numberBetween(5000000, 20000000),
            'location' => $this->faker->city(),
            'company_id' => Company::factory(), 
        ];
    }
}
