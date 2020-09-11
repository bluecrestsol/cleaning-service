<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\BillingDetail;
use Faker\Generator as Faker;

$factory->define(BillingDetail::class, function (Faker $faker) {
    return [
        'first_name' => $faker->firstName,
        'last_name' => $faker->lastName,
        'email' => $faker->safeEmail,
        'mobile' => $faker->e164PhoneNumber,
        'phone' => $faker->e164PhoneNumber,
        'name' => $faker->word,
        'tax_code' => $faker->word
    ];
});
