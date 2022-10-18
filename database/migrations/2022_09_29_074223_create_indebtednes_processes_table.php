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
        Schema::create('indebtednes_processes', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id')->nullable();
            $table->unsignedBigInteger('year_id')->nullable();
            $table->unsignedBigInteger('level_id')->nullable();
            $table->unsignedBigInteger('child_id')->nullable();
            $table->unsignedBigInteger('educationalExpense_id')->nullable();
            $table->float('credit')->nullable();
            $table->float('debt')->nullable();
            $table->timestamps();
            // $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade')->onUpdate('cascade');
            // $table->foreign('year_id')->references('id')->on('educational_years')->onDelete('cascade')->onUpdate('cascade');
            // $table->foreign('student_id')->references('id')->on('students')->onDelete('cascade')->onUpdate('cascade');
            // $table->foreign('educationalExpense_id')->references('id')->on('educational_expenses')->onDelete('cascade')->onUpdate('cascade');
            // $table->foreign('level_id')->references('id')->on('levels')->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('indebtednes_processes');
    }
};
