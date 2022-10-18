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
        Schema::create('educational_expenses_collections', function (Blueprint $table) {
            $table->id();
            $table->string('date')->nullable();
            $table->unsignedBigInteger('level_id')->nullable();
            $table->unsignedBigInteger('treasury_id')->nullable();
            $table->unsignedBigInteger('child_id')->nullable();
            $table->string('expenses_id')->nullable();
            $table->float('total_paid')->nullable();
            $table->float('rest')->nullable();
            $table->longText('notes')->nullable();
            $table->string('delete_at')->default(0);

            $table->timestamps();
            $table->foreign('treasury_id')->references('id')->on('treasuries')->onDelete('cascade')->onUpdate('cascade');
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
        Schema::dropIfExists('educational_expenses_collections');
    }
};
