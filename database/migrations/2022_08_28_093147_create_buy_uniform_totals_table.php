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
        Schema::create('buy_uniform_totals', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('year_id')->nullable();
            $table->string('date')->nullable();
            $table->string('supplier')->nullable();
            $table->longText('notes')->nullable();
            $table->float('total_buy')->nullable();
            $table->float('total_sale')->nullable();
            $table->string('delete_at')->default(0);
            $table->unsignedBigInteger('treasury_id')->nullable();

            $table->timestamps();
            $table->foreign('year_id')->references('id')->on('educational_years')->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('buy_uniform_totals');
    }
};
