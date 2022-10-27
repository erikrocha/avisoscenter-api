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
            $table->string('address', 64)->nullable();
            $table->decimal('price', 8,2)->nullable();
            $table->string('latitude', 16)->nullable();
            $table->string('longitude', 16)->nullable();
            $table->char('condition', 8)->default('ia');
            $table->char('type', 16)->nullable();
            $table->char('bath', 1)->nullable();
            $table->char('pets', 1)->nullable();
            $table->char('wifi', 1)->nullable();
            $table->char('cable', 1)->nullable();
            $table->char('parking_moto', 1)->nullable();
            $table->char('parking_car', 1)->nullable();
            $table->char('thermal', 1)->nullable();
            $table->char('status', 1)->default('1');
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
            'address' => 'Jr. Miraflores #123',
            'price' => 300,
            'latitude' => '-15.5015139',
            'longitude' => '-70.1278192',
            'condition' => 'free',
            'type' => 'roombath',
            'bath' => '1',
            'pets' => '1',
            'wifi' => '1',
            'parking_moto' => '1',
            'status' => 1,
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
            'body' => 'HABITACIONES CON O SIN BAÑO PRIVADO, PARA PAREJAS SOLAS JR. MIRAFLORES (ALTURA DEL TERMINAL).',
            'address' => 'Jr. Terminal #777',
            'latitude' => '-15.4862739',
            'longitude' => '-70.1301561',
            'condition' => 'paid',
            'type' => 'roombath',
            'bath' => '1',
            'wifi' => '1',
            'status' => 1,
            'created_at' => now()
        ]);

        DB::table('ads')->insert([
            'body' => 'HABITACIONES PARA SEÑORITAS CON SERVICIOS BÁSICOS EN EL CENTRO DE LA CIUDAD, JR. TUMBES #1044.',
            'address' => 'Jr. Tumbes #1044',
            'price' => 200,
            'latitude' => '-15.485531',
            'longitude' => '-70.137020',
            'condition' => 'paid',
            'type' => 'room',
            'status' => 1,
            'created_at' => now()
        ]);

        DB::table('ads')->insert([
            'body' => 'JEBES PARA MINERIA DE SEGUNDO USO PARA CONSTRUCCION DE CHUTE ',
            'created_at' => now()
        ]);

        // 11 - casa
        DB::table('ads')->insert([
            'body' => 'CASA CON SERVICIOS BÁSICOS EN LA SALIDA A HUANCANE, TRATO DIRECTO CON LOS DUEÑOS, JR. BOLIVIA #1313.',
            'address' => 'JR. BOLIVIA #1313',
            'latitude' => '-15.487256',
            'longitude' => '-70.134653',
            'condition' => 'paid',
            'type' => 'house',
            'bath' => '1',
            'pets' => '1',
            'parking_moto' => '1',
            'parking_car' => '1',
            'status' => 1,
            'created_at' => now()
        ]);

        // 12 - departamento
        DB::table('ads')->insert([
            'body' => 'DEPARTAMENTO EN LUGAR CENTRICO CON TODOS LOS SERVICIOS BASICOS, JR. CAHUIDE #555',
            'address' => 'JR. CAHUIDE #555',
            'price' => 1000,
            'latitude' => '-15.490657',
            'longitude' => '-70.131152',
            'condition' => 'free',
            'type' => 'departament',
            'bath' => '1',
            'pets' => '1',
            'wifi' => '1',
            'cable' => '1',
            'parking_moto' => '1',
            'parking_car' => '1',
            'thermal' => '1',
            'status' => 1,
            'created_at' => now()
        ]);

        // 13 - minidepartamento
        DB::table('ads')->insert([
            'body' => 'MINIDEPARTAMENTO EN BARRIO LOS CHOFERES CON TODOS LOS SERVICIOS BASICOS, JR. INTIHUATANA 321',
            'address' => 'JR. INTIHUATANA 321',
            'price' => 600,
            'latitude' => '-15.4849764',
            'longitude' => '-70.1387445',
            'condition' => 'ia',
            'type' => 'minidepartament',
            'bath' => '1',
            'pets' => '1',
            'wifi' => '1',
            'parking_moto' => '1',
            'thermal' => '1',
            'status' => 1,
            'created_at' => now()
        ]);

        // 14 - local
        DB::table('ads')->insert([
            'body' => 'LOCAL COMERCIAL PARA TALLER O ALMACEN, JR. 8 DE NOVIEMBRE 858',
            'address' => 'JR. 8 DE NOVIEMBRE 858',
            'latitude' => '-15.487934',
            'longitude' => '-70.133270',
            'condition' => 'ia',
            'type' => 'local',
            'status' => 1,
            'created_at' => now()
        ]);

        // 15 - terreno
        DB::table('ads')->insert([
            'body' => 'TERRENO AMPLIO DE 200m2 IDEAL PARA ALMACEN O TALLER, TIENE LUZ TRIFASICA',
            'address' => 'AV. PABLO NERUDA 153',
            'latitude' => '-15.502506',
            'longitude' => '-70.133162',
            'condition' => 'paid',
            'type' => 'other',
            'status' => 1,
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
