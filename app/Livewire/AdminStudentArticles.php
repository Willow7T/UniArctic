<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Article;
use App\Models\User;

class AdminStudentArticles extends Component
{
    public $user_id;

    protected $listeners = ['userIdUpdated' => 'setUserId'];

    public function setUserId($userId)
    {
        $this->user_id = $userId;
    }

    public function render()
    {
        $articles = Article::where('author_id', $this->user_id)->get();
        $user = User::find($this->user_id);
        

        return view('livewire.admin-student-articles', ['articles' => $articles], ['user' => $user]);
    }
}
