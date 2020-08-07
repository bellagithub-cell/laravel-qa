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

}
