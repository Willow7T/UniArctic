<?php

namespace App\Livewire\Home;

use Livewire\Component;
use App\Models\Faculty;

class FacultyFilterSearch extends Component
{
    public function buttonFaculty($facuID)
    {
        $this->dispatch('facultyIDupdated', facuID: $facuID);
    }
    public function render()
    {       
     
          $faculties = Faculty::all();


        return view('livewire.home.faculty-filter-search'
            , ['faculties' => $faculties]);
    }
}
