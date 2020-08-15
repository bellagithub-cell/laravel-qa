<?php

namespace App\Http\Controllers;
use App\Question;

use Illuminate\Http\Request;

class FavoritesController extends Controller
{
    public function __construct(){
        // make sure user yg mau favorit or unfavorit udah sign in
        $this->middleware('auth');
    }
    
    
    //define the store method
    public function store(Question $question){
        // attach the question or make it to be favorited by current user 
        $question->favorites()->attach(auth()->id());

        if(request()->expectsJson()){
            return response()->json(null, 204);
        }
        // return back();
    }

    // define destroy method
    public function destroy(Question $question){
        $question->favorites()->detach(auth()->id());

        if(request()->expectsJson()){
            return response()->json(null, 204);
        }
        // return back();
    }
}
