<?php

use Carbon\Carbon;
use App\ProductMultipleImage;
use Illuminate\Database\Seeder;

class ProductMultipleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      ProductMultipleImage::create([
        'product_multiple_image' => '1-1.jpg',
        'product_id'            =>  1,
        'created_at'            => Carbon::now(),
      ]);
      ProductMultipleImage::create([
        'product_multiple_image' => '1-2.jpg',
        'product_id'            =>  1,
        'created_at'            => Carbon::now(),
      ]);
      ProductMultipleImage::create([
        'product_multiple_image' => '1-3.jpg',
        'product_id'            =>  1,
        'created_at'            => Carbon::now(),
      ]);
      ProductMultipleImage::create([
        'product_multiple_image' => '2-1.jpg',
        'product_id'            =>  2,
        'created_at'            => Carbon::now(),
      ]);
      ProductMultipleImage::create([
        'product_multiple_image' => '2-2.jpg',
        'product_id'            =>  2,
        'created_at'            => Carbon::now(),
      ]);
      ProductMultipleImage::create([
        'product_multiple_image' => '2-3.jpg',
        'product_id'            =>  2,
        'created_at'            => Carbon::now(),
      ]);
      ProductMultipleImage::create([
        'product_multiple_image' => '3-1.jpg',
        'product_id'            =>  3,
        'created_at'            => Carbon::now(),
      ]);
      ProductMultipleImage::create([
        'product_multiple_image' => '3-2.jpg',
        'product_id'            =>  3,
        'created_at'            => Carbon::now(),
      ]);
      ProductMultipleImage::create([
        'product_multiple_image' => '3-3.jpg',
        'product_id'            =>  3,
        'created_at'            => Carbon::now(),
      ]);
      ProductMultipleImage::create([
        'product_multiple_image' => '4-1.jpg',
        'product_id'            =>  4,
        'created_at'            => Carbon::now(),
      ]);
      ProductMultipleImage::create([
        'product_multiple_image' => '4-2.jpg',
        'product_id'            =>  4,
        'created_at'            => Carbon::now(),
      ]);
      ProductMultipleImage::create([
        'product_multiple_image' => '4-3.jpg',
        'product_id'            =>  4,
        'created_at'            => Carbon::now(),
      ]);
      ProductMultipleImage::create([
        'product_multiple_image' => '5-1.jpg',
        'product_id'            =>  5,
        'created_at'            => Carbon::now(),
      ]);
      ProductMultipleImage::create([
        'product_multiple_image' => '5-2.jpg',
        'product_id'            =>  5,
        'created_at'            => Carbon::now(),
      ]);
      ProductMultipleImage::create([
        'product_multiple_image' => '5-3.jpg',
        'product_id'            =>  5,
        'created_at'            => Carbon::now(),
      ]);
    }
}
