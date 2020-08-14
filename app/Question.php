<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Question extends Model
{
    use VotableTrait;
    
    // buat atribut
    protected $fillable = ['title', 'body'];

    // karena banyak question bisa di miliki oleh satu user
    // dan question relate dengan user 
    public function user(){
        return $this->belongsTo(User::class);
    }

     // buat mutator untuk question
    // karena kita gk mau buat slug secara manual
    public function setTitleAttribute($value){
        $this->attributes['title'] = $value;
        $this->attributes['slug'] = Str::slug($value);
        // slug ini akan simpen title namun dengan format slug
    }

    // // kalau mau cara yg pertama buat atasi malicious
    // public function setBodyAttribute($value){
    //     $this->attribute['body'] = clean($value);
    // }

    public function getUrlAttribute(){
        return route("questions.show", $this->slug);
    }

    public function getCreatedDateAttribute(){
        // karena ingin kasih tau created datenya 4 hari yg lalu
        // atau 16 hari yg lalu
        return $this->created_at->diffForHumans();
    }


    //buat dapetin status dari 3 kondisi answer2 itu
    public function getStatusAttribute(){
        if($this->answers_count > 0){
            if($this->best_answer_id){
                return "answered-accepted";
            }
            return "answered";
        }
        return "unanswered";
    }

    // acesor buat nampilin question body
    public function getBodyHtmlAttribute(){
        // convert mardown syntax to html
        // return \Parsedown::instance()->text($this->body);

        // $markdown = new CommonMarkConverter(['allow_unsafe_links' => false]);
        // return $markdown->convertToHtml($this->body);

        // buat acesor malicious
        return clean($this->bodyHtml());
    }


    // define relationship method with answer
    public function answers(){
        return $this->hasMany(Answer::class);
    }

    // create method buat ceklik best answer button
    public function acceptBestAnswer(Answer $answer){
        $this->best_answer_id = $answer->id;
        $this->save();
    }

    public function favorites(){
        return $this->belongsToMany(User::class, 'favorites')->withTimestamps();
    }

    // method buat check favorite gak  
    public function isFavorited(){
        return $this->favorites()->where('user_id', auth()->id())->count() > 0; 
    }

    public function getIsFavoritedAttribute(){
        return $this->isFavorited();
    }

    // return favorites count
    public function getFavoritesCountAttribute(){
        return $this->favorites->count();
    }
    

    // pindah kek VotableTrait

    // acesor baru buat malicious
    public function getExcerptAttribute(){
        // return Str::limit(strip_tags($this->bodyHtml()), 300);
        // kalau gk mau ribet bisa pakai ini
        return $this->excerpt(250);
    }

    private function bodyHtml(){
        return \Parsedown::instance()->text($this->body);
    }

    public function excerpt($length){
        return Str::limit(strip_tags($this->bodyHtml()), $length);
    }

}
