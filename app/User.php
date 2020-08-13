<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    // define relationship method
    public function questions(){

        return $this->hasMany(Question::class);
    }

    // buat user acessor
    public function getUrlAttribute(){
        // return route("questions.show", $this->id);
        return '#';
        // karena belum buat route user
    }

    // define relationship method with answer
    public function answers(){
        return $this->hasMany(Answer::class);
    }

    public function getAvatarAttribute(){
        // buat dapet avatar
        $email = $this->email;
        $size = 32;

        return "https://www.gravatar.com/avatar/" . md5( strtolower( trim( $email ) ) ) . "?s=" . $size;

    }

    // define the relationships
    public function favorites(){
        return $this->belongsToMany(Question::class, 'favorites')->withTimestamps();
    }

    // define two relationship methods for questions and answers for vote
    public function voteQuestions(){
        return $this->morphedByMany(Question::class, 'votable');
    } 

    public function voteAnswers(){
        return $this->morphedByMany(Answer::class, 'votable');
    } 

    // define method for vote answer and wuestion
    public function voteQuestion(Question $question, $vote){
        $voteQuestions = $this->voteQuestions();

        $this->_vote($voteQuestions, $question, $vote);
        
        // mon maap diganti jadi DRY
        // if($voteQuestions->where('votable_id', $question->id)->exists()){
        //     $voteQuestions->updateExistingPivot($question, ['vote' => $vote]);
        // }
        // else {
        //     $voteQuestions->attach($question, ['vote' => $vote]);
        // }

        // // recount number of vote
        // // sum up between the number of votes up and number of votes down and then assigning it to 
        // // votes count column in question model
        // $question->load('votes');
        // $downVotes = (int) $question->downVotes()->sum('vote');
        // $upVotes = (int) $question->upVotes()->sum('vote');

        // // bisa yg seperti dibawah, bisa juga seprti diatas
        // // $upVotes = (int) $question->votes()->wherePivot('vote', 1)->sum('vote');

        // $question->votes_count = $upVotes + $downVotes;
        // $question->save();
    }

    public function voteAnswer(Answer $answer, $vote){
        $voteAnswers = $this->voteAnswers();
        $this->_vote($voteAnswers, $answer, $vote);

        // dihilangkan, lebih baik pakai DRY
        // if($voteAnswers->where('votable_id', $answer->id)->exists()){
        //     $voteAnswers->updateExistingPivot($answer, ['vote' => $vote]);
        // }
        // else {
        //     $voteAnswers->attach($answer, ['vote' => $vote]);
        // }

        // // recount number of vote
        // // sum up between the number of votes up and number of votes down and then assigning it to 
        // // votes count column in answer model
        // $answer->load('votes');
        // $downVotes = (int) $answer->downVotes()->sum('vote');
        // $upVotes = (int) $answer->upVotes()->sum('vote');

        // // bisa yg seperti dibawah, bisa juga seprti diatas
        // // $upVotes = (int) $answer->votes()->wherePivot('vote', 1)->sum('vote');

        // $answer->votes_count = $upVotes + $downVotes;
        // $answer->save();
    }

    // pemakaian DRY
    private function _vote($relationship, $model, $vote){

        if($relationship->where('votable_id', $model->id)->exists()){
            $relationship->updateExistingPivot($model, ['vote' => $vote]);
        }
        else {
            $relationship->attach($model, ['vote' => $vote]);
        }

        // recount number of vote
        // sum up between the number of votes up and number of votes down and then assigning it to 
        // votes count column in model model
        $model->load('votes');
        $downVotes = (int) $model->downVotes()->sum('vote');
        $upVotes = (int) $model->upVotes()->sum('vote');

        // bisa yg seperti dibawah, bisa juga seprti diatas
        // $upVotes = (int) $model->votes()->wherePivot('vote', 1)->sum('vote');

        $model->votes_count = $upVotes + $downVotes;
        $model->save();
    }

   
}
