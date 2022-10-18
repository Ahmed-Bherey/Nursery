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
        Schema::create('buy_book_totals', function (Blueprint $table) {
            $table->id();
            $table->string('name')->nullable();
            $table->string('amount')->nullable();
            $table->float('buyPrice')->nullable();
            $table->string('sellPrice')->nullable();
            $table->float('subTotal')->nullable();

            $table->unsignedBigInteger('buyBook_id')->nullable();
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
        Schema::dropIfExists('buy_book_totals');
    }
};
