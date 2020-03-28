<?php

use Faker\Generator as Faker;
use App\User;
use App\Author;
use App\Order;

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

$factory->define(App\User::class, function (Faker $faker) {
    return [
        'name' => $faker->name,
        'email' => $faker->unique()->safeEmail,
        'password' => '$2y$10$TKh8H1.PfQx37YgCzwiKb.KjNyWgaHb9cbcoQgdIVFlYg7B77UdFm', // secret
        'remember_token' => str_random(10),
        'verified' => $verified = $faker->randomElement([User::VERIFIED_USER, User::UNVERIFIED_USER]),
        'verification_token' => $verified == User::VERIFIED_USER ? null : User::generateVerrificationCode(),
        'admin' => $admin = $faker->randomElement([User::ADMIN_USER, User::REGULAR_USER])
    ];
});

$factory->define(App\Category::class, function (Faker $faker) {
    return [
        'name' => $faker->word,
        'description' => $faker->paragraph(1),

    ];
});


$factory->define(App\Author::class, function (Faker $faker) {
    return [
        'name' => $faker->name,
        'biography' => $faker->paragraph(1),

    ];
});

$factory->define(App\Product::class, function (Faker $faker) {
    return [
        'name' => $faker->word,
        'description' => $faker->paragraph(1),
        'image' => $faker->randomElement(['1.jpg', '2.jpg', '3.jpg']),
        'author_id' => Author::all()->random()->id,
        'quantity' => $faker->numberBetween(1,100),
        'price' => $price = $faker-> randomFloat(2,40000,600000),
        'price_discount' => $price - $faker->randomFloat(2,1000,30000),
        'rating_average' => $faker ->randomFloat(1,0,5),
        'rating_quantity' => $faker->numberBetween(1,100),

    ];
});


$factory->define(App\Order::class, function (Faker $faker) {
    return [
        'name' => $faker->name,
        'address' => $faker->address,
        'phone' => $faker->phoneNumber,
        'note'=> $faker->paragraph(1),
        'ship_status' => $faker->randomElement([Order::NOT_SHIPPED, Order::SHIPPED]),
        'paid_status' => $faker->randomElement([Order::PAID_INVOICE, Order::UNPAID_INVOICE]),
        'user_id' => User::all()->random()->id,


    ];
});

