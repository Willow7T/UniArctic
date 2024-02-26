<?php

namespace App\Livewire;

use Livewire\Component;

class FacultyComment extends Component
{
 
    public $article;
    public function mount($article)
    {
        $this->article = $article;
        
    }
    public function render()
    {
        return view('livewire.faculty-comment');
    }
}
