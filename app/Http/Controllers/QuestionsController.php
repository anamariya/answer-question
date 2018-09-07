<?php

namespace App\Http\Controllers;

use App\Likes;
use App\Questions;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class QuestionsController extends Controller
{
    public function create(Request $request){
        $question = new Questions();
        $question->category_id = $request->form[0]["value"];
        $question->text = $request->form[1]["value"];
        $question->user_id = Auth::user()->id;
        $question->save();
    }

    public function like(Request $request){
        $like = Likes::where('question_id',$request->question_id)
            ->where('user_id',Auth::user()->id)
            ->first();
        if(!$like){
            $question = Questions::find($request->question_id);
            $question->likes_amount++;
            $question->save();
            $like = new Likes();
            $like->question_id = $request->question_id;
            $like->answer_id = null;
            $like->user_id = Auth::user()->id;
            $like->save();
            return "ok";
        }
        else
            return "already exist";
    }
}
