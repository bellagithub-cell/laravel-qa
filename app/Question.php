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
        return route("questions.show", $this->id);
    }

    public function getCreatedDateAttribute(){
        // karena ingin kasih tau created datenya 4 hari yg lalu
        // atau 16 hari yg lalu
        return $this->created_at->diffForHumans();
    }

}
