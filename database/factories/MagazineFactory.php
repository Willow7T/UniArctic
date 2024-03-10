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
    {   $year = [2022,2023,2024][rand(0,2)];
        $month = $year === 2024 && date('Y') == 2024 ? $this->faker->numberBetween(1, date('n')) : $this->faker->numberBetween(1, 12);
        
        return [
            'issue_name' => $this->faker->word,
            'year' => $year,
            'month' => $month,
            'published' => $this->faker->boolean,
        ];
    }
}
