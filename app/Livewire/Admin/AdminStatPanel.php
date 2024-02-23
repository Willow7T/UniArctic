<?php

namespace App\Livewire\Admin;

use Livewire\Component;
use App\Models\Article;
use Illuminate\Support\Facades\DB;

class AdminStatPanel extends Component
{ 
    public function render()
    {
        $articles = Article::select('articles.*', 
        DB::raw('COUNT(article_views.id) as views_count'))
        ->join('article_views', 'articles.id', '=', 'article_views.article_id')
        ->groupBy('articles.id')
        ->orderBy('views_count', 'desc')
        ->get();
    $authors = Article::select('articles')->select('users.name',
        DB::raw('COUNT(articles.id) as articles_count'))
        ->join('users', 'articles.author_id', '=', 'users.id')
        ->groupBy('users.name')
        ->orderBy('articles_count', 'desc')
        ->get();
    $deleted_authors = Article::select('articles')->select(
        DB::raw('COUNT(articles.id) as counters'))
        ->whereNull('author_id')
        ->get();

        return view('livewire.admin.admin-statpanel'
        , ['articles' => $articles, 'authors' => $authors, 'deleted_authors' => $deleted_authors]);
    }
}
