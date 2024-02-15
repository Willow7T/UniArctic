<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class MagazineController extends Controller
{
    //select fucntion for magazine
    public function select()
    {
        $magazines = Magazine::all();
        return view('magazine.select', compact('magazines'));
    }

}
