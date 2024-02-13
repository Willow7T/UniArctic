<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ArticleController extends Controller
{   
    //Show articles using ID
    public function show($id)
    {
        $articles = Article::findOrFail($id);

        return view('articles.show', compact('articles'));
    }
}
