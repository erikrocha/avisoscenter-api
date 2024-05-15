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
        Schema::create('businesses', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('bcategory_id');
            $table->foreign('bcategory_id')->references('id')->on('bcategories')->onDelete('cascade');
            $table->string('name', 128);
            $table->text('description');
            $table->string('address', 128)->nullable();
            $table->string('image', 256)->nullable();
            $table->string('web', 64)->nullable();
            $table->string('email', 64)->nullable();
            $table->string('phone', 16)->nullable();
            $table->string('whatsapp', 16)->nullable();
            $table->string('facebook', 64)->nullable();
            $table->string('tiktok', 64)->nullable();
            $table->boolean('status')->default(1);
            $table->timestamps();
        });

        DB::table('businesses')->insert([
            'bcategory_id' => 1,
            'name' => 'BEEP GAS distribuidor de gas',
            'description' => '¡Entrega de gas a tu puerta! Calidad y confianza en cada entrega.',
            'image' => 'https://avisoscenter.nyc3.cdn.digitaloceanspaces.com/businesses/logos/beepgas.jpg',
        ]);

        DB::table('businesses')->insert([
            'bcategory_id' => 2,
            'name' => 'IRWIN DISTRIBUCIONES ',
            'description' => 'Máquinas, herramientas, automotriz y ferretería en general precios por mayor.',
            'image' => 'https://avisoscenter.nyc3.cdn.digitaloceanspaces.com/businesses/logos/irwindistribuciones.jpg',
        ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('businesses');
    }
};
