<?php

namespace App\Livewire\Home;

use App\Models\Article;
use Livewire\Component;
use Livewire\Attributes\On;

class FacultyArticle extends Component
{
    public $facultyID;

    #[On('facultyIDupdated')] 
    public function updatefacultyId($facuID)
    {
    
        $this->facultyID = $facuID;
    }
    

    public function render()
    {
        
        $published = Article::getArticlesWFacu($this->facultyID, true);
        //$unpublished = Article::getArticlesWMag($this->faculty_id, false);

        $articles = $published['articles'];
        //$publishedCount = $published['count'];
        //$unpublishedCount = $unpublished['count'];
        return view('livewire.home.specified-articles' , [
            'articles' => $articles
            ]);
    }
}
