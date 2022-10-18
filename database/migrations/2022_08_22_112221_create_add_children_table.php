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
        Schema::create('add_children', function (Blueprint $table) {
            $table->id();
            $table->string('name_ar')->nullable();
            $table->string('name_en')->nullable();
            $table->string('id_number')->nullable();
            $table->string('address')->nullable();
            $table->string('father_name')->nullable();
            $table->string('father_tel')->nullable();
            $table->string('mother_name')->nullable();
            $table->string('mother_tel')->nullable();
            $table->string('another_tel')->nullable();

            $table->string('fatherJob')->nullable();
            $table->string('motherJob')->nullable();
            $table->string('img')->nullable();
            $table->integer('religion')->nullable();
            $table->integer('active')->nullable();
            $table->string('delete_at')->default(0);
            $table->string('year_id')->nullable();

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
        Schema::dropIfExists('add_children');
    }
};
