<?php

namespace App\Livewire\Charts;

use Livewire\Component;
use App\Models\Faculty;

class FacultyActivityChart extends Component
{
    public function render()
    {
        $faculties = Faculty::withCount(['users'])
        ->orderBy('id', 'asc')
        ->get()
        ->map(function ($faculty) {
        $faculty->name = $faculty->name ?? 'No faculty';
        return $faculty;
        });


        $labels = $faculties->pluck('name')->toArray();
        $articles = Faculty::withCount('articles')->get()->pluck('articles_count')->toArray();
        $particles = Faculty::withCount(['articles' => function ($query) {
            $query->where('published', 1);
        }])
        ->get()
        ->pluck('articles_count')
        ->toArray();
        //dd($particles);
        $users = $faculties->pluck('users_count')->toArray();
       
        $Fchart = app()->chartjs
        ->name('Fchart')
        ->type('bar')
        //->size(['width' => 400, 'height' => 200])
        ->labels($labels)
        ->datasets([
            [
                "label" =>   "Upload Articles",
                'backgroundColor' => 'red',
                'data' => $articles
            ],
            [
                "label" =>   "Published Articles",
                'backgroundColor' => '#00FA9A',
                'data' => $particles
            ],
            [
                "label" =>  "Users Count",
                'backgroundColor' => '#FFD700',
                'data' => $users
            ],
        ])
        ->options([]);

        return view('livewire.charts.faculty-activity-chart'
        , [ 'Fchart' => $Fchart, 'users' => $users,  'articles' => $articles]);
        // 
    }
}
