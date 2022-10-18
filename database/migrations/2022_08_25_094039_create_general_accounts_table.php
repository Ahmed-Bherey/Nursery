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
        Schema::create('general_accounts', function (Blueprint $table) {
            $table->id();
            $table->string('date')->nullable();
            $table->unsignedBigInteger('treasury_id')->nullable();
            $table->unsignedBigInteger('generalExpensese_id')->nullable();
            $table->float('amount')->nullable();
            $table->string('delete_at')->default(0);

            $table->timestamps();
            $table->foreign('treasury_id')->references('id')->on('treasuries')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('generalExpensese_id')->references('id')->on('general_expenseses')->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('general_accounts');
    }
};
