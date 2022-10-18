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
        Schema::create('employee_salaries', function (Blueprint $table) {
            $table->id();
            $table->string('date')->nullable();
            $table->unsignedBigInteger('employee_id')->nullable();
            $table->unsignedBigInteger('treasury_id')->nullable();
            $table->float('main_salary')->nullable();
            $table->string('job_type')->nullable();
            $table->float('reward')->nullable();
            $table->longText('reward_reason')->nullable();
            $table->float('absent_day')->nullable();
            $table->float('discount')->nullable();
            $table->float('total_salary')->nullable();
            $table->string('delete_at')->default(0);

            $table->timestamps();
            $table->foreign('employee_id')->references('id')->on('employees')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('treasury_id')->references('id')->on('treasuries')->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('employee_salaries');
    }
};
