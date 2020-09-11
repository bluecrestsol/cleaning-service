<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\PlacesCategory;
use Faker\Generator as Faker;

$factory->define(PlacesCategory::class, function (Faker $faker) {
    return [
        'name' => $faker->word,
        'type' => $faker->randomElement(['private','commercial', 'public'])
    ];
});
