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
        Schema::create('outs', function (Blueprint $table) {
            $table->id();
            $table->string('empId',255)->nullable();
            $table->string('empName',255)->nullable();
            $table->string('empNumId',255)->nullable();
            $table->string('region',255)->nullable();
            $table->string('city',255)->nullable();
            $table->string('collection',255)->nullable();
            $table->string('building',255)->nullable();
            $table->string('apartmentNum',255)->nullable();
            $table->string('roomNum',255)->nullable();
            $table->string('status',255)->nullable();
            $table->string('housingDate',255)->nullable();
            $table->string('outDate',255)->nullable();
            $table->string('reason',255)->nullable();
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
        Schema::dropIfExists('outs');
    }
};
