<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Article;
use Illuminate\Support\Str;
use App\Models\User;
use App\Models\Faculty;
use App\Models\Magazine;
/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\articles>
 */
class ArticleFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    protected $model = Article::class;

    public function definition(): array
    {
        return [
            'title' => $this->faker->sentence,
            'intro' => $this->faker->paragraph,
            'image' => 'articles/sample.jpeg', // This will generate a random image URL
            'content' => 'articles/Sample.docx', // This is a placeholder, replace with actual docx content
            'selected' => $this->faker->boolean,
            'published' => $this->faker->boolean,
            'anonymous' => $this->faker->boolean,
            'author_id' => rand(1, 150),
            'faculty_id' => rand(1, 10), 
            'magazine_id' => rand(1, 30),
        ];
    }
}
