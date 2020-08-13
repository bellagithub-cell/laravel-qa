<?php

namespace App\Http\Controllers;
use App\Question;
use Illuminate\Http\Request;

class VoteQuestionController extends Controller
{
    //define a construct
    public function __construct (){
        $this->middleware('auth');
    }

    public function __invoke(Question $question){
        $vote = (int) request()->vote;

        // get the curr user
        auth()->user()->voteQuestion($question, $vote);

        return back();
    }
}