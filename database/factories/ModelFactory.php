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
        'name' => $faker->name,
        'surname' => $faker->lastName,
        'email' => $faker->unique()->safeEmail,
        'country' => $faker->country,
        'subscription' => $faker->numberBetween($min = 1, $max = 2),
        'phone' => $faker->phoneNumber,
        'password' => $password ?: $password = bcrypt('secret'),
        'remember_token' => str_random(10),
    ];
});

$factory->define(App\Admin::class, function (Faker\Generator $faker) {
    static $password;

    return [
        'name' => $faker->name,
        'surname' => $faker->lastName,
        'email' => $faker->unique()->safeEmail,
        'country' => $faker->country,
        'phone' => $faker->phoneNumber,
        'password' => $password ?: $password = bcrypt('secret'),
        'remember_token' => str_random(10),
    ];
});


/** @var \Illuminate\Database\Eloquent\Factory $factory */
$factory->define(App\Warehouse::class, function (Faker\Generator $faker) {

    return [
        'name' => $faker->company,
        'storage_time' => $faker->numberBetween($min = 30, $max = 60),
        'created_by' => 1,
        'updated_by' => 1,
        'box_price' => $faker->randomFloat($nbMaxDecimals = 2, $min = 0, $max = 5),
        'address_id' => $faker->numberBetween($min = 1, $max = 5),
    ];
});

/** @var \Illuminate\Database\Eloquent\Factory $factory */
$factory->define(App\Address::class, function (Faker\Generator $faker) {
    $type = $faker->numberBetween($min = 1, $max = 3);
    switch ($type){
        case 1:
            $type = 'user';
            break;
        case 2:
            $type = 'admin';
            break;
        case 3:
            $type = 'warehouse';
            break;
    }
    return [
        'label' => $faker->company,
        'owner_name' => $faker->firstName,
        'owner_surname' => $faker->lastName,
        'company_name' => $faker->company,
        'country' => $faker->country,
        'address' => $faker->address,
        'city' => $faker->city,
        'state' => $faker->city,
        'postal_code' => $faker->postcode,
        'phone' => $faker->phoneNumber,
        'addressable_id' => $faker->numberBetween($min = 1, $max = 3),
        'addressable_type' => $type,
        'default_address' => $faker->boolean

    ];
});

/** @var \Illuminate\Database\Eloquent\Factory $factory */
$factory->define(App\Subscription::class, function (Faker\Generator $faker) {

    return [
        'name' => $faker->company,
        'amount' => $faker->randomFloat($nbMaxDecimals = 2, $min = 1, $max = 6),
        'currency' => 'usd',
        'created_by' => 1,
        'updated_by' => 1,
    ];
});
