<?php

$factory->define(App\User::class, function (Faker\Generator $faker) {
    return [
        'name' => $faker->name,
        'email' => $faker->email,
        'password' => bcrypt(str_random(10)),
        'remember_token' => str_random(10),
    ];
});

$factory->define(App\Phone::class, function (Faker\Generator $faker) {
    return [
        'user_id' => factory(App\User::class)->create()->id,
        'name' => $faker->word
    ];
});

$factory->define(App\Post::class, function (Faker\Generator $faker) {
    return [
        'title' => $faker->sentence,
        'body' => $faker->paragraph
    ];
});

$factory->define(App\Comment::class, function (Faker\Generator $faker) {
    return [
        'post_id' => factory(App\Post::class)->create()->id,
        'comment' => $faker->paragraph
    ];
});

$factory->define(App\Country::class, function (Faker\Generator $faker) {
    return [
        'name' => $faker->country
    ];
});

$factory->define(App\Video::class, function (Faker\Generator $faker) {
    return [
        'name' => $faker->word
    ];
});