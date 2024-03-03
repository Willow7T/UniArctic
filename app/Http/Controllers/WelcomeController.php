<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Article;
use App\Models\Faculty;

class WelcomeController extends Controller
{
    public function index()
    {
        //get count for all users whose roles in 4
        $student = User::where('role_id', 4)->count();
        $user = User::all()->count();
        //get all articles whose status is 1
        $article = Article::where('published', 1)->count();
        //get all faculty count
        $faculty = Faculty::all()->count();

        return view('welcome'
            , [
                'student' => $student,
                'user' => $user,
                'article' => $article
                , 'faculty' => $faculty
            ]);
    }
}
