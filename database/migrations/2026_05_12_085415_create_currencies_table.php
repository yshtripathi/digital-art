<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

class CreateCurrenciesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('currencies', function (Blueprint $table) {
            $table->id();
            $table->integer('website_id')->nullable();
            $table->string('name');
            $table->string('code')->unique();
            $table->string('symbol')->nullable();
            $table->decimal('exchange_rate', 10, 2)->default(1.00);
            $table->boolean('is_default')->default(0);
            $table->timestamps();
        });

        // Seed basic currencies
        DB::table('currencies')->insert([
            ['name' => 'US Dollar', 'code' => 'USD', 'symbol' => '$', 'exchange_rate' => 1.00, 'is_default' => 1],
            ['name' => 'Japanese Yen', 'code' => 'JPY', 'symbol' => '¥', 'exchange_rate' => 110.00, 'is_default' => 0],
            ['name' => 'Hong Kong Dollar', 'code' => 'HKD', 'symbol' => 'HK$', 'exchange_rate' => 7.80, 'is_default' => 0],
        ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('currencies');
    }
}
