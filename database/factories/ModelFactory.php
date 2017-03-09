<?php

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| Here you may define all of your model factories. Model factories give
| you a convenient way to create models for testing and seeding your
| database. Just tell the factory how a default model should look.
|
*/

/** @var \Illuminate\Database\Eloquent\Factory $factory */
$factory->define(App\User::class, function (Faker\Generator $faker) {
    static $password;

    return [
        'firstname' => $faker->firstname,
        'lastname' => $faker->lastName,
        'city' => $faker->city,
        'email' => $faker->unique()->safeEmail,
        'verified' => $faker->boolean,
        'password' => $password ?: $password = bcrypt('secret'),
        'remember_token' => str_random(10),
    ];
});

$factory->define(App\Message::class, function (Faker\Generator $faker) {
    return [
    	'conversation_id' => 1,
        'body' => $faker->paragraph,
    ];
});