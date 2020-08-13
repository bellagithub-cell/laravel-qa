<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Model;
use Faker\Generator as Faker;

$factory->define(App\Answer::class, function (Faker $faker) {
    return [
        //define model buat seed baru di answer :)
        // jan lupa dikasih true buat convert paragraph into string
        'body' => $faker->paragraphs(rand(3, 7), true),
        // cara buat user id nya sesuai dengan yg ada di database user
        'user_id' => App\User::pluck('id')->random(),
        // 'votes_count' => rand(0, 5),



    ];
});
