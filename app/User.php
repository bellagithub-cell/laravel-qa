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
    public function question(){

        return $this->hasMany(Question::class);
    }

    // buat mutator untuk question
    public function setTitleAttribute($value){
        $this->attribute['title'] = $value;
        $this->attribute['slug'] = Str::slug($value);
        // slug ini akan simpen title namun dengan format slug
    }
}
