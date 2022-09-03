<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Company>
 */
class CompanyFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'name' => fake()->unique(true)->company.' '.fake()->unique(true)->companySuffix.' '.Str::random(5),
            'email' => fake()->unique(true)->companyEmail,
            'website' => fake()->unique(true)->url().'/'.Str::random(),
        ];
    }
}
