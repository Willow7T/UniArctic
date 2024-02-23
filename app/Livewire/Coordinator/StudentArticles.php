<?php

namespace App\Livewire\Coordinator;

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

        $publishedarticles = $published['articles'];
        $publishedCount = $published['count'];

        $unpublishedarticles = $unpublished['articles'];
        $unpublishedCount = $unpublished['count'];

        $user = User::find($this->user_id);


        return view('livewire.coordinator.student-articles', [
        'publishedarticles' => $publishedarticles ,'unpublishedarticles' => $unpublishedarticles 
        , 'publishedCount' => $publishedCount, 'unpublishedCount' => $unpublishedCount]);
    }
}
