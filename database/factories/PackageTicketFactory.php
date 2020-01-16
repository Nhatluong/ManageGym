<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Model;
use Faker\Generator as Faker;

$factory->define(\App\models\PackageTicket::class, function (Faker $faker) {
    return [
        'name' => $faker->name,
        'price' => $faker->numberBetween(10000, 1000000),
        'discount' => $faker->numberBetween(0, 100),
        'date_used' => $faker->numberBetween(30, 365),
        'description' => 'mo ta goi tap'
    ];
});
