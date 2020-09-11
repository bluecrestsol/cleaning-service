<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\CountryService;
use App\Models\Service;
use Faker\Generator as Faker;

$ids = [];
$factory->define(CountryService::class, function (Faker $faker) use (&$ids) {
    $service = Service::whereNotIn('id', $ids)->get()->random()->id;
    $ids[] = $service;
    return [
        'country_id' => 226,
        'service_id' => $service,
        'status' => 'enabled'
    ];
});
