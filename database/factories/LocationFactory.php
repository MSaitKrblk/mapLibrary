<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Location;
use Faker\Generator as Faker;

$factory->define(location::class, function (Faker $faker) {
    return [
        'title' => $faker-> sentence(3),
        'description' => $faker-> text($maxNbChars = 700) ,
        'lat' => $faker-> latitude($min = -90, $max = 90),
        'lng' => $faker-> longitude($min = -180, $max = 180) ,
    ];
});
