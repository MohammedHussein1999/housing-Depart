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
        Schema::disableForeignKeyConstraints();

        Schema::create('cities_regions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('region_id')->nullable()->constrained("regions", "id")->onUpdate('cascade')->onDelete('cascade');
            $table->foreignId('city_id')->nullable()->constrained("cities", "id")->onUpdate('cascade')->onDelete('cascade');
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
        Schema::dropIfExists('cities_regions');
    }
};
