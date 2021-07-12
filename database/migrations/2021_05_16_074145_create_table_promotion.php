<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTablePromotion extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('promotion', function (Blueprint $table) {
            $table->id();
            $table->string('promotion_name')->unique();
            $table->string('promotion_code','30')->unique();
            $table->integer('promotion_discount');
            $table->datetime('start_date');
            $table->datetime('end_date');
            $table->tinyInteger('invalid')->default(0);
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
        Schema::dropIfExists('promotion');
    }
}
