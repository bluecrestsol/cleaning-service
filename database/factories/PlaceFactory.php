<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Place;
use App\Models\PlacesCategory;
use App\Models\Customer;
use App\Models\District;
use App\Models\City;
use App\Models\State;
use Faker\Generator as Faker;

$factory->define(Place::class, function (Faker $faker) {
    do {
        $code = mt_rand(00000000, 99999999); 
    } while(Place::where('code', $code)->count() > 0);
    return [
        'code' => $code,
        'customer_id' => Customer::all()->random()->id,
        'places_category_id' => PlacesCategory::all()->random()->id,
        'status' => $faker->randomElement(['enabled','disabled']),
        'name' => $faker->word,
        'description' => $faker->text,
        'area' => $faker->randomFloat(),
        'district_id' => District::all()->random()->id,
        'city_id' => City::all()->random()->id,
        'state_id' => State::all()->random()->id,
        'country_id' => 226,
        'type' => $faker->randomElement(['private','commercial','public']),
        'is_listing_public' => $faker->numberBetween(0,1),
        'is_history_public' => $faker->numberBetween(0,1),
        'is_gallery_public' => $faker->numberBetween(0,1)
    ];
});
