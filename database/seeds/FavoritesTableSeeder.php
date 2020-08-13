<?php

use Illuminate\Database\Seeder;
use App\User;
use App\Question;

class FavoritesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //delete favorites table
        \DB::table('favorites')->delete();

        // make sure we have no duplicate records when we run the seeder individually.
        $users = User::pluck('id')->all();
        $numberOfUsers = count($users);

        foreach(Question::all() as $question){
            for($i = 0; $i < rand(1, $numberOfUsers); $i++){
                $user = $users[$i];
                
                // attach the current question to the random user
                $question->favorites()->attach($user);
            }
        }

    }
}
