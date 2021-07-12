<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTablePublisher extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('publisher', function (Blueprint $table) {
            $table->id();
            $table->string('publisher_name',30)->unique();
            $table->string('publisher_address')->nullable();
            $table->bigInteger('publisher_phone')->nullable();
            $table->string('publisher_email',50)->nullable()->unique();
            $table->bigInteger('publisher_fax')->nullable();
            $table->string('invalid')->default(0);
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
        Schema::dropIfExists('publisher');
    }
}
