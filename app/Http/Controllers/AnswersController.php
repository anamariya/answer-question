<?php

namespace App\Http\Controllers;

use App\Answers;
use App\Likes;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AnswersController extends Controller
{
    public function addAnswer(Request $request){
        $answer = new Answers();
        $answer->text = $request->answer_text;
        $answer->question_id = $request->question_id;
        $answer->user_id = Auth::user()->id;
        $answer->save();
    }

    public function like(Request $request){
        $like = Likes::where('answer_id',$request->answer_id)
            ->where('question_id',$request->question_id)
            ->where('user_id',Auth::user()->id)
            ->first();
        if(!$like){
            $answer = Answers::find($request->answer_id);
            $answer->likes_amount++;
            $answer->save();
            $like = new Likes();
            $like->question_id = $request->question_id;
            $like->answer_id = $request->answer_id;
            $like->user_id = Auth::user()->id;
            $like->save();
            return "ok";
        }
        else
            return "already exist";
    }
}
