<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
    // buat atribut
    protected $fillable = ['title', 'body'];
    
    // karena banyak question bisa di miliki oleh satu user
    // dan question relate dengan user 
    public function user(){
        return $this->belongsTo(User::class);
    }

}
