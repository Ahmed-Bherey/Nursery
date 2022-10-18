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
        Schema::create('level_transfers', function (Blueprint $table) {
            $table->id();
            $table->string('date')->nullable();
            $table->unsignedBigInteger('user_id')->nullable();
            $table->unsignedBigInteger('child_id')->nullable();
            $table->unsignedBigInteger('levelFrom_id')->nullable();
            $table->unsignedBigInteger('levelTo_id')->nullable();
            $table->string('delete_at')->default(0);
            $table->timestamps();
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('child_id')->references('id')->on('add_children')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('levelFrom_id')->references('id')->on('leavels')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('levelTo_id')->references('id')->on('leavels')->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('level_transfers');
    }
};
