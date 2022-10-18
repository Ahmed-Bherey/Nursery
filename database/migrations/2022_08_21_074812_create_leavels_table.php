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
        Schema::create('leavels', function (Blueprint $table) {
            $table->id();
            $table->string('name')->nullable();
            $table->integer('value')->nullable();
            $table->longText('notes')->nullable();
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
        Schema::dropIfExists('leavels');
    }
};
