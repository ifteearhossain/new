<?php

use App\Category;
use Carbon\Carbon;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
       Category::create([

        'category_name' => 'Men',
        'category_image'=> '1.jpg',
        'added_by'      => 1,
        'created_at'    => Carbon::now(),
        
       ]);
       
    
       Category::create([

        'category_name' => 'Children',
        'category_image'=> '2.jpg',
        'added_by'      => 1,
        'created_at'    => Carbon::now(),

       ]);
       Category::create([

        'category_name' => 'Electronics',
        'category_image'=> '3.jpg',
        'added_by'      => 1,
        'created_at'    => Carbon::now(),

       ]);
       Category::create([

        'category_name' => 'Furnitures',
        'category_image'=> '4.jpg',
        'added_by'      => 1,
        'created_at'    => Carbon::now(),

       ]);
       Category::create([

        'category_name' => 'Clothes',
        'category_image'=> '5.jpg',
        'added_by'      => 1,
        'created_at'    => Carbon::now(),

       ]);
       Category::create([

        'category_name' => 'Home, Garden & Kitchen',
        'category_image'=> '6.jpg',
        'added_by'      => 2,
        'created_at'    => Carbon::now(),

       ]);
       Category::create([

        'category_name' => 'Jewellery & Watches',
        'category_image'=> '7.jpg',
        'added_by'      => 2,
        'created_at'    => Carbon::now(),

       ]);
       Category::create([

        'category_name' => 'Sports',
        'category_image'=> '8.jpg',
        'added_by'      => 2,
        'created_at'    => Carbon::now(),

       ]);
       Category::create([

        'category_name' => 'Accessories',
        'category_image'=> '9.jpg',
        'added_by'      => 2,
        'created_at'    => Carbon::now(),

       ]);
       Category::create([

        'category_name' => 'Books',
        'category_image'=> '10.jpg',
        'added_by'      => 2,
        'created_at'    => Carbon::now(),

       ]);
       Category::create([

        'category_name' => 'Vehicle',
        'category_image'=> '11.jpg',
        'added_by'      => 2,
        'created_at'    => Carbon::now(),

       ]);
       Category::create([

        'category_name' => 'Women',
        'category_image'=> '12.jpg',
        'added_by'      => 1,
        'created_at'    => Carbon::now(),
        
       ]);
      
    }
   
   // END 
}
