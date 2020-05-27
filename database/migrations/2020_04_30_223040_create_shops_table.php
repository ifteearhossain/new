<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateShopsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('shops', function (Blueprint $table) {
            $table->id();
            $table->string('shop_name');
            $table->longText('shop_short_description');
            $table->longText('shop_long_description')->nullable();
            $table->longText('shop_address');
            $table->integer('areacode');
            $table->string('shop_phone_number');
            $table->string('shop_logo');
            $table->string('shop_cover_image');
            $table->string('shop_registration_number');
            $table->string('shop_license');
            $table->string('bank_name');
            $table->string('bank_account_number');
            $table->string('paypal_account_number')->nullable();
            $table->integer('user_id');
            $table->string('is_active')->default('pending');
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
        Schema::dropIfExists('shops');
    }
}
