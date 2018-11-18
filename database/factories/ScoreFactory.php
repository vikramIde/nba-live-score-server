<?php

$factory->define(App\Score::class, function (Faker\Generator $faker) {
    return [
        "games_id" => factory('App\Game')->create(),
        "players_id" => factory('App\Player')->create(),
        "rules_id" => factory('App\Rule')->create(),
    ];
});
