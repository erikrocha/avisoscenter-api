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
            'body' => 'Jóvenes ayudantes para taller de melamina y (1) joven soldador para tubo delgado (salida a puno - satelite iglesia torree chayoc)',
            'latitude' => '-15.475339',
            'longitude' => '-70.125443',
            'created_at' => now()
        ]);

        DB::table('ads')->insert([
            'body' => '(1) Terreno 1800m2 en caracoto (enace) papeles en registros públicos y documentos al día. Trato directo con los dueños y facilidades',
            'created_at' => now()
        ]);

        DB::table('ads')->insert([
            'body' => 'Habitaciones con o sin baño privado para estudiantes o parejas solas sin hijos o mascotas jr. Miraflores (altura del terminal)',
            'latitude' => '-15.5015139',
            'longitude' => '-70.1278192',
            'created_at' => now()
        ]);

        DB::table('ads')->insert([
            'body' => '01 Señora o señorita para ventas en bodeguita, (por el mdo. Pedro vilcapaza) buen trato, buena paga incluye desayuno, almuerzo y cena',
            'created_at' => now()
        ]);

        DB::table('ads')->insert([
            'body' => '[EN REMATE] 01 MAQUINA DE JUEGOS SIMULADOS DANCING “ALDAMIRO 2015”, 01 MAQUINA DE BASKETBALL.',
            'created_at' => now()
        ]);

        DB::table('ads')->insert([
            'body' => '01 COCINERA SEÑORA O SEÑORITA CON EXPERIENCIA PARA UNA FAMILIA DE 12 PERSONAS.',
            'created_at' => now()
        ]);

        DB::table('ads')->insert([
            'body' => '02 SEÑORITAS CON EXPERIENCIA EN VENTAS Y BUENA PRESENCIA. “AVICOLA ANDREE”. ',
            'created_at' => now()
        ]);

        DB::table('ads')->insert([
            'body' => 'HABITACIONES CON O SIN BAÑO, PARA PAREJAS SOLAS JR. MIRAFLORES (ALTURA DEL TERMINAL).',
            'latitude' => '-15.4862739',
            'longitude' => '-70.1301561',
            'created_at' => now()
        ]);

        DB::table('ads')->insert([
            'body' => 'HABITACIONES PARA SEÑORITAS CON SERVICIOS BÁSICOS EN EL CENTRO DE LA CIUDAD, JR. TUMBES #1044.',
            'latitude' => '-15.485531',
            'longitude' => '-70.137020',
            'created_at' => now()
        ]);

        DB::table('ads')->insert([
            'body' => 'JEBES PARA MINERIA DE SEGUNDO USO PARA CONSTRUCCION DE CHUTE ',
            'created_at' => now()
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
