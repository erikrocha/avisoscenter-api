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
        Schema::create('bads', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('business_id');
            $table->foreign('business_id')->references('id')->on('businesses')->onDelete('cascade');
            $table->string('image', 256);
            $table->boolean('status')->default(1);
            $table->timestamp('expired_at')->nullable();
            $table->timestamps();
        });

        DB::table('bads')->insert([
            'business_id' => 1,
            'image' => 'https://avisoscenter.nyc3.cdn.digitaloceanspaces.com/businesses/ads/beepgas.jpg'
        ]);

        DB::table('bads')->insert([
            'business_id' => 2,
            'image' => 'https://avisoscenter.nyc3.cdn.digitaloceanspaces.com/businesses/ads/irwindistribuciones.jpg'
        ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('b_ads');
    }
};
