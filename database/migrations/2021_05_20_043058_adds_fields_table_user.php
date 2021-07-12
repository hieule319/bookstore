<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddsFieldsTableUser extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('user', function (Blueprint $table) {
            $table->string('country')->nullable()->after('fullname');
            $table->date('birthday')->nullable()->after('country');
            $table->integer('phone')->nullable()->after('birthday');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('user', function (Blueprint $table) {
            $table->dropColumn('country');
            $table->dropColumn('birthday');
            $table->dropColumn('phone');
        });
    }
}
