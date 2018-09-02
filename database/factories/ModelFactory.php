<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/8/30
 * Time: 22:09
 */

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

$factory->define(\App\Model\User::class, function (Faker $faker) {
    static $password;
    return [
        'uuid' => \Faker\Provider\Uuid::uuid(),
        'name' => $faker->name,
        'phone' => $faker->phoneNumber,
        'email' => $faker->safeEmail,
        'password' => $password ?: $password = bcrypt('123456'),
    ];
});

$factory->define(\App\Models\Article::class, function (Faker $faker) {
    return [
        'title' => $faker->sentence(mt_rand(3, 10)),
        'body' => $faker->paragraph,
    ];
});
