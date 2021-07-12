<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTableInventory extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('inventory', function (Blueprint $table) {
            $table->id();
            $table->string('product_name');
            $table->string('product_qrcode');
            $table->integer('product_price');
            $table->integer('product_quantity');
            $table->bigInteger('total_price');
            $table->tinyInteger('invalid');
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
        Schema::dropIfExists('inventory');
    }
}
