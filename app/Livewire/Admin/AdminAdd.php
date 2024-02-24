<?php

namespace App\Livewire\Admin;

use Livewire\Component;
use App\Models\Faculty;

class AdminAdd extends Component
{
    public $name;
    public $updateName;
    public $newName;
 

    public function render()
    {
        $faculties = Faculty::withCount(['users'])
            ->orderBy('id', 'asc')
            ->get()
            ->map(function ($faculty) {
        $faculty->name = $faculty->name ?? 'No faculty';
        return $faculty;
    });
        return view('livewire.admin.admin-add' , ['faculties' => $faculties ]);
    }
    
    public function addFaculty()
    {
        $this->validate([
            'name' => 'required|unique:faculties,name',
        ]);

        Faculty::create(['name' => $this->name]);

        $this->name = '';

        session()->flash('message', 'Faculty successfully added.');
    }
    public function updateFaculty()
    {
        $this->validate([
            'newName' => 'required|unique:faculties,name',
        ]);

        $faculty = Faculty::where('name', $this->updateName)->first();

        if ($faculty) {
            $faculty->name = $this->newName;
            $faculty->save();

            $this->newName = '';

            session()->flash('message', 'Faculty successfully updated.');
        } else {
            session()->flash('error', 'Faculty not found.');
        }
    }
}
