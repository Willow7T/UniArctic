<?php

namespace App\Livewire\Home;

use Livewire\Component;
use App\Models\Magazine;

class MagazineFilterSearch extends Component
{


    public function buttonMagazine($magID)
    {
        $this->dispatch('magazineIDupdated', magID: $magID);
    }
    public function render()
    {
        $currentMonth = date('n');
        $currentYear = date('Y');

        // Calculate the month and year for three months ago
        $MonthsAgo = strtotime('-3 months');
        $monthMonthsAgo = date('n', $MonthsAgo);
        $yearMonthsAgo = date('Y', $MonthsAgo);

        if($yearMonthsAgo != $currentYear)
        {
            $magazines = Magazine::where('published', true)
            ->where(function ($query) use ($currentYear, $currentMonth, $yearMonthsAgo, $monthMonthsAgo) {
                $query->where([
                        ['year', '=', $currentYear],
                        ['month', '<=', $currentMonth],
                ])->orWhere([
                    ['year', '=', $yearMonthsAgo],
                    ['month', '>=', $monthMonthsAgo],
                ]);})
            ->orderBy('year', 'asc')
            ->orderBy('month', 'asc')
            ->get();
        }
        else
        {
            $magazines = Magazine::where('published', true)
            ->where(function ($query) use ($currentYear, $currentMonth, $monthMonthsAgo) {
                $query->where([
                        ['year', '=', $currentYear],
                        ['month', '<=', $currentMonth],
                        ['month', '>=', $monthMonthsAgo],
                ]);})
            ->orderBy('year', 'asc')
            ->orderBy('month', 'asc')
            ->get();
        }
        
        return view(
            'livewire.home.magazine-filter-search',
            ['magazines' => $magazines]
        );
    }
}
