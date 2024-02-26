<?php

namespace App\Livewire;

use App\Models\FacuArtiComm;
use Livewire\Component;

class FacultyComment extends Component
{
 
    public $article;
    public $facucomment;
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

    public function MakeComment()
    {
        
        $this->validate([
            'facucomment' => 'required'
        ]);

        FacuArtiComm::create([
            'article_id' => $this->article->id,
            'user_id' => auth()->user()->id,
            'body' => $this->facucomment
        ]);
        $this->facucomment = '';
    }

}
