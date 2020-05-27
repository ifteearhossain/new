<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('product_name');
            $table->integer('product_price');
            $table->integer('discount_price')->nullable();
            $table->string('product_brand')->nullable();
            $table->integer('category_id');
            $table->integer('sub_category_id');
            $table->integer('product_quantity');
            $table->integer('shop_id')->nullable();
            $table->longText('product_short_description');
            $table->longText('product_long_description');
            $table->string('product_thumbnail_image');
            $table->string('product_slug');
            $table->integer('user_id');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('products');
    }
}
