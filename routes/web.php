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

//define show route manually tp parametersnya aja yg diganti jadi slug
Route::get('/questions/{slug}', 'QuestionsController@show')->name('questions.show');
