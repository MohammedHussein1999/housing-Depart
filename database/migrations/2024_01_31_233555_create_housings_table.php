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
        Schema::create('housings', function (Blueprint $table) {
            $table->id();
            $table->string('empId',255)->nullable();
            $table->string('empName',255)->nullable();
            $table->string('empNumId',255)->nullable();
            $table->string('region',255)->nullable();
            $table->string('city',255)->nullable();
            $table->string('collectionId',255)->nullable();
            $table->string('buildingId',255)->nullable();
            $table->string('apartmentId',255)->nullable();
            $table->string('roomId',255)->nullable();
            $table->string('status',255)->nullable();
            $table->string('date',255)->nullable();
            $table->string('type',255)->nullable();
            $table->integer('approve')->default(1);
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
        Schema::dropIfExists('housings');
    }
};
