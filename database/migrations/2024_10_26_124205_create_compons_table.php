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
        Schema::create('compons', function (Blueprint $table) {
            $table->id();
            $table->foreignId("city_id")->constrained('cities')->onDelete('cascade')->onUpdate('cascade');
            $table->string("nameRegion");
            $table->string("nameCity");
            $table->string("nameComplex");
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
        Schema::dropIfExists('compons');
    }
};
