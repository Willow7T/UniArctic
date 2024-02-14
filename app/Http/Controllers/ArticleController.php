<?php

namespace App\Http\Controllers;
use App\Models\Article; 
use Illuminate\Http\Request;

class ArticleController extends Controller
{   
    //Show articles using ID
    public function show($id)
    {
        //$articles = Article::findOrFail($id);
        $article = Article::find($id);

        return view('article.show', ['article' => $article]);
    }
}
