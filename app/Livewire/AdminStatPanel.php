<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Article;
use Illuminate\Support\Facades\DB;

class AdminStatPanel extends Component
{    public $articles;
    public $authors;
    public function mount()
    {
        $this->articles = Article::select('articles.*', 
            DB::raw('COUNT(article_views.id) as views_count'))
            ->join('article_views', 'articles.id', '=', 'article_views.article_id')
            ->groupBy('articles.id')
            ->orderBy('views_count', 'desc')
            ->get();
        $this->authors = Article::select('articles')->select('users.name',
            DB::raw('COUNT(articles.id) as articles_count'))
            ->join('users', 'articles.author_id', '=', 'users.id')
            ->groupBy('users.name')
            ->orderBy('articles_count', 'desc')
            ->get();
    }

    public function render()
    {
        return view('livewire.admin-statpanel');
    }
}
