<?php

namespace App\Livewire\Charts;

use Livewire\Component;
use App\Models\Magazine;

class FacultyYearActivity extends Component
{
    public function render()
    {
        $facultyId = auth()->user()->faculty_id;
        $currentYearData = Magazine::query()
                ->GetYear(date('Y'))
                ->GroupByFMonth($facultyId);
            
        $lastYearData = Magazine::query()
                ->GetYear(date('Y')-1)
                ->GroupByFMonth($facultyId);
        $twoYearagoData = Magazine::query()
                ->GetYear(date('Y')-2)
                ->GroupByFMonth($facultyId);
        $labels = ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'];
        $FYChart = app()->chartjs
                ->name('FYChart')
                ->type('line')
                ->size(['width' => 400, 'height' => 200])
                ->labels($labels)
                ->datasets([
                    [
                        "label" =>  date('Y') . " Articles",
                        'backgroundColor' => 'lightgreen',
                        'data' => $currentYearData
                    ],
                    [
                        "label" =>  date('Y')-1 . " Articles",
                        'backgroundColor' => '#FF6385',
                        'data' => $lastYearData
                    ],
                    
                    [
                        "label" =>  date('Y')-2 . " Articles",
                        'backgroundColor' => 'lightblue',
                        'data' => $twoYearagoData
                    ]
                ])
                ->options([]);

        $YearList = Magazine::select('year')->distinct()->orderBy('year', 'desc')->get();

           

        return view('livewire.charts.faculty-year-activity', [
            'currentYearData' => $currentYearData,
            'lastYearData' => $lastYearData,
            'twoYearagoData' => $twoYearagoData,
            'FYChart'=> $FYChart,
            'YearList' => $YearList
        ]);
    }
}
