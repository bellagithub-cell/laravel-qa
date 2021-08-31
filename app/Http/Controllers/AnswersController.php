<?php

namespace App\Http\Controllers;

use App\Answer;
use App\Question;
use Illuminate\Http\Request;

class AnswersController extends Controller
{   
    // to check user has signedin
    public function __construct(){
        $this->middleware('auth')->except('index');
    }

    // to fecth all answer
    public function index(Question $question){
        return $question->answers()->with('user')->simplePaginate(3);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Question $question, Request $request)
    {
        //karena di route kita include {question}
        // we need to capture the question by specify or type-hint
        // argumen pertama with a question instance
        dd($question);
        // kalau valid pass gan
        $answer = $question->answers()->create($request->validate([
            // specifyy validation rules to answer body
            'body' => 'required'
        ]) + ['user_id' => \Auth::id()]);

        if($request->expectsJson()){
            return response()->json([
                'message' => "Your answer has been submited succesfully",
                'answer' => $answer->load('user')
            ]);
        }

        // back to previous page
        return back()->with('success', "Your answer has been submitted successfully");

    }

    
    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Answer  $answer
     * @return \Illuminate\Http\Response
     */
    public function edit(Question $question, Answer $answer)
    {
        //edit answer yg udah dibuat user
        // make sure yg edit answer is auth user
        $this->authorize('update', $answer);

        return view('answers.edit', compact('question', 'answer'));

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Answer  $answer
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Question $question, Answer $answer)
    {
        // auth user to update the answer
        $this->authorize('update', $answer);
        $answer->update($request->validate([
            'body' => 'required',
        ]));
        
       if($request->expectsJson()){
        return response()->json([
            'message' => 'Your answer has been updated',
            'body_html' => $answer->body_html
        ]);
       }
        return redirect()->route('questions.show', $question->slug)->with('success', 'Your answer has been updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Answer  $answer
     * @return \Illuminate\Http\Response
     */
    public function destroy(Question $question, Answer $answer)
    {
        //auth the user
        $this->authorize('delete', $answer);

        // delete the answer
        $answer->delete();

        if (request()->expectsJson())
        {
            return response()->json([
                'message' => "Your answer has been removed"
            ]);
        }

        // refresh the page
        return back()->with('success', "Your answer has been removed");
    }
}
