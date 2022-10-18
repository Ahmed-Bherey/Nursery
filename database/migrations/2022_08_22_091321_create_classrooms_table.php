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
        Schema::create('classrooms', function (Blueprint $table) {
            $table->id();
            $table->string('name')->nullable();
            $table->string('level_id')->nullable();
            $table->integer('student_count')->nullable();
            $table->longText('notes')->nullable();
            $table->integer('active')->nullable();
            $table->string('delete_at')->default(0);
            $table->timestamps();
            // $table->foreign('level_id')->references('id')->on('leavels')->onDelete('cascade')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('classrooms');
    }
};
