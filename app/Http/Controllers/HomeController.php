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
        $myQuestions = Questions::where('user_id',Auth::user()->id)
            ->orderBy('likes_amount', 'desc')
            ->with('answers')
            ->get();
        $allQuestions = Questions::orderBy('likes_amount', 'desc')
            ->with('answers')
            ->get();
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

        $answers_liked_by_me = Likes::where('user_id',Auth::user()->id)
            ->whereNotNull('answer_id')
            ->get();
        $answers_liked_by_me_array =[];
        foreach($answers_liked_by_me as $answer_liked_by_me){
            $answers_liked_by_me_array[$answer_liked_by_me->answer_id] = $answer_liked_by_me;
        }

        return view('home',[
            'categories' => $categories,
            'myQuestions' => $myQuestions,
            'allQuestions' => $allQuestions,
            'questions_liked_by_me' => $questions_liked_by_me_array,
            'answers_liked_by_me' => $answers_liked_by_me_array
        ]);
    }
}
