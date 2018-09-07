<?php

namespace App\Http\Controllers;

use App\Answers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AnswersController extends Controller
{
    public function addAnswer(Request $request){
        dump($request);
        $answer = new Answers();
        $answer->text = $request->answer_text;
        $answer->question_id = $request->question_id;
        $answer->user_id = Auth::user()->id;
        $answer->save();
    }
}
