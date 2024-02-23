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

        //chart data
        $labels = $faculties->pluck('name')->toArray();
        $articles = Faculty::withCount('articles')->get()->pluck('articles_count')->toArray();
        $users = $faculties->pluck('users_count')->toArray();
       
        $Fchart = app()->chartjs
        ->name('Fchart')
        ->type('bar')
        ->size(['width' => 400, 'height' => 200])
        ->labels($labels)
        ->datasets([
            [
                "label" =>   "Articles",
                'backgroundColor' => 'lightgray',
                'data' => $articles
            ],
            [
                "label" =>  "Users Count",
                'backgroundColor' => 'lightblue',
                'data' => $users
            ],
        ])
        ->options([]);




        return view('livewire.admin.admin-add' , ['faculties' => $faculties , 'Fchart' => $Fchart, 'users' => $users,  'articles' => $articles]);
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
