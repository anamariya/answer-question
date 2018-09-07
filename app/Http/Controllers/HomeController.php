<?php

namespace App\Http\Controllers;

use App\Categories;
use App\Likes;
use App\Questions;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $myQuestions = Questions::where('user_id',Auth::user()->id)->get();
        $allQuestions = Questions::all();
        $categories = Categories::all();
        if(count($categories) == 0){
            (new \App\Categories)->insert_categories();
        }
        $questions_liked_by_me = Likes::where('user_id',Auth::user()->id)
            ->where('answer_id', null)
            ->get();
        $questions_liked_by_me_array = [];
        foreach($questions_liked_by_me as $question_liked_by_me){
            $questions_liked_by_me_array[$question_liked_by_me->question_id] = $question_liked_by_me;
        }
        return view('home',[
            'categories' => $categories,
            'myQuestions' => $myQuestions,
            'allQuestions' => $allQuestions,
            'questions_liked_by_me' => $questions_liked_by_me_array
        ]);
    }
}
