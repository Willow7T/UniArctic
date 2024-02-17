<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CommentController extends Controller
{
    //
    public function show(Comment $comment)
    {
        return view('comments.show', compact('comment'));
    }
}
