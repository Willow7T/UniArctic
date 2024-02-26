<?php

namespace App\Livewire;

use App\Models\FacuArtiComm;
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
        $facuarticomms = Facuarticomm::where('article_id', $this->article->id)->get();
        return view('livewire.faculty-comment'
        ,['facuarticomms'=>$facuarticomms]
    );
    }
}
