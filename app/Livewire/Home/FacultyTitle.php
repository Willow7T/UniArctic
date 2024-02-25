<?php

namespace App\Livewire\Home;

use Livewire\Component;
use App\Models\Faculty;
use Livewire\Attributes\On;

class FacultyTitle extends Component
{ public $facultyID;

    #[On('facultyIDupdated')] 
    public function updatefacultyId($facuID)
    {
    
        $this->facultyID = $facuID;
    }
    
    public function render()
    {
        $faculty = Faculty::find($this->facultyID);

        return view('livewire.home.faculty-title'
            , ['faculty' => $faculty]);
    }
}
