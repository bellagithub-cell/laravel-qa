<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //buat authorize user using gates
        // jadi di function ini, parameter pertama itu namanya, 
        // parameter kedua itu function dah tuh,
        // parameter function itu instance yg represent curr user 
        // terus model instance
        \Gate::define('update-question', function($user, $question){
            // match the curr user with uer id dari question
            return $user->id === $question->user_id;
            // balikin boolean, kalau true cocok begitu sebaliknya
        });

        \Gate::define('delete-question', function($user, $question){
            // match the curr user with uer id dari question
            return $user->id === $question->user_id;
            // balikin boolean, kalau true cocok begitu sebaliknya
        });
    }
}
