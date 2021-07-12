<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddFieldsTableProduct extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('product', function (Blueprint $table) {
            $table->string('product_weight',30)->after('slug')->nullable();
            $table->string('product_dimensions',30)->after('slug')->nullable();
            $table->integer('product_pages')->after('slug')->nullable();
            $table->string('product_language',30)->after('slug')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('product', function (Blueprint $table) {
            $table->dropColumn('product_weight');
            $table->dropColumn('product_dimensions');
            $table->dropColumn('product_pages');
            $table->dropColumn('product_language');
        });
    }
}
