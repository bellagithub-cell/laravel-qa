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

   
}
