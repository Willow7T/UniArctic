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
