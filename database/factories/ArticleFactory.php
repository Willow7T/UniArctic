<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Article;
use Illuminate\Support\Str;
use App\Models\User;
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
    {$magazine = Magazine::factory()->create();

        return [
            'title' => $this->faker->sentence,
            'intro' => $this->faker->paragraph,
            'image' => 'articles/sample.jpeg', // This will generate a random image URL
            'content' => 'articles/Sample.docx', // This is a placeholder, replace with actual docx content
            'selected' => $magazine->published,
            'published' => $magazine->published,
            'anonymous' => $this->faker->boolean,
            'author_id' => User::factory()->create()->id,
            'faculty_id' => rand(1, 10), 
            'magazine_id' => $magazine->id,            
        ];
    }
}
