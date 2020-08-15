<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Answer extends Model
{

    use VotableTrait;
    
    // define fillable attribute
    protected $fillable = ['body', 'user_id'];

    protected $appends = ['created_date'];

    //define inverse relationship method 
    public function question(){
        return $this->belongsTo(Question::class);
    }

    // define relationship with user
    public function user(){
        return $this->belongsTo(User::class);
    }

    // because answer's body written in markdown syntax 
    // acesor buat nampilin question body
    public function getBodyHtmlAttribute(){
        // convert mardown syntax to html
        return clean(\Parsedown::instance()->text($this->body));

        // $markdown = new CommonMarkConverter(['allow_unsafe_links' => false]);
        // return $markdown->convertToHtml($this->body);
    }

    //define boot model 
    public static function boot(){
        parent::boot();

        // execute code when answer is created
        static::created(function ($answer){
            // echo "Answer created\n";
            $answer->question->increment('answers_count');
            // $answer->question->save();
        });

        //buat kurangin answer count
        static::deleted(function ($answer){
            // update best answer id taro di variable
            // $question = $answer->question;

            $answer->question->decrement('answers_count');

            //cocokin best_answer_id di question model sama
            // id di answer model
            // if($question->best_answer_id === $answer->id){
            //     $question->best_answer_id = NULL;
            //     $question->save();
            // }
        });

        // static::saved(function ($answer){
        //     echo "Answer saved\n";
        // });

    }

    public function getCreatedDateAttribute(){
        // karena ingin kasih tau created datenya 4 hari yg lalu
        // atau 16 hari yg lalu
        return $this->created_at->diffForHumans();
    }

    // buat best answer id
    public function getStatusAttribute(){
        return $this->isBest ? 'vote-accepted' : '';
    }

    //buat cek apakah sudah di acc best answer
    public function getIsBestAttribute(){
        return $this->isBest();
    }

    public function isBest(){
        return $this->id === $this->question->best_answer_id;
    }

    // pemakaian DRY pindah ke VotableTrait
}
