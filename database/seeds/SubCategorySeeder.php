<?php

use Carbon\Carbon;
use App\SubCategory;
use Illuminate\Database\Seeder;

class SubCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
       SubCategory::create([
        
         'sub_category_name' => 'Clothing',
         'category_id'       => 1,
         'created_at'        => Carbon::now(),
        
       ]);
       SubCategory::create([
        
         'sub_category_name' => 'Shoes',
         'category_id'       => 1,
         'created_at'        => Carbon::now(),
        
       ]);
       SubCategory::create([
        
         'sub_category_name' => 'Eyewear',
         'category_id'       => 1,
         'created_at'        => Carbon::now(),
        
       ]);
       SubCategory::create([
        
         'sub_category_name' => 'Watches',
         'category_id'       => 1,
         'created_at'        => Carbon::now(),
        
       ]);
       SubCategory::create([
        
         'sub_category_name' => 'Womens Wear',
         'category_id'       => 12,
         'created_at'        => Carbon::now(),
        
       ]);
       SubCategory::create([
        
         'sub_category_name' => 'Womens Shoes',
         'category_id'       => 12,
         'created_at'        => Carbon::now(),
        
       ]);
       SubCategory::create([
        
         'sub_category_name' => 'Womens Eyewear',
         'category_id'       => 12,
         'created_at'        => Carbon::now(),
        
       ]);
       SubCategory::create([
        
         'sub_category_name' => 'Womens Watches',
         'category_id'       => 12,
         'created_at'        => Carbon::now(),
        
       ]);
       SubCategory::create([
        
         'sub_category_name' => 'Baby boy',
         'category_id'       => 2,
         'created_at'        => Carbon::now(),
        
       ]);
       SubCategory::create([
        
         'sub_category_name' => 'Baby girl',
         'category_id'       => 2,
         'created_at'        => Carbon::now(),
        
       ]);
       SubCategory::create([
        
         'sub_category_name' => 'Baby boy toys',
         'category_id'       => 2,
         'created_at'        => Carbon::now(),
        
       ]);
       SubCategory::create([
        
         'sub_category_name' => 'Phone',
         'category_id'       => 3,
         'created_at'        => Carbon::now(),
        
       ]);
       SubCategory::create([
        
         'sub_category_name' => 'Laptop',
         'category_id'       => 3,
         'created_at'        => Carbon::now(),
        
       ]);
       SubCategory::create([
        
         'sub_category_name' => 'Television',
         'category_id'       => 3,
         'created_at'        => Carbon::now(),
        
       ]);
       SubCategory::create([
        
         'sub_category_name' => 'Desktop',
         'category_id'       => 3,
         'created_at'        => Carbon::now(),
        
       ]);
       SubCategory::create([
        
         'sub_category_name' => 'Home Furniture',
         'category_id'       => 4,
         'created_at'        => Carbon::now(),
        
       ]);
       SubCategory::create([
        
         'sub_category_name' => 'Office Furniture',
         'category_id'       => 4,
         'created_at'        => Carbon::now(),
        
       ]);
       SubCategory::create([
        
         'sub_category_name' => 'Outdoor Furniture',
         'category_id'       => 4,
         'created_at'        => Carbon::now(),
        
       ]);
       SubCategory::create([
        
         'sub_category_name' => 'Kids Furniture',
         'category_id'       => 4,
         'created_at'        => Carbon::now(),
        
       ]);
                 
    }
}
