<?php

namespace App\Livewire\Coordinator;

use Livewire\Component;
use App\Models\Magazine;
use App\Models\Article;
use Livewire\WithoutUrlPagination;
use Livewire\WithPagination;

class ArticleSelection extends Component
{
    use WithPagination;
    use WithoutUrlPagination;

    public $magazine_ids = [];
    public $article_ids = [];
    public $unarticle_ids = [];

    public function render()
    {
        //get magazine with current month and next 2 months

        $currentmonth = date('n');
        $currentyear = date('Y');

        $nextmonth = date('n', strtotime('+1 month'));
        $nextyear = date('Y', strtotime('+1 month'));

        if ($currentyear != $nextyear) {
            $magazines = Magazine::where('published', 0)
                ->where('month', '>=', $currentmonth)
                ->where('year', '=', $currentyear)
                ->orWhere('month', '<=', $nextmonth)
                ->orWhere('year', '=', $nextyear)
                ->orderBy('year', 'asc')
                ->orderBy('month', 'asc')
                ->get();
        } else {
            $magazines = Magazine::where('published', 0)
                ->where('year', '=', $currentyear)
                ->where('month', '>=', $currentmonth)
                ->where('month', '<=', $nextmonth)
                ->orderBy('year', 'asc')
                ->orderBy('month', 'asc')
                ->get();
        }
      
        $articles = $this->getartQuery($currentmonth, $currentyear, $nextmonth, $nextyear, 0, 0);
        $unarticles = $this->getartQuery($currentmonth, $currentyear, $nextmonth, $nextyear, 0, 1);


        return view(
            'livewire.coordinator.article-selection',
            [
                'magazines' => $magazines, 'articles' => $articles, 'unarticles' => $unarticles
            ]
        );
    }

    public function getartQuery($currentmonth, $currentyear, $nextmonth, $nextyear, $publish, $selected)
    {
        $query = Article::join('magazines', 'articles.magazine_id', '=', 'magazines.id')
            ->where('magazines.published', $publish)
            ->where('selected', $selected)
            ->where('faculty_id', auth()->user()->faculty_id);

        if (!empty($this->magazine_ids)) {
            $query->whereIn('magazines.id', $this->magazine_ids);
        }

        if ($currentyear != $nextyear) {
            $query->where('magazines.month', '>=', $currentmonth)
                ->where('magazines.year', '=', $currentyear)
                ->orWhere('magazines.month', '<=', $nextmonth)
                ->orWhere('magazines.year', '=', $nextyear);
        } else {
            $query->where('magazines.year', '=', $currentyear)
                ->where('magazines.month', '>=', $currentmonth)
                ->where('magazines.month', '<=', $nextmonth);
        }

        return $query->orderBy('magazines.year', 'asc')
            ->orderBy('magazines.month', 'asc')
            ->select('articles.*')
            ->get();
    }
   
    public function MakeSelection()
    {

        Article::whereIn('id', $this->article_ids)
            ->update(['selected' => 1]);
        session()->flash('select', 'Articles selected successfully');
        $this->article_ids = [];
    }
    public function UndoSelection()
    {
        Article::whereIn('id', $this->unarticle_ids)
            ->update(['selected' => 0]);
        session()->flash('unselect', 'Articles unselected successfully');
        $this->unarticle_ids = [];
    }
}
