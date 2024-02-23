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
        $publishedarticles = Article::where('author_id', $this->user_id)
        ->where('published', true)
        ->get();
        $unpublishedarticles = Article::where('author_id', $this->user_id)
        ->where('published', true)
        ->get();
        $publishedCount = Article::where('author_id', $this->user_id)
        ->where('published', true)
        ->count();
        $unpublishedCount = Article::where('author_id', $this->user_id)
        ->where('published', false)
        ->count();
        $user = User::find($this->user_id);
        

        return view('livewire.coordinator.student-articles', [
        'publishedarticles' => $publishedarticles ,'unpublishedarticles' => $unpublishedarticles 
        , 'publishedCount' => $publishedCount, 'unpublishedCount' => $unpublishedCount]);
    }
}
