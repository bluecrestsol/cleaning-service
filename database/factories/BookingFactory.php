<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Booking;
use App\Models\Customer;
use App\Models\Service;
use Faker\Generator as Faker;

$factory->define(Booking::class, function (Faker $faker) {
    $services = Service::all()->random(mt_rand(1, 4))->pluck('id')->all();
    return [
        'customer_id' => Customer::all()->random()->id,
        'status' => $faker->randomElement(['new', 'processed', 'deleted']),
        'name' => $faker->word,
        'business_name' => $faker->company,
        'category_id' => null,
        'email' => $faker->safeEmail,
        'phone' => $faker->e164PhoneNumber,
        'country_id' => 226,
        'company_id' => 1,
        'area' => $faker->word,
        'services' => implode(",", $services),
        'address' => $faker->address,
        'notes' => $faker->text,
        'booked_at' => $faker->dateTime
    ];
});
