<?php

$factory->define(App\Rule::class, function (Faker\Generator $faker) {
    return [
        "name" => $faker->name,
        "value" => $faker->randomNumber(2),
    ];
});
