<?php

namespace App\Http\Controllers;
use App\Models\Article; 
use Illuminate\Http\Request;
use PhpOffice\PhpWord\IOFactory;
use PhpOffice\PhpWord\Settings;
use PhpOffice\PhpWord\Shared\ZipArchive;

class ArticleController extends Controller
{   
    //Show articles using ID
    public function show($id)
    {
        $article = Article::findOrFail($id);
        
        // Load .docx file
        $phpWord = IOFactory::load(storage_path('app/' . $article->content));

        // Convert to HTML
        Settings::setOutputEscapingEnabled(true);
        $xmlWriter = IOFactory::createWriter($phpWord, 'HTML');
        

        // Save HTML to temp file
        $tempFile = tempnam(sys_get_temp_dir(), 'PHPWord');
        $xmlWriter->save($tempFile);

        // Read contents of temp file
        $content = file_get_contents($tempFile);

        // Delete temp file
        unlink($tempFile);

        return view('article.show', compact('article', 'content'));
    }
}
