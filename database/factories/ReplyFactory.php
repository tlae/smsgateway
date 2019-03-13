<?php

use Faker\Generator as Faker;

$factory->define(App\Reply::class, function (Faker $faker) {
    return [
         'body' =>  $faker->realText($maxNbChars = 360, $indexSize = 1),
         'user_id' => App\User::pluck('id')->random()

    ];
});
