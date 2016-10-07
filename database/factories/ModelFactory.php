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

$factory->define(App\User::class, function (Faker\Generator $faker) {
    return [
        'name' => $faker->name,
        'email' => $faker->safeEmail,
        'password' => bcrypt(str_random(10)),
        'remember_token' => str_random(10),
        'api_token' => str_random(60)
    ];
});

$factory->define(App\Citylist::class, function (Faker\Generator $faker) {
    return [
        'city' => $faker->city
    ];
});

$factory->define(App\Category::class, function () {
    $arr = [
        'Food',
        'Restaurants',
        'Stationary',
        'Electronics',
        'Consumer Goods'
    ];
     $index = rand(0, (count($arr)-1));

    return [
      'name' => $arr[$index]
    ];
});