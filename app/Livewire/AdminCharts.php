<?php

namespace App\Livewire;

use App\Models\Article;
use App\Models\Magazine;
use Livewire\Component;
use ConsoleTVs\Charts\Classes\Chartjs\Chart;


class AdminCharts extends Component
{   


    public function render()
    {
        $currentYearData = Magazine::query()
                ->GetYear(date('Y'))
                ->GroupByMonth();
                //dd($currentYearData);
        $lastYearData = Magazine::query()
                ->GetYear(date('Y')-1)
                ->GroupByMonth(); 
        $twoYearagoData = Magazine::query()
                ->GetYear(date('Y')-2)
                ->GroupByMonth(); 
        $labels = ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'];
        $Chart = app()->chartjs
                ->name('ArticleChart')
                ->type('bar')
                ->size(['width' => 400, 'height' => 200])
                ->labels($labels)
                ->datasets([
                    [
                        "label" =>  date('Y')-2 . " Articles",
                        'backgroundColor' => 'lightgray',
                        'data' => $twoYearagoData
                    ],
                    [
                        "label" =>  date('Y')-1 . " Articles",
                        'backgroundColor' => 'lightblue',
                        'data' => $lastYearData
                    ],
                    [
                        "label" =>  date('Y') . " Articles",
                        'backgroundColor' => 'lightgreen',
                        'data' => $currentYearData
                    ]
                ])
                ->options([]);

        $YearList = Magazine::select('year')->distinct()->orderBy('year', 'desc')->get();

           

        return view('livewire.admin-charts', [
            'currentYearData' => $currentYearData,
            'lastYearData' => $lastYearData,
            'twoYearagoData' => $twoYearagoData,
            'Chart'=> $Chart,
            'YearList' => $YearList
        ]);
    }
}
