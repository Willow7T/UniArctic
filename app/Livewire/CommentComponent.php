<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Comment;
use App\Models\Article;

class CommentComponent extends Component
{
    public $article;
    public $newComment;
    public $newReply = [];
    
    public function mount($article)
    {
        $this->article = $article;
        
    }

    public function render()
    {
        return view('livewire.comment-component', [
            'comments' => $this->article->comments()->whereNull('parent_id')->get(),
        ]);
    }

    public function addComment()
    {
        
        $this->validate(['newComment' => 'required']);

        $this->article->comments()->create([
            'body' => $this->newComment,
            'user_id' => auth()->id(),
        ]);

        $this->newComment = '';
    }

    public function showReplyForm($commentId)
    {
        $this->newReply[$commentId] = '';
    }
    public function addReply($parentId)
{
    $this->validate(['newReply.' . $parentId => 'required']);

    Comment::create([
        'body' => $this->newReply[$parentId],
        'user_id' => auth()->id(),
        'article_id' => $this->article->id,
        'parent_id' => $parentId,
    ]);

    unset($this->newReply[$parentId]);

}
  
}
