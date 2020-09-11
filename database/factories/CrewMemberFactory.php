<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\CrewMember;
use Faker\Generator as Faker;

$factory->define(CrewMember::class, function (Faker $faker) {

    do {
        $code = mt_rand(00000000, 99999999); 
    } while(CrewMember::where('code', $code)->count() > 0);
    return [
        'code' => $code,
        'email' => $faker->unique()->safeEmail,
        'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi',
        'type' => $faker->randomElement(['hired','freelancer']),
        'status' => $faker->randomElement(['enabled','disabled', 'dismissed']),
        'first_name' => $faker->firstName,
        'last_name' => $faker->lastName,
        'position' => $faker->jobTitle,
        'gender' => $faker->randomElement(['male','female']),
        'nationality_country_id' => 226,
        'country_id' => 226,
        'company_id' => 1,
        'date_of_birth' => $faker->dateTime,
        'doc_type' => $faker->randomElement(['passport','id_card','drivers_license']),
        'mobile_number' => $faker->e164PhoneNumber,
        'line' => $faker->word,
        'whatsapp' => $faker->e164PhoneNumber
    ];
});
