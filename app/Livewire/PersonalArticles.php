<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Article;


class PersonalArticles extends Component
{
    use WithPagination;

    public function render()
    {
        $articles = Article::where('author_id', auth()->user()->id)
        ->paginate(3);

        return view('livewire.personal-articles'
        ,['articles'=>$articles]);
    }
}
