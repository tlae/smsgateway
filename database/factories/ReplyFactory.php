<?php

use Faker\Generator as Faker;

$factory->define(Model::class, function (Faker $faker) {
    return [
         'body' =>  $faker->realText($maxNbChars = 200, $indexSize = 1)
    ];
});
