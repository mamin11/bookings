<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Product;
use Illuminate\Support\Str;
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

$factory->define(Product::class, function (Faker $faker) {
    return [
        'name' => $faker->name,
        'description' => $faker->paragraph,
        'price' => rand(1,50), 
        'material_id' => rand(1,7), 
        'size_id' => rand(1,6), 
        'category_id' => rand(1,5), 
        'quantity' => rand(1,20), 
        'created_at' => now(), 
        'updated_at' => now(), 
    ];
});
