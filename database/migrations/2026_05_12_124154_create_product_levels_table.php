<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductLevelsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('product_levels', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('course_id');
            $table->string('skill_level')->nullable();
            $table->string('skill_level_jp')->nullable();
            $table->text('purpose')->nullable();
            $table->text('purpose_jp')->nullable();
            $table->text('learn_info')->nullable();
            $table->text('learn_info_jp')->nullable();
            $table->text('outcome')->nullable();
            $table->text('outcome_jp')->nullable();
            $table->float('price')->default(0);
            $table->float('price_jp')->default(0);
            $table->float('price_hk')->default(0);
            $table->timestamps();

            $table->foreign('course_id')->references('id')->on('products')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('product_levels');
    }
}
