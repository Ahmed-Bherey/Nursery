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
        Schema::create('educational_expenses', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('level_id')->nullable();
            $table->string('name')->nullable();
            $table->longText('notes')->nullable();
            $table->integer('active')->nullable();
            $table->unsignedBigInteger('educationalYear_id')->nullable();
            $table->float('amount')->nullable();
            $table->string('delete_at')->default(0);
            $table->timestamps();
            $table->foreign('educationalYear_id')->references('id')->on('educational_years')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('level_id')->references('id')->on('leavels')->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('educational_expenses');
    }
};
