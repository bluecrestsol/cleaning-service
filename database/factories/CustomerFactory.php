<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Customer;
use Faker\Generator as Faker;

$factory->define(Customer::class, function (Faker $faker) {
    
    do {
        $code = mt_rand(00000000, 99999999); 
    } while(Customer::where('code', $code)->count() > 0);
    return [
        'code' => $code,
        'email' => $faker->unique()->safeEmail,
        'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi',
        'first_name' => $faker->firstName,
        'middle_name' => $faker->lastName,
        'last_name' => $faker->lastName,
        'title' => $faker->randomElement(['mr','mrs','ms','dr','prof']),
        'country_id' => 226,
        'company_id' => 1,
        'language_id' => 157,
        'business_name' => $faker->company,
        'mobile' => $faker->e164PhoneNumber,
        'phone' => $faker->e164PhoneNumber,
        'line' => $faker->word,
        'whatsapp' => $faker->e164PhoneNumber
    ];
});
