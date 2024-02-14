<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use PhpOffice\PhpWord\IOFactory;
use App\Models\Articles;
use Illuminate\Support\Facades\Storage;

class ArticlesSeeder extends Seeder
{
    public function run()
    {
        // Directory containing .docx files
        $docxDirectory = storage_path('app/articles');

        // Loop through each .docx file
        $docxFiles = scandir($docxDirectory);
        foreach ($docxFiles as $file) {
            if ($file === '.' || $file === '..') {
                continue;
            }

            $docxContent = Storage::get('articles/' . $file);
            $content = $this->convertDocxToText($docxContent);

            // Create an article with the extracted content
            Article::create([
                'title' => pathinfo($file, PATHINFO_FILENAME),
                'content' => $content,
            ]);
        }
    }

    private function convertDocxToText($docxContent)
    {
        $phpWord = IOFactory::loadFromBlob($docxContent);
        $content = '';

        foreach ($phpWord->getSections() as $section) {
            foreach ($section->getElements() as $element) {
                if ($element instanceof \PhpOffice\PhpWord\Element\TextRun) {
                    foreach ($element->getElements() as $text) {
                        $content .= $text->getText();
                    }
                }
            }
        }

        return $content;
    }
}
