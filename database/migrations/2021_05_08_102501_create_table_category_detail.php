<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTableCategoryDetail extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('category_detail', function (Blueprint $table) {
            $table->id();
            $table->string('category_detail_name', 50)->unique();
            $table->integer('category_id');
            $table->tinyInteger('invalid')->default(0);
            $table->timestamps();

            $table->index('category_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('category_detail');
    }
}
