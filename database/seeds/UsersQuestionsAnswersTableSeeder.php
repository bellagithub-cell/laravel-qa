<?php

use Illuminate\Database\Seeder;

class UsersQuestionsAnswersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //pindah kesini 
        // tiap kali user di create, kita buat fake question untuk user itu
        
        //pake ini kalau gk mau pake migrate:fresh
        \DB::table('answers')->delete();
        \DB::table('questions')->delete();
        \DB::table('users')->delete();

        factory(App\User::class, 3)->create()->each(function ($u){
            $u->questions()->saveMany(factory(App\Question::class, rand(1, 5))->make()
        )
            // kalau mau buat lebih dari satu question
            // pakai make buat di store di memory


            // create several answers for every question.
            ->each(function ($q){
                $q->answers()->saveMany(factory(App\Answer::class, rand(1, 5))->make());
            });

        });
    }
}
