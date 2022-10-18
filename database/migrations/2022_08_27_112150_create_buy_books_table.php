<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('buy_books', function (Blueprint $table) {
            $table->id();
            $table->string('date')->nullable();
            $table->string('supplier')->nullable();
            $table->string('note')->nullable();
            $table->string('totalBuyPrice')->nullable();
            $table->string('totalSellPrice')->nullable();
            $table->unsignedBigInteger('treasury_id')->nullable();
            $table->unsignedBigInteger('year_id')->nullable();
            $table->string('delete_at')->default(0);

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
        Schema::dropIfExists('buy_books');
    }
};
