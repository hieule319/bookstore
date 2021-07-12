<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddFieldsTableUser extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('user', function (Blueprint $table) {
            $table->string('provider')->nullable()->after('avatar_original');
            $table->string('provider_id')->nullable()->after('provider');
            $table->string('fullname',50)->nullable()->after('provider_id');
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
            $table->dropColumn('provider');
            $table->dropColumn('provider_id');
            $table->dropColumn('fullname');
        });
    }
}
