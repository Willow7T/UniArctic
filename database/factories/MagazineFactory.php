<?php

namespace Database\Factories;

use App\Models\Magazine;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Magazine>
 */
class MagazineFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    protected $model = Magazine::class;

    public function definition(): array
    {
        return [
            'issue_name' => $this->faker->word,
            'year' => 2023,
            'month' => $this->faker->numberBetween(1, 12),
            'published' => false,
        ];
    }
}
