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
        Schema::create('ads', function (Blueprint $table) {
            $table->id();
            $table->text('body');
            $table->string('latitude', 16)->nullable();
            $table->string('longitude', 16)->nullable();
            $table->timestamps();
        });

        DB::table('ads')->insert([
            'body' => 'JÓVENES AYUDANTES PARA TALLER DE MELAMINA Y (1) JOVEN SOLDADOR PARA TUBO DELGADO (SALIDA...',
        ]);

        DB::table('ads')->insert([
            'body' => '(1) TERRENO 1800M2 EN CARACOTO (ENACE) PAPELES EN REGISTROS PÚBLICOS Y DOCUMENTOS AL DÍA ...',
        ]);

        DB::table('ads')->insert([
            'body' => 'HABITACIONES CON O SIN BAÑO PARA PAREJAS SOLAS JR. MIRAFLORES (ALTURA DEL TERMINAL) ...',
        ]);

        DB::table('ads')->insert([
            'body' => '01 SEÑORA O SEÑORITA PARA VENTAS EN BODEGUITA, (POR EL MDO. PEDRO VILCAPAZA)',
        ]);

        DB::table('ads')->insert([
            'body' => '[EN REMATE] 01 MAQUINA DE JUEGOS SIMULADOS DANCING “ALDAMIRO 2015”, 01 MAQUINA DE BASKETBALL.',
        ]);

        DB::table('ads')->insert([
            'body' => '01 COCINERA SEÑORA O SEÑORITA CON EXPERIENCIA PARA UNA FAMILIA DE 12 PERSONAS.',
        ]);

        DB::table('ads')->insert([
            'body' => '02 SEÑORITAS CON EXPERIENCIA EN VENTAS Y BUENA PRESENCIA. “AVICOLA ANDREE”. ',
        ]);

        DB::table('ads')->insert([
            'body' => 'HABITACIONES CON O SIN BAÑO, PARA PAREJAS SOLAS JR. MIRAFLORES (ALTURA DEL TERMINAL).',
        ]);

        DB::table('ads')->insert([
            'body' => 'HABITACIONES PARA SEÑORITAS CON SERVICIOS BÁSICOS EN EL CENTRO DE LA CIUDAD, JR. TUMBES #1044.',
        ]);

        DB::table('ads')->insert([
            'body' => 'JEBES PARA MINERIA DE SEGUNDO USO PARA CONSTRUCCION DE CHUTE ',
        ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('ads');
    }
};
