<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // $this->call(UserSeeder::class);

        // tiap kali user di create, kita buat fake question untuk user itu
        // factory(App\User::class, 3)->create()->each(function ($u){
        //     $u->questions()->saveMany(factory(App\Question::class, rand(1, 5))->make()
        // )
        //     // kalau mau buat lebih dari satu question
        //     // pakai make buat di store di memory


        //     // create several answers for every question.
        //     ->each(function ($q){
        //         $q->answers()->saveMany(factory(App\Answer::class, rand(1, 5))->make());
        //     });

        // }); pindah ke userquestionsanswerdatabaseseeder

        // sudah canggih sekarang, ditambah favorites juga
        $this->call([
            UsersQuestionsAnswersTableSeeder::class,
            FavoritesTableSeeder::class,
        ]);
        
    }
}
