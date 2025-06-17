<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use App\Models\Owner;
use App\Models\Patient;

class PatientFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Patient::class;

    /**
     * Define the model's default state.
     */
    public function definition(): array
    {
        return [
            'date_of_birth' => fake()->date(),
            'name' => fake()->name(),
            'owner_id' => Owner::factory(),
            'type' => fake()->randomElement(['dog', 'cat', 'bird', 'reptile', 'other']),
        ];
    }
}
