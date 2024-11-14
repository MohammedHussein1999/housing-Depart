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
        Schema::create('mistakes', function (Blueprint $table) {
            $table->id();
            $table->string('empId',255)->nullable();
            $table->string('empName',255)->nullable();
            $table->string('empNumId',255)->nullable();
            $table->string('mistakeDescription',255)->nullable();
            $table->string('date',255)->nullable();
            $table->string('status',255)->nullable();
            $table->string('description',255)->nullable();
            $table->string('file',255)->nullable();
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
        Schema::dropIfExists('mistakes');
    }
};
