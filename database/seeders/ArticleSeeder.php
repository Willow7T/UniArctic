<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use PhpOffice\PhpWord\IOFactory;
use App\Models\Articles;
use Illuminate\Support\Facades\Storage;

class ArticleSeeder extends Seeder
{
    
        public function run()
    {
        factory(App\Article::class, 50)->create(); // This will create 50 articles
    }
    

   
}
