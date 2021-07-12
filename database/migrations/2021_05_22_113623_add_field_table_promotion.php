<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddFieldTablePromotion extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('promotion', function (Blueprint $table) {
            $table->integer('condition')->default(0)->after('promotion_discount')->comment('Điều kiện để được hưởng voucher : số đơn hàng');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('promotion', function (Blueprint $table) {
            $table->dropColumn('condition');
        });
    }
}
