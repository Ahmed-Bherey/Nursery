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
        Schema::create('sell_uniform_totals', function (Blueprint $table) {
            $table->id();
            $table->string('date')->nullable();
            $table->unsignedBigInteger('year_id')->nullable();
            $table->unsignedBigInteger('level_id')->nullable();
            $table->unsignedBigInteger('child_id')->nullable();
            $table->longText('notes')->nullable();
            $table->float('total')->nullable();
            $table->string('delete_at')->default(0);
            $table->unsignedBigInteger('treasury_id')->nullable();
            $table->timestamps();
            $table->foreign('year_id')->references('id')->on('educational_years')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('level_id')->references('id')->on('leavels')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('child_id')->references('id')->on('add_children')->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('sell_uniform_totals');
    }
};
