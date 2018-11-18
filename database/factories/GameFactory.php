<?php

$factory->define(App\Game::class, function (Faker\Generator $faker) {
    return [
        "team1_id" => factory('App\Team')->create(),
        "team2_id" => factory('App\Team')->create(),
        "results1" => $faker->randomNumber(2),
        "results2" => $faker->randomNumber(2),
        "status" => $faker->randomNumber(2),
    ];
});
