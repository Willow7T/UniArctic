<?php

namespace App\Livewire;

use App\Models\Article;
use App\Models\Magazine;
use Livewire\Component;
use ConsoleTVs\Charts\Classes\Chartjs\Chart;


class AdminCharts extends Component
{   
//     SELECT month, COUNT(a.id) AS article_count
// FROM magazines m
// LEFT JOIN articles a ON m.id = a.magazine_id where year = 2024
// GROUP BY month ORDER BY month ASC;


    public function render()
    {
        $currentYearData = Magazine::query()
                ->where('year', date('Y'))
                ->GroupByMonth();
        $lastYearData = Magazine::query()
                ->where('year', date('Y')-1)
                ->GroupByMonth(); 
        $labels = ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'];
        $Chart = app()->chartjs
                ->name('barChartTest')
                ->type('bar')
                ->size(['width' => 400, 'height' => 200])
                ->labels($labels)
                ->datasets([
                    [
                        "label" => "Last Year Articles",
                        'backgroundColor' => 'lightgray',
                        'data' => $lastYearData
                    ],
                    [
                        "label" => "Current Year Articles",
                        'backgroundColor' => 'lightgreen',
                        'data' => $currentYearData
                    ]
                ])
                ->options([]);



           

        return view('livewire.admin-charts', [
            'currentYearData' => $currentYearData,
            'lastYearData' => $lastYearData,
            'Chart'=> $Chart
        ]);
    }
}
