<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddPriceInPointsToProductLevelsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('product_levels', function (Blueprint $table) {
            $table->integer('price_in_points')->nullable()->after('price_hk');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('product_levels', function (Blueprint $table) {
            $table->dropColumn('price_in_points');
        });
    }
}
