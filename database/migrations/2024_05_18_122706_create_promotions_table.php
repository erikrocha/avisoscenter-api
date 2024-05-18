<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Carbon\Carbon;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('promotions', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('business_id');
            $table->foreign('business_id')->references('id')->on('businesses')->onDelete('cascade');
            $table->string('name', 128)->nullable();
            $table->text('description')->nullable();
            $table->string('image', 256)->nullable();
            $table->boolean('status')->default(1);
            $table->timestamp('expired_at')->nullable();
            $table->timestamps();
        });

        DB::table('promotions')->insert([
            'business_id' => 1,
            'name' => '1 Recarga gratis por 10 tickets',
            'description' => 'En cada compra te damos 1 ticket, junta 10 y reclama una recarga gratis!',
            'image' => 'https://avisoscenter.nyc3.cdn.digitaloceanspaces.com/businesses/ads/beepgas.jpg',
            'created_at' => Carbon::now(),
        ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('promotions');
    }
};
