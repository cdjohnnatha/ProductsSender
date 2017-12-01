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
    $type = $faker->numberBetween(0, 1);
    return [
        'email' => $faker->unique()->safeEmail,
        'type' => $type ? 'admin' : 'user',
        'password' => $password ?: $password = bcrypt('secret'),
        'remember_token' => str_random(10),
    ];
});

$factory->define(App\Client::class, function (Faker\Generator $faker) {
    return [
        'name' => $faker->firstName,
        'surname' => $faker->lastName,
        'identity_document' => $faker->numberBetween(1000000, 9999999),
        'tax_document' => $faker->numberBetween(1000000, 9999999),
        'default_address' => function() {
        return factory(App\ClientAddress::class)->create()->id;
        },
        'user_id' => function() {
        return factory(App\User::class)->create()->id;
        }
    ];
});


$factory->define(App\ClientAddress::class, function (Faker\Generator $faker) {
    return [
        'label' => $faker->name,
        'owner_name' => $faker->firstName,
        'owner_surname' => $faker->lastName,
        'company_name' => $faker->company,
        'country' => $faker->country,
        'street' => $faker->streetAddress,
        'street2' => $faker->streetName,
        'city' => $faker->city,
        'state' => $faker->streetName,
        'postal_code' => $faker->postcode,
        'phone' => $faker->phoneNumber,
        'number' => $faker->buildingNumber,
        'formatted_address' => $faker->address,
        'client_id' => function() {
            return factory(App\Client::class)->create()->id;
        }
    ];
});

/*
 * Company
 */
$factory->define(App\Company::class, function(Faker\Generator $faker) {
    return [
        'name' => $faker->company,
    ];
});

$factory->define(App\CompanyAddress::class, function(Faker\Generator $faker) {
    return [
        'country' => $faker->country,
        'street' => $faker->streetAddress,
        'street2' => $faker->streetAddress,
        'city' => $faker->city,
        'state' => $faker->streetAddress,
        'postal_code' => $faker->postcode,
        'number' => $faker->buildingNumber,
        'formatted_address' => $faker->address,
        'company_id' => function() {
            return factory(App\Company::class)->create()->id;
        }
    ];
});

$factory->define(App\CompanyPhone::class, function(Faker\Generator $faker) {
    return [
        'number' => $faker->phoneNumber,
        'company_id' => function() {
            return factory(App\Company::class)->create()->id;
        }
    ];
});

$factory->define(App\CompanyAddons::class, function(Faker\Generator $faker) {
    return [
        'title' => $faker->jobTitle,
        'company_id' => function() {
            return factory(App\Company::class)->create()->id;
        }
    ];
});


/**
 * COMPANY WAREHOUSE
 */

/** @var \Illuminate\Database\Eloquent\Factory $factory */
$factory->define(App\CompanyWarehouse::class, function (Faker\Generator $faker) {

    return [
        'name' => $faker->company,
        'storage_time' => $faker->numberBetween($min = 30, $max = 60),
        'box_price' => $faker->randomFloat($nbMaxDecimals = 2, $min = 0, $max = 4),
        'company_id' => function() {
            return factory(App\Company::class)->create()->id;
        }
    ];
});

$factory->define(App\CompanyWarehouseAddress::class, function(Faker\Generator $faker) {
    return [
        'country' => $faker->country,
        'street' => $faker->streetAddress,
        'street2' => $faker->streetAddress,
        'city' => $faker->city,
        'state' => $faker->streetAddress,
        'postal_code' => $faker->postcode,
        'number' => $faker->buildingNumber,
        'formatted_address' => $faker->address,
        'company_warehouse_id' => function() {
            return factory(App\CompanyWarehouse::class)->create()->id;
        }
    ];
});


$factory->define(App\CompanyWarehousePhones::class, function(Faker\Generator $faker) {
    return [
        'number' => $faker->phoneNumber,
        'company_warehouse_id' => function() {
            return factory(App\CompanyWarehouse::class)->create()->id;
        }
    ];
});

$factory->define(App\CompanyWarehouseAddon::class, function(Faker\Generator $faker) {
    return [
        'title' => $faker->jobTitle,
        'company_warehouse_id' => function() {
            return factory(App\CompanyWarehouse::class)->create()->id;
        },
        'company_addons_id' => function() {
        return factory(App\CompanyAddons::class)->create()->id;
    }
    ];
});

