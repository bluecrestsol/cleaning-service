<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Appointment;
use App\Models\Customer;
use App\Models\Admin;
use App\Models\Place;
use App\Models\Service;
use App\Models\Currency;
use Faker\Generator as Faker;

$factory->define(Appointment::class, function (Faker $faker) {
    return [
        'customer_id' => Customer::all()->random()->id,
        'admin_id' => Admin::all()->random()->id,
        'place_id' => Place::all()->random()->id,
        'service_id' => Service::all()->random()->id,
        'description' => $faker->text,
        'currency_id' => Currency::all()->random()->id,
        'price' => $faker->randomFloat(),
        'ordered_at' => $faker->dateTime,
        'status' => $faker->randomElement(['booked','cancelled_by_customer','cancelled_by_company','completed']),
        'payment_term' => $faker->randomElement(['prepaid','postpaid','on_appointment']),
        'payment_method' => $faker->randomElement(['cash','bank_transfer','card']),
        'invoice_number' => 'test',
        'invoice_file' => 'test',
        'payment_due_at' => $faker->dateTime,
        'paid_at' => $faker->dateTime,
        'serviced_at' => $faker->dateTime,
        'scheduled_at' => $faker->dateTime,
        'created_at' => $faker->dateTime,
        'updated_at' => $faker->dateTime
    ];
});
