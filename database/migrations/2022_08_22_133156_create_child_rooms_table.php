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
        Schema::create('child_rooms', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('level_id')->nullable();
            $table->unsignedBigInteger('classRoom_id')->nullable();
            $table->unsignedBigInteger('addChlid_id')->nullable();
            $table->string('delete_at')->default(0);

            $table->timestamps();
            $table->foreign('classRoom_id')->references('id')->on('classrooms')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('addChlid_id')->references('id')->on('add_children')->onDelete('cascade')->onUpdate('cascade');
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
        Schema::dropIfExists('child_rooms');
    }
};
