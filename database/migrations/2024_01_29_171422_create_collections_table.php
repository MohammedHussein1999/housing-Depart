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
        Schema::create('collections', function (Blueprint $table) {
            $table->id();

            $table->string('city', 255)->nullable();
            $table->string('region', 255)->nullable();
            $table->string('name', 255)->nullable();
            $table->string('location', 255)->nullable();
            $table->string('count', 255)->nullable();
            $table->string('file', 255)->nullable();
            $table->string('active', 255)->nullable();
            $table->string('attach', 255)->nullable();
            $table->integer('approve')->default(1);
            $table->timestamps();
        });
        Schema::enableForeignKeyConstraints();
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('collections');
    }
};
