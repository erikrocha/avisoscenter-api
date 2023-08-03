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
        Schema::table('ads', function (Blueprint $table) {
            // foreign fields
            $table->unsignedBigInteger('city_id')->nullable()->after('id');
            $table->foreign('city_id')->references('id')->on('cities')->onDelete('cascade');

            $table->unsignedBigInteger('brand_id')->nullable()->after('city_id');
            $table->foreign('brand_id')->references('id')->on('brands')->onDelete('cascade');

            $table->unsignedBigInteger('model_id')->nullable()->after('brand_id');
            $table->foreign('model_id')->references('id')->on('models')->onDelete('cascade');

            // columns
            $table->string('currency', 16)->nullable();
            $table->string('year', 4)->nullable();
            $table->string('mileage', 16)->nullable();
            $table->string('engine', 24)->nullable();
            $table->string('fuel', 32)->nullable();
            $table->string('transmission', 32)->nullable();
            $table->string('color', 32)->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('ads', function (Blueprint $table) {
            //
        });
    }
};
