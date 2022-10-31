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
        Schema::create('ad_images', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('ad_id');
            $table->unsignedBigInteger('image_id');
            $table->foreign('ad_id')->references('id')->on('ads')->onDelete('cascade');
            $table->foreign('image_id')->references('id')->on('images')->onDelete('cascade');
            $table->timestamps();
        });

        DB::table('ad_images')->insert([
            'ad_id' => 3,
            'image_id' => 1
        ]);
        
        DB::table('ad_images')->insert([
            'ad_id' => 3,
            'image_id' => 2
        ]);

        DB::table('ad_images')->insert([
            'ad_id' => 3,
            'image_id' => 3
        ]);

        DB::table('ad_images')->insert([
            'ad_id' => 9,
            'image_id' => 7
        ]);

        DB::table('ad_images')->insert([
            'ad_id' => 19,
            'image_id' => 3
        ]);

        DB::table('ad_images')->insert([
            'ad_id' => 16,
            'image_id' => 7
        ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('ad_images');
    }
};
