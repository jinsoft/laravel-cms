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
        'email' => $faker->unique()->safeEmail,
        'password' => $password ?: $password = bcrypt('123456'),
    ];
});

$factory->define(\App\Model\Category::class,function (Faker $faker){
    return [
        'parent_id'=>0,
        'name'=>$faker->name
    ];
});

$factory->define(\App\Model\Tag::class,function (Faker $faker){
    return [
        'name'=>$faker->name
    ];
});

$factory->define(\App\Models\Article::class, function (Faker $faker) {
    $user_ids = \App\Model\User::pluck('id')->random();
    $category_ids = \App\Model\Category::pluck('id')->random();
    return [
        'user_id'=>$user_ids,
        'category_id'=>$category_ids,
        'title' => $faker->sentence(mt_rand(3, 10)),
        'body' => $faker->paragraph,
    ];
});
