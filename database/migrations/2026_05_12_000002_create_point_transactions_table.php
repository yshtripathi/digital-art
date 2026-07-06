<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePointTransactionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('point_transactions', function (Blueprint $blueprint) {
            $blueprint->id();
            $blueprint->unsignedInteger('user_id');
            $blueprint->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $blueprint->integer('amount'); // Positive for credit, negative for debit
            $blueprint->string('type'); // 'credit', 'debit'
            $blueprint->string('description')->nullable();
            $blueprint->string('reference_id')->nullable(); // Order ID or Course ID
            $blueprint->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('point_transactions');
    }
}
