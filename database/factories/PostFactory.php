<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Post;
use Faker\Generator as Faker;

$factory->define(Post::class, function (Faker $faker) {
    return [
        'user_id' => factory(App\User::class),
        'post_type_id' => function () {
            $min = 1;
            $max = App\PostType::all()->count();

            return rand($min, $max);
        },
        'title' => $faker->sentence,
        'content' => $faker->paragraph,
        'created_at' => now(),
        'updated_at' => now()
    ];
});
