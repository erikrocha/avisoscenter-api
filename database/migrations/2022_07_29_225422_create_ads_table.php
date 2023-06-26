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
            $table->string('latitude', 32)->nullable();
            $table->string('longitude', 32)->nullable();
            $table->char('condition', 8)->nullable();
            $table->unsignedBigInteger('type_id')->nullable();
            $table->foreign('type_id')->references('id')->on('types')->onDelete('cascade');
            $table->boolean('isIA')->default(0);
            $table->boolean('bath')->nullable();
            $table->boolean('pets')->nullable();
            $table->boolean('wifi')->nullable();
            $table->boolean('cable')->nullable();
            $table->boolean('parking_moto')->nullable();
            $table->boolean('parking_car')->nullable();
            $table->boolean('thermal')->nullable();
            $table->boolean('laundry')->nullable();
            $table->boolean('silent')->nullable();
            $table->boolean('cook')->nullable();
            $table->boolean('status')->default(1);
            $table->timestamps();
        });

        DB::table('ads')->insert([
            'body' => 'Jóvenes ayudantes para taller de melamina y (1) joven soldador para tubo delgado (salida a puno - satelite iglesia torree chayoc)',
            'latitude' => '-15.475339',
            'longitude' => '-70.125443',
            'condition' => 'free',
            'created_at' => '2022-11-01'
        ]);

        DB::table('ads')->insert([
            'body' => '(1) Terreno 1800m2 en caracoto (enace) papeles en registros públicos y documentos al día. Trato directo con los dueños y facilidades',
            'condition' => 'free',
            'created_at' => '2022-11-01'
        ]);

        DB::table('ads')->insert([
            'body' => 'Habitaciones con o sin baño privado para estudiantes o parejas solas sin hijos o mascotas jr. Miraflores (altura del terminal)',
            'address' => 'Jr. Miraflores #123',
            'price' => 300,
            'latitude' => '-15.5015139',
            'longitude' => '-70.1278192',
            'condition' => 'free',
            // 'type' => 'roombath',
            'type_id' => 2,
            'bath' => 1,
            'pets' => 1,
            'wifi' => 1,
            'parking_moto' => 1,
            'cook' => 1,
            'status' => 1,
            'created_at' => '2022-11-01'
        ]);

        DB::table('ads')->insert([
            'body' => '01 Señora o señorita para ventas en bodeguita, (por el mdo. Pedro vilcapaza) buen trato, buena paga incluye desayuno, almuerzo y cena',
            'condition' => 'free',
            'created_at' => '2022-11-01'
        ]);

        DB::table('ads')->insert([
            'body' => '[EN REMATE] 01 MAQUINA DE JUEGOS SIMULADOS DANCING “ALDAMIRO 2015”, 01 MAQUINA DE BASKETBALL.',
            'condition' => 'free',
            'isIA' => 1,
            'created_at' => '2022-11-01'
        ]);

        DB::table('ads')->insert([
            'body' => '01 COCINERA SEÑORA O SEÑORITA CON EXPERIENCIA PARA UNA FAMILIA DE 12 PERSONAS.',
            'condition' => 'free',
            'created_at' => '2022-11-02'
        ]);

        DB::table('ads')->insert([
            'body' => '02 SEÑORITAS CON EXPERIENCIA EN VENTAS Y BUENA PRESENCIA. “AVICOLA ANDREE”. ',
            'condition' => 'free',
            'isIA' => 1,
            'created_at' => '2022-11-02'
        ]);

        DB::table('ads')->insert([
            'body' => 'HABITACIONES CON O SIN BAÑO PRIVADO, PARA PAREJAS SOLAS JR. MIRAFLORES (ALTURA DEL TERMINAL).',
            'address' => 'Jr. Terminal #777',
            'latitude' => '-15.4862739',
            'longitude' => '-70.1301561',
            'condition' => 'paid',
            'type_id' => 2,
            'bath' => 1,
            'wifi' => 1,
            'cook' => 1,
            'status' => 1,
            'created_at' => '2022-11-02'
        ]);

        DB::table('ads')->insert([
            'body' => 'HABITACIONES PARA SEÑORITAS CON SERVICIOS BÁSICOS EN EL CENTRO DE LA CIUDAD, JR. TUMBES #1044.',
            'address' => 'Jr. Tumbes #1044',
            'price' => 200,
            'latitude' => '-15.485531',
            'longitude' => '-70.137020',
            'condition' => 'paid',
            'type_id' => 1,
            'status' => 1,
            'created_at' => '2022-11-02'
        ]);

        DB::table('ads')->insert([
            'body' => 'JEBES PARA MINERIA DE SEGUNDO USO PARA CONSTRUCCION DE CHUTE ',
            'condition' => 'free',
            'created_at' => '2022-11-02'
        ]);

        // 11 - casa
        DB::table('ads')->insert([
            'body' => 'CASA CON SERVICIOS BÁSICOS EN LA SALIDA A HUANCANE, TRATO DIRECTO CON LOS DUEÑOS, JR. BOLIVIA #1313.',
            'address' => 'JR. BOLIVIA #1313',
            'latitude' => '-15.487256',
            'longitude' => '-70.134653',
            'condition' => 'paid',
            'type_id' => 5,
            'bath' => '1',
            'pets' => '1',
            'parking_moto' => '1',
            'parking_car' => '1',
            'status' => 1,
            'created_at' => '2022-11-03'
        ]);

        // 12 - departamento
        DB::table('ads')->insert([
            'body' => 'DEPARTAMENTO EN LUGAR CENTRICO CON TODOS LOS SERVICIOS BASICOS, JR. CAHUIDE #555',
            'address' => 'JR. CAHUIDE #555',
            'price' => 1000,
            'latitude' => '-15.490657',
            'longitude' => '-70.131152',
            'condition' => 'free',
            'type_id' => 4,
            'bath' => '1',
            'pets' => '1',
            'wifi' => '1',
            'cable' => '1',
            'parking_moto' => '1',
            'parking_car' => '1',
            'thermal' => '1',
            'status' => 1,
            'created_at' => '2022-11-03'
        ]);

        // 13 - minidepartamento
        DB::table('ads')->insert([
            'body' => 'MINIDEPARTAMENTO EN BARRIO LOS CHOFERES CON TODOS LOS SERVICIOS BASICOS, JR. INTIHUATANA 321',
            'address' => 'JR. INTIHUATANA 321',
            'price' => 600,
            'latitude' => '-15.4849764',
            'longitude' => '-70.1387445',
            'condition' => 'free',
            'isIA' => 1,
            'type_id' => 3,
            'bath' => '1',
            'pets' => '1',
            'wifi' => '1',
            'parking_moto' => '1',
            'thermal' => '1',
            'status' => 1,
            'created_at' => '2022-11-03'
        ]);

        // 14 - local
        DB::table('ads')->insert([
            'body' => 'LOCAL COMERCIAL PARA TALLER O ALMACEN, JR. 8 DE NOVIEMBRE 858',
            'address' => 'JR. 8 DE NOVIEMBRE 858',
            'latitude' => '-15.487934',
            'longitude' => '-70.133270',
            'condition' => 'free',
            'isIA' => 1,
            'type_id' => 6,
            'status' => 1,
            'created_at' => '2022-11-03'
        ]);

        // 15 - terreno
        DB::table('ads')->insert([
            'body' => 'TERRENO AMPLIO DE 200m2 IDEAL PARA ALMACEN O TALLER, TIENE LUZ TRIFASICA',
            'address' => 'AV. PABLO NERUDA 153',
            'latitude' => '-15.502506',
            'longitude' => '-70.133162',
            'condition' => 'paid',
            'type_id' => 9,
            'status' => 1,
            'created_at' => '2022-11-03'
        ]);

        // 16 - traspaso
        // with imagen id: 7
        DB::table('ads')->insert([
            'body' => 'TRASPASO POR MOTIVOS DE SALUD (1) BOTICA CON TODOS LOS IMPLEMENTOS Y LISTO PARA TRABAJAR. JR. 8 DE NOVIEMBRE #1234',
            'address' => 'JR. 8 DE NOVIEMBRE #1234',
            'latitude' => '-15.488958396974793',
            'longitude' => '-70.13272241119374',
            'condition' => 'free',
            'status' => 1,
            'created_at' => '2022-11-04'
        ]);

        // 17 - traspaso
        DB::table('ads')->insert([
            'body' => 'TRASPASO UN INTERNET CON 10 MAQUINAS i5 LISTO PARA TRABJAR, INCLUYO LOCAL, INTERNET. JR. RAMON CASTILLA #2222',
            'address' => 'JR. RAMON CASTILLA #2222',
            'latitude' => '-15.487867610020023',
            'longitude' => '-70.13001874451633',
            'condition' => 'paid',
            'status' => 1,
            'created_at' => '2022-11-04'
        ]);

        // 18 - anticresis
        DB::table('ads')->insert([
            'body' => '(1) CASA DE DOS PISOS CON TODOS LOS SERVICIOS COMPLETOS, UBICADO AL FRENTE DEL CEMENTERIO CENTRAL PASAJE. APOLINAR ALLASI # 3333',
            'address' => 'PASAJE. APOLINAR ALLASI # 3333',
            'latitude' => '-15.497164761690517',
            'longitude' => '-70.14142492857773',
            'condition' => 'free',
            'isIA' => 1,
            'status' => 1,
            'created_at' => '2022-11-04'
        ]);

        // 19 - anticresis
        // with imagen id: 3
        DB::table('ads')->insert([
            'body' => '(1) TERRENO IDEAL PARA TALLER O ALMACEN, SALIDA A HUATA AV. MODESTO BORDA #4444',
            'address' => 'AV. MODESTO BORDA # 4444',
            'latitude' => '-15.511082420461117',
            'longitude' => '-70.10184992456288',
            'condition' => 'free',
            'status' => 1,
            'created_at' => '2022-11-04'
        ]);

        // 20 - servicios
        DB::table('ads')->insert([
            'body' => 'MANTENIMIENTO DE LAPTOPS Y PCS A DOMICILIO, SEGURO Y CONFIABLE',
            'condition' => 'free',
            'status' => 1,
            'created_at' => '2022-11-04'
        ]);

        // 21 - servicios
        DB::table('ads')->insert([
            'body' => 'MANTENIMIENTO E INSTALACION DE CONEXIONES ELECTRICAS A DOMICILIO',
            'latitude' => '-15.471143522077677',
            'longitude' => '-70.11163530088025',
            'condition' => 'paid',
            'status' => 1,
            'created_at' => '2022-11-04'
        ]);

        // 22 - otros
        DB::table('ads')->insert([
            'body' => 'OTROS 1',
            'condition' => 'free',
            'status' => 1,
            'created_at' => '2022-11-04'
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
