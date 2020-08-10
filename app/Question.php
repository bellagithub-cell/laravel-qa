<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Question extends Model
{
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
        if($this->answers > 0){
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
        return \Parsedown::instance()->text($this->body);

        // $markdown = new CommonMarkConverter(['allow_unsafe_links' => false]);
        // return $markdown->convertToHtml($this->body);
    }

}
