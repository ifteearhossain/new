<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->integer('user_id');
            $table->string('billing_fullname');
            $table->string('billing_email');
            $table->integer('country_id');
            $table->integer('state_id');
            $table->integer('city_id')->nullable();
            $table->integer('areacode');
            $table->integer('phone_number');
            $table->longText('address');
            $table->integer('billing_zipcode');

            $table->string('shipping_fullname')->nullable();
            $table->string('shipping_email')->nullable();
            $table->string('shipping_country')->nullable();
            $table->integer('shipping_phone_number')->nullable();
            $table->longText('shipping_address')->nullable();
            $table->integer('shipping_zipcode')->nullable();
            $table->longText('notes')->nullable();

            $table->integer('sub_total');
            $table->string('coupon_name')->nullable();
            $table->integer('total');

            $table->integer('payment_method')->default(1);
            $table->integer('payment_status')->default(1);
            $table->integer('delivery_status')->default(0);
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
        Schema::dropIfExists('orders');
    }
}
