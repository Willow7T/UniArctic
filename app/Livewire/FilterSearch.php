<?php

namespace App\Livewire;

use Livewire\Component;
use Illuminate\Support\Facades\DB;
use App\Models\Article;
use Livewire\WithPagination;

class FilterSearch extends Component
{
    use WithPagination;

    public $search;
    public $months = [];
    public $years = [];
    public $faculties = [];
    public $tags = [];
    public $isMonthExpanded = false;
    public $isYearExpanded = false;
    public $isFacultyExpanded = false;
    public $isTagExpanded = false;

    protected $queryString = ['search', 'months', 'years', 'faculties', 'tags'];

    public function updated($field)
    {
        $this->resetPage();
    }

    public function toggleMonth()
    {
        $this->isMonthExpanded = !$this->isMonthExpanded;

        // If month is expanded, collapse others
        if ($this->isMonthExpanded) {
            $this->isYearExpanded = false;
            $this->isFacultyExpanded = false;
            $this->isTagExpanded = false;
        }
    }

    public function toggleYear()
    {
        $this->isYearExpanded = !$this->isYearExpanded;

        // If year is expanded, collapse others
        if ($this->isYearExpanded) {
            $this->isMonthExpanded = false;
            $this->isFacultyExpanded = false;
            $this->isTagExpanded = false;
        }
    }

    public function toggleFaculty()
    {
        $this->isFacultyExpanded = !$this->isFacultyExpanded;

        // If faculty is expanded, collapse others
        if ($this->isFacultyExpanded) {
            $this->isMonthExpanded = false;
            $this->isYearExpanded = false;
            $this->isTagExpanded = false;
        }
    }

    public function toggleTag()
    {
        $this->isTagExpanded = !$this->isTagExpanded;

        // If tag is expanded, collapse others
        if ($this->isTagExpanded) {
            $this->isMonthExpanded = false;
            $this->isYearExpanded = false;
            $this->isFacultyExpanded = false;
        }
    }

    

    public function render()
    {
        $query = Article::query();
        
        $query->where('articles.published', true);

        if (!empty($this->search)) {
            $query->whereRaw('LOWER(title) LIKE ?', [strtolower('%' . $this->search . '%')]);
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
        if (!empty($this->faculties)) {
            $query->join('faculties', 'articles.faculty_id', '=', 'faculties.id')
                  ->whereIn('faculties.name', $this->faculties);
        }
        if (!empty($this->tags)) {
            $query->join('article_tag', 'articles.id', '=', 'article_tag.article_id')
                  ->join('tags', 'article_tag.tag_id', '=', 'tags.id')
                  ->whereIn('tags.name', $this->tags);
        }

        $articles = $query->select('articles.*')->paginate(10);

        $monthList = DB::table('magazines')->distinct()->orderBy('month', 'asc')->pluck('month')->all();
        $yearList = DB::table('magazines')->distinct()->orderBy('year', 'asc')->pluck('year')->all();
        $facultyList = DB::table('faculties')->distinct()->orderBy('name', 'asc')->pluck('name')->all();
        $tagList = DB::table('tags')->distinct()->orderBy('name', 'asc')->pluck('name')->all();

        return view('livewire.filter-search', [
            'articles' => $articles,
            'monthList' => $monthList,
            'yearList' => $yearList,
            'facultyList' => $facultyList,
            'tagList' => $tagList,
        ]);
    }
}
