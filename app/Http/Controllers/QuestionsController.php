<?php

namespace App\Http\Controllers;

use App\Question;
use Illuminate\Http\Request;
use App\Http\Requests\AskQuestionRequest;

class QuestionsController extends Controller
{
    // kita buat constructor ( yg pertama kali jalan ketika di run)
    // buat auth user, supaya gk sembarang orang yg belum login bisa create question
    public function __construct(){
        $this->middleware('auth', ['except' => ['index', 'show']]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // kita harus enable DB log buat analysis
        // \DB::enableQueryLog();

        //define variable untuk hold question
        // $questions = Question::latest()->paginate(10);
        // nampilin 5 question per page yg latest

        //buat jadiin dia eager loader
        $questions = Question::with('user')->latest()->paginate(10);


        // gk perlu return
        return view('questions.index', compact('questions'));

        // tinggal tambah 
        // render methods return string contain of the \view
        // view bakal di compile tp gk di render di browser
        // view('questions.index', compact('questions'))->render();

        // we can clearly log by calling
        // dd(\DB::getQueryLog());
        // pass it in dd helper
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //buat add question

        //define buat nampung question object
        $question = new Question();

        return view('questions.create', compact('question'));

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(AskQuestionRequest $request)
    {
        // untuk liat messagenya ibarat echo kali ya
        // dd('store');

        // get the current user sekalian buat questionnya
        $request->user()->questions()->create($request->only('title', 'body'));

        // define a flash using with methods
        return redirect()->route('questions.index')->with('success', "Your question has been submitted");
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Question  $question
     * @return \Illuminate\Http\Response
     */
    public function show(Question $question)
    {
        // buat check question body 
        // dd($question->body);

        // increment number of view, lebih easy cuma satu line
        $question->increment('views');

        return view('questions.show', compact('question'));

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Question  $question
     * @return \Illuminate\Http\Response
     */

    //  dengan adanya Question $question, si Question otomatis
    // inject model question(beserta id)
    // get id lah dah tuh kaya parameter
    public function edit(Question $question) // $id
    {
        //jadi di uri kan ada id question
        // $question = Question::findOrFail($id);
        // mirip kaya gini sebeneranya fungsi yg Question $question
        // cuma lebih di pendekin aja 

        // authorize action using policy
        $this->authorize("update", $question);

        return view("questions.edit", compact('question'));

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Question  $question
     * @return \Illuminate\Http\Response
     */
    public function update(AskQuestionRequest $request, Question $question)
    {
        // authorized user question using policy
        $this->authorize("update", $question);

        //
        $question->update($request->only('title', 'body'));

        // redirect jan lupa
        return redirect('/questions')->with('success', "Your question has been updated.");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Question  $question
     * @return \Illuminate\Http\Response
     */
    public function destroy(Question $question)
    {
        // authorized user question using policy
        $this->authorize("delete", $question);
        
        // buat hapus question broo
        $question->delete();

        return redirect('questions')->with('success', "Your question has been deleted.");
    }
}
