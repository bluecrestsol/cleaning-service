<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */
use App\Models\Admin;
use App\Models\Country;
use App\Models\Company;
use Faker\Generator as Faker;
use Illuminate\Support\Str;

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| This directory should contain each of the model factory definitions for
| your application. Factories provide a convenient way to generate new
| model instances for testing / seeding your application's database.
|
*/

$factory->define(Admin::class, function (Faker $faker) {
    return [
        'first_name' => $faker->name,
        'last_name' => $faker->name,
        'email' => $faker->unique()->safeEmail,
        'email_verified_at' => now(),
        'password' => '$2y$10$f2dAFpK71fBxpNs/aGLZZ.zxbKISkfcfe47gBHj5npYFGhZF9efyC', // password
        'status' => $faker->randomElement(['enabled','disabled']),
        'active_country_id' => Country::inRandomOrder()->first()->id,
        'active_company_id' => Company::inRandomOrder()->first()->id,
        'remember_token' => Str::random(10),
    ];
});
