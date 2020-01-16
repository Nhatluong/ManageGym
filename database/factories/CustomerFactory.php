<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Model;
use Faker\Generator as Faker;

$factory->define(\App\models\Customer::class, function (Faker $faker) {
    return [
        'name' => $faker->name,
        'address' => 'dia chi khach hang',
        'number_phone' => $faker->e164PhoneNumber,
        'avatar' => 'url image',
        'package_ticket_id' => factory(\App\models\PackageTicket::class)->create()->id,
        'date_buy' => $faker->dateTime,
        'date_end' => $faker->dateTime,
    ];
});
