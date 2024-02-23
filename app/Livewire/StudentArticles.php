<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Article;
use App\Models\User;

class StudentArticles extends Component
{
    public $user_id;

    protected $listeners = ['userIdUpdated' => 'setUserId'];

    public function setUserId($userId)
    {
        $this->user_id = $userId;
    }

    public function render()
    {
        
        $published = Article::getArticlesWAuthen($this->user_id, true);
        $unpublished = Article::getArticlesWAuthen($this->user_id, false);

        $articles = $published['articles'];
        $publishedCount = $published['count'];
        $unpublishedCount = $unpublished['count'];
        $user = User::find($this->user_id);
        

        return view('livewire.student-articles', [
            'articles' => $articles, 'user' => $user,
             'publishedCount' => $publishedCount, 'unpublishedCount' => $unpublishedCount
            ]);
    }
}
