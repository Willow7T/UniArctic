<?php

namespace App\Http\Controllers;
use App\Models\Article; 
use App\Models\Magazine;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use PhpOffice\PhpWord\IOFactory;
use PhpOffice\PhpWord\Settings;
use PhpOffice\PhpWord\Shared\ZipArchive;

class ArticleController extends Controller
{   

     //Create new article
     public function create()
     {
        $currentMonth = date('n');
        $currentYear = date('Y');
        
    $magazines = Magazine::where('published', false)
    ->where('year', '=', $currentYear)
    ->where('month', '>=', $currentMonth)
        ->orderBy('year', 'asc')
        ->orderBy('month', 'asc')
        ->take(3)
        ->get();
         return view('article.create', ['magazines' => $magazines]);
     }

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

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|max:255',
            'intro' => 'required|max:255',
            'content' => 'required|mimes:docx',
            'magazine_id' => 'required|exists:magazines,id',
        ]);
        $article = new Article;
    ;
       
        $path = null;
        if ($request->hasFile('content')) {
            $file = $request->file('content');
            $filename = $file->hashName('articles');
    


            // Store the file
            $path = $file->store('articles');
        }
    
       
        $article = Article::create([
            'title' => $request->title,
            'intro' => $request->intro,
            'content' => $path ?? null, // assuming $path contains the path to the content file
            'selected'=>false,
            'author_id' => $request->anon ? null : auth()->id(),
            'magazine_id' => $request->magazine_id,
        ]);
      
        
    
        return redirect()->route('home')->with('success', 'Article created successfully.');
    }
}
