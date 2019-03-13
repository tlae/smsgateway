<?php

use Faker\Generator as Faker;

$factory->define(App\Message::class, function (Faker $faker) {
    return [
       'msisdn' => $faker->randomElement($array = array ('+255789124532','+255754876509','+255688765910','+255716626162', '+255713728190', '+255732881700', '+255777761000')),
       'body' =>  $faker->realText($maxNbChars = 420, $indexSize = 1)
       
    ];
});
