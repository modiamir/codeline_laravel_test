<?php

use Faker\Generator as Faker;

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

$factory->define(App\Film::class, function (Faker $faker) {
    return [
        'name' => $faker->name,
        'description' => $faker->text,
        'release_date' => $faker->date('Y-m-d'),
        'rating' => $faker->numberBetween(1,5),
        'ticket_price' => $faker->numberBetween(1000,10000),
        'country' => $faker->country,
        'photo' => 'film_photos/'.uniqid().'.png',
    ];
});
