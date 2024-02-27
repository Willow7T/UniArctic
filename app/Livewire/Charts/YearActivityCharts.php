<?php

namespace App\Livewire\Charts;

use App\Models\Article;
use App\Models\Magazine;
use Livewire\Component;
use ConsoleTVs\Charts\Classes\Chartjs\Chart;


class YearActivityCharts extends Component
{   


    public function render()
    {
        $currentYearData = Magazine::query()
                ->GetYear(date('Y'))
                ->GroupByMonth();
        $UncurrentYearData = Magazine::query()
                ->GetYear(date('Y'))
                ->GroupByUnMonth();
               // dd($currentYearData);
        $lastYearData = Magazine::query()
                ->GetYear(date('Y')-1)
                ->GroupByMonth(); 
        $twoYearagoData = Magazine::query()
                ->GetYear(date('Y')-2)
                ->GroupByMonth(); 
        $labels = ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'];
        $Chart = app()->chartjs
                ->name('ArticleChart')
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
                        "label" =>  date('Y') . " Total upload Articles",
                        'backgroundColor' => 'red',
                        'data' => $UncurrentYearData
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

           

        return view('livewire.charts.year-activity-charts', [
            'currentYearData' => $currentYearData,
            'UncurrentYearData' => $UncurrentYearData,
            'lastYearData' => $lastYearData,
            'twoYearagoData' => $twoYearagoData,
            'Chart'=> $Chart,
            'YearList' => $YearList
        ]);
    }
}
