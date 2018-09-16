<?php

use Faker\Generator as Faker;
use LaravelEnso\Core\app\Models\Owner;
use LaravelEnso\Contacts\app\Models\Contact;

$factory->define(Contact::class, function (Faker $faker) {
    return [
        'contactable_id' => 1,
        'contactable_type' => Owner::class,
        'first_name' => $faker->firstName,
        'last_name' => $faker->lastName,
        'phone' => $faker->phoneNumber,
        'email' => $faker->unique()->safeEmail,
        'created_by' => 2,
        'is_active' => $faker->numberBetween($min = 0, $max = 1),
    ];
});
