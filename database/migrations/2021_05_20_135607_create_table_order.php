<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTableOrder extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('order', function (Blueprint $table) {
            $table->id();
            $table->string('order_code');
            $table->integer('user_id');
            $table->bigInteger('total');
            $table->tinyInteger('status')->default(0)->comment('0: đang xử lý, 1: xử lý, 2:giao cho bộ phân GH, 3:Giao hàng, 4: Nhận hàng và thanh toán');
            $table->string('payment')->nullable()->comment('Hình thức than toán');
            $table->integer('deliveryId');
            $table->tinyInteger('invalid')->default(0);
            $table->timestamps();

            $table->index('user_id');
            $table->index('deliveryId');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('order');
    }
}
