<?php

namespace Tests\Feature;

use App\Livewire\IssueMagPanel;
use App\Models\Article;
use App\Models\Magazine;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Storage;
use Livewire\Livewire;
use Tests\TestCase;

class ExampleTest extends TestCase
{
    /**
     * A basic feature test example.
     */
    use RefreshDatabase;

    /** @test */
    public function it_downloads_a_zip_file_of_articles_for_a_given_year()
    {
        // Arrange
        Storage::fake('public');

        $user = User::factory()->create(['role_id' => 1]);
        $magazine = Magazine::factory()->create(['year' => 2022]);
        $articles = Article::factory()->count(5000)->create([
            'magazine_id' => $magazine->id,
            'published' => true,
            'content' => 'Test content'
        ]);

        foreach ($articles as $article) {
            Storage::disk('public')->put($article->content, 'This is a test article.');
        }
    
        // Act
        $component = Livewire::actingAs($user)->test(IssueMagPanel::class);
        $component->set('yeardown', 2022);
        $component->call('Yeardown');
    
        // Assert
        $zipFileName = storage_path('app/public/2022_articles.zip');
        $this->assertFileExists($zipFileName);
    
        foreach ($articles as $article) {
            $this->assertFileDoesNotExist(storage_path('app/public/' . $article->content));
        }
    }
}
