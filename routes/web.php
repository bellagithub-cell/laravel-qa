<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

// karena kita gk cuma get, tp post, delete dll jadi pakai
// Route::resource('questions', 'QuestionsController');
// ini akan di handle oleh questionscontroller

// ini dipakai untuk mempercantik routes kita, dia nampilin semuanya kecuali show
Route::resource('questions', 'QuestionsController')->except('show');

// define route buat handle create answer question
// bisa seperti ini 
// Route::post('/questions/{question}/answers', 'AnswersController@store')->name('answers.store');
// atau bisa seperti ini
Route::resource('questions.answers', 'AnswersController')->only(['store', 'edit', 'update', 'destroy']);

//define show route manually tp parametersnya aja yg diganti jadi slug
Route::get('/questions/{slug}', 'QuestionsController@show')->name('questions.show');


// define root buat accept best annswer button itu loh
Route::post('/answers/{answer}/accept', 'AcceptAnswerController')->name('answers.accept');

// root for favoriting the question
Route::post('/questions/{question}/favorites', 'FavoritesController@store')->name('questions.favorite'); 

// root for unfavorite the question
Route::delete('/questions/{question}/favorites', 'FavoritesController@destroy')->name('questions.unfavorite'); 


// root for votes answer and question
Route::post('/questions/{question}/vote', 'VoteQuestionController');
// Route::post('/answers/{answer}/vote', 'VoteAnswerController'); 