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
        Schema::create('employees', function (Blueprint $table) {
            $table->id();
            $table->string('name_ar')->nullable();
            $table->string('name_en')->nullable();
            $table->string('id_number')->nullable();
            $table->string('address')->nullable();
            $table->string('tel1')->nullable();
            $table->string('tel2')->nullable();
            $table->string('educational_qualification')->nullable();
            $table->string('graducation_date')->nullable();
            $table->string('employee_type')->nullable();
            $table->string('hiring_date')->nullable();
            $table->float('main_salary')->nullable();
            $table->float('insurance')->nullable();
            $table->string('insurance_date')->nullable();
            $table->string('delete_at')->default(0);

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('employees');
    }
};
