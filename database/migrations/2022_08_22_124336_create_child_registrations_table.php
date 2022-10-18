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
        Schema::create('child_registrations', function (Blueprint $table) {
            $table->id();
            $table->string('registration_date')->nullable();
            $table->unsignedBigInteger('child_id')->nullable();
            $table->string('acceptance_date')->nullable();
            $table->string('born_date')->nullable();
            $table->string('gender')->nullable();
            $table->string('city')->nullable();
            $table->float('age')->nullable();
            $table->integer('level_id')->nullable();
            $table->string('delete_at')->default(0);
            $table->timestamps();
            $table->foreign('child_id')->references('id')->on('add_children')->onDelete('cascade')->onUpdate('cascade');
            // $table->foreign('leavel_id')->references('id')->on('leavels')->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('child_registrations');
    }
};
