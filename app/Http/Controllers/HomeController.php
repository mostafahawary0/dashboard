<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\news;
use App\Models\Section;
use App\Models\User;




class HomeController extends Controller
{
    function home()
    { 
        $news = news::orderBy('id', 'desc')->paginate(20);;
        $sections = Section::get();
        $users = User::get();
        return view('dashboard.home',compact('news','sections','users'));
    }
}
