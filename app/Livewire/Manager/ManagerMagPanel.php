<?php

namespace App\Livewire\Manager;

use Livewire\Component;
use Livewire\WithFileUploads;
use App\Models\Magazine;


class ManagerMagPanel extends Component
{
    use WithFileUploads;

    public $facultyID;
    public $image;

    public function CreateMag()
    {
        $this->validate([
            'issue_name' => 'required|unique:magazines',
            'month' => 'required',
            'year' => 'required',
            'image' => 'required|image|mimes:jpeg,jpg,png|max:2048', // 2MB Max
        ]);

        $imagepath = null;
        if ($this->image) {
            $imagepath = $this->image->store('background', 'public');
            if (!$imagepath) {
                session()->flash('error', 'Failed to store image');
            }
        }

        //create new magazine
        $magazine = Magazine::create([
            'issue_name' => $this->issue_name,
            'month' => $this->month,
            'year' => $this->year,
            'image' => $imagepath,
        ]);

        if ($magazine) {
            session()->flash('success', 'Magazine created successfully');
        } else {
            session()->flash('error', 'Failed to create magazine');
        }


        $this->reset('image');
    }


    public function render()
    {
        // Month & year Logic
        $currentMonth = date('n');
        $currentYear = date('Y');

        $monthList = [];
        for ($i = 0; $i < 3; $i++) {
            $month = $currentMonth + $i;
            $year = $currentYear;
            if ($month > 12) {
                $month = $month - 12;
                $year++;
            }
            $monthList[] = ['month' => $month, 'year' => $year];
        }


        return view('livewire.manager.manager-mag-panel',
            ['monthList' => $monthList]);
    }
}
