<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Answer;


class AcceptAnswerController extends Controller
{
    public function __invoke(Answer $answer){
        
        // auth user accept best answer
        $this->authorize('accept', $answer);

        // dd('accept the answer');
        // accept the answer as best answer
        $answer->question->acceptBestAnswer($answer);

        // return json response
        if(request()->expectsJson()){
            return response()->json([
                'message' => "You have accepted this answer as best answer"
            ]);
        }
        return back();

    }
}
