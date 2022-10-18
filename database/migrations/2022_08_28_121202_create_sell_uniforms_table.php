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
        Schema::create('sell_uniforms', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('year_id')->nullable();
            $table->unsignedBigInteger('sellUniformTotal_id')->nullable();
            $table->unsignedBigInteger('buyUniform_id')->nullable();
            $table->float('quantity')->nullable();
            $table->float('price')->nullable();
            $table->float('subTotal')->nullable();
            $table->string('delete_at')->default(0);
            $table->unsignedBigInteger('treasury_id')->nullable();

            $table->timestamps();
            // $table->foreign('sellUniformTotal_id')->references('id')->on('sell_uniform_totals')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('year_id')->references('id')->on('educational_years')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('buyUniform_id')->references('id')->on('buy_uniforms')->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('sell_uniforms');
    }
};
