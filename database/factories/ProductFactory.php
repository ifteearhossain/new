<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Product;
use Carbon\Carbon;
use Illuminate\Support\Str;
use Faker\Generator as Faker;

$factory->define(Product::class, function (Faker $faker) {
    $title = $faker->sentence(2);
    $slug = Str::slug($title) . '-' . Str::random(10);
    static $order = 1; 


    return [
        'product_name'               => $faker->sentence(2),
        'product_price'              => $faker->numberBetween(100, 5000),
        'product_brand'              => $faker->sentence(1),
        'category_id'                => $faker->numberBetween(1, 12),
        'sub_category_id'            => $faker->numberBetween(1, 19),
        'product_quantity'           => $faker->numberBetween(1, 99),
        'shop_id'                    => null, 
        'product_short_description'  => $faker->sentence(15),
        'product_long_description'   => $faker->sentence(20),
        'product_thumbnail_image'    => $order++ . '.jpg',
        'product_slug'               => $slug,
        'user_id'                    => $faker->numberBetween(0, 1),
        'created_at'                 => Carbon::now(),

    ];
});