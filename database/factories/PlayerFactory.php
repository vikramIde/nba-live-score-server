<?php

$factory->define(App\Player::class, function (Faker\Generator $faker) {
    return [
        "team_id" => factory('App\Team')->create(),
        "name" => $faker->name,
        "surname" => $faker->name,
        "birth_date" => $faker->date("Y-m-d H:i:s", $max = 'now'),
    ];
});
