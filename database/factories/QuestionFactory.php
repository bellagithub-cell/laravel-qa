<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Model;
use Faker\Generator as Faker;

$factory->define(App\Question::class, function (Faker $faker) {
    return [
        // rtrim fungsinya untuk ilangin tanda . di akhir kalimat
        'title' => rtrim($faker->sentence(rand(5, 10)), "."),

        // pakai rand, kalau paragraphs aja dia array outputnya
        // kalau pake true dia jadi string dan di separate sama \n
        'body' => $faker->paragraphs(rand(3, 7), true),
        // set number untuk question views
        'views' => rand(0, 10),
        // 'answers_count' => rand(0, 10),
        // 'votes_count' => rand(-3, 10) // votes bisa negatif ya gengs
    ];
});
