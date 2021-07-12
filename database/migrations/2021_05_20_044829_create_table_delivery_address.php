<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTableDeliveryAddress extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('delivery_address', function (Blueprint $table) {
            $table->id();
            $table->integer('user_id');
            $table->string('address');
            $table->string('city',50)->nullable();
            $table->string('province',50)->nullable();
            $table->integer('phone_delivery');
            $table->tinyInteger('is_primary')->default(0)->comment('1: địa chỉ chính, 0: địa chỉ phụ');
            $table->tinyInteger('invalid')->default(0);
            $table->timestamps();

            $table->index('user_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('delivery_address');
    }
}
