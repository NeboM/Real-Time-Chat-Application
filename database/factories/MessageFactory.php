<?php

/* @var $factory \Illuminate\Database\Eloquent\Factory */

use App\Message;
use Faker\Generator as Faker;
use Illuminate\Support\Str;

$factory->define(Message::class, function (Faker $faker) {
    return [
        'sender_id' => $faker->numberBetween($min=1,$max=5),
        'receiver_id' => $faker->numberBetween($min=1,$max=5),
        'body' => $faker->text(100),
    ];
});
