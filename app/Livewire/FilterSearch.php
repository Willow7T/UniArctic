<?php

namespace App\Livewire;

use Livewire\Component;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Article;
use Livewire\WithPagination;


class FilterSearch extends Component
{
    use WithPagination;

    public $search;
    public $months = [];
    public $years = [];
    public $isMonthExpanded = false;
    public $isYearExpanded = false;

    protected $queryString = ['search', 'months', 'years'];


    public function updated($field)
    {
        
        $this->resetPage();
    }

    public function updatedMonths()
    {
        $this->resetPage();
    }

    public function updatedYears()
    {
        $this->resetPage();
    }
    public function toggleMonth()
{
    $this->isMonthExpanded = !$this->isMonthExpanded;
}

public function toggleYear()
{
    $this->isYearExpanded = !$this->isYearExpanded;
}

    public function render()
    {
        $query = Article::query();

        if (!empty($this->search)) {
            $query->where('title', 'like', '%' . $this->search . '%');
        }

        if (!empty($this->months) || !empty($this->years)) {
            $query->join('magazines', 'articles.magazine_id', '=', 'magazines.id');

            if (!empty($this->months)) {
                $query->whereIn('magazines.month', $this->months);
            }

            if (!empty($this->years)) {
                $query->whereIn('magazines.year', $this->years);
            }
        }

        $articles = $query->select('articles.*')->paginate(2);

        $monthList = DB::table('magazines')->distinct()->orderBy('month', 'asc')->pluck('month')->all();
        $yearList = DB::table('magazines')->distinct()->orderBy('year', 'asc')->pluck('year')->all();

        return view('livewire.filter-search', [
            'articles' => $articles,
            'monthList' => $monthList,
            'yearList' => $yearList,
        ]);
    }
}

