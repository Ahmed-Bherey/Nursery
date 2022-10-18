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
        Schema::create('child_transfers', function (Blueprint $table) {
            $table->id();
            $table->string('date')->nullable();
            $table->unsignedBigInteger('level_id')->nullable();
            $table->unsignedBigInteger('classroomFrom_id')->nullable();
            $table->unsignedBigInteger('classroomTo_id')->nullable();
            $table->unsignedBigInteger('addChild_id')->nullable();
            $table->string('delete_at')->default(0);
            $table->timestamps();
            $table->foreign('classroomFrom_id')->references('id')->on('classrooms')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('classroomTo_id')->references('id')->on('classrooms')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('addChild_id')->references('id')->on('add_children')->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('child_transfers');
    }
};
