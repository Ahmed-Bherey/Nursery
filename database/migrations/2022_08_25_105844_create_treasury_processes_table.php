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
        Schema::create('treasury_processes', function (Blueprint $table) {
            $table->id();
            $table->string('date')->nullable();
            $table->unsignedBigInteger('treasury_id')->nullable();
            $table->unsignedBigInteger('employee_id')->nullable();
            $table->unsignedBigInteger('generalAccount_id')->nullable();
            $table->unsignedBigInteger('educationalExpense_id')->nullable();
            $table->unsignedBigInteger('child_id')->nullable();
            $table->unsignedBigInteger('buyBook_id')->nullable();
            $table->unsignedBigInteger('sellBook_id')->nullable();
            $table->unsignedBigInteger('buyUniform_id')->nullable();
            $table->unsignedBigInteger('sellUniform_id')->nullable();
            $table->float('credit')->nullable();
            $table->float('debt')->nullable();
            $table->string('comment')->nullable();

            $table->timestamps();
            $table->foreign('treasury_id')->references('id')->on('treasuries')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('employee_id')->references('id')->on('employees')->onDelete('cascade')->onUpdate('cascade');
            // $table->foreign('generalAccount_id')->references('id')->on('general_accounts')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('educationalExpense_id')->references('id')->on('educational_expenses')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('child_id')->references('id')->on('add_children')->onDelete('cascade')->onUpdate('cascade');
            // $table->foreign('buyBook_id')->references('id')->on('buy_books')->onDelete('cascade')->onUpdate('cascade');
            // $table->foreign('sellBook_id')->references('id')->on('sell_books')->onDelete('cascade')->onUpdate('cascade');
            // $table->foreign('buyUniform_id')->references('id')->on('buy_uniforms')->onDelete('cascade')->onUpdate('cascade');
            // $table->foreign('sellUniform_id')->references('id')->on('sell_uniforms')->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('treasury_processes');
    }
};
