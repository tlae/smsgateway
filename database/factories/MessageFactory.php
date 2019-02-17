<?php

use Faker\Generator as Faker;

$factory->define(App\Message::class, function (Faker $faker) {
    return [
       'msisdn' => $faker->e164PhoneNumber(),
       'body' =>  $faker->realText($maxNbChars = 250, $indexSize = 1),
       'smsc' => $faker->randomElement($array = array ('voda@pccb','tigosmsc','halo-pccb','airtel')),
       'corruption_related' => $faker->randomElement($array = array (0,1)),
       'unread_count' => rand(0,7)
    ];
});
