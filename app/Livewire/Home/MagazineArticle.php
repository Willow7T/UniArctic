<?php

namespace App\Livewire\Home;

use App\Models\Article;
use Livewire\Component;
use Livewire\Attributes\On; 

class MagazineArticle extends Component
{
    public $magazineID;

    #[On('magazineIDupdated')] 
    public function updateMagazineId($magID)
    {
        $this->magazineID = $magID;
    }
    

    public function render()
    {
        
        $published = Article::getArticlesWMag($this->magazineID, true);
        //$unpublished = Article::getArticlesWMag($this->magazine_id, false);

        $articles = $published['articles'];
        //$publishedCount = $published['count'];
        //$unpublishedCount = $unpublished['count'];
        return view('livewire.home.specified-articles', [
            'articles' => $articles
            ]);
    }
}
