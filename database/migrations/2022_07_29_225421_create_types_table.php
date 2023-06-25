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
        Schema::create('types', function (Blueprint $table) {
            $table->id();
            $table->string('slug', 32);
            $table->string('name', 32);
            $table->boolean('status')->default(1);
            $table->timestamps();
        });

        DB::table('types')->insert([
            'slug' => 'room',
            'name' => 'Habitación'
        ]);

        DB::table('types')->insert([
            'slug' => 'roombath',
            'name' => 'Habitación con baño'
        ]);

        DB::table('types')->insert([
            'slug' => 'miniapartment',
            'name' => 'Minidepartamento'
        ]);

        DB::table('types')->insert([
            'slug' => 'department',
            'name' => 'Departamento'
        ]);

        DB::table('types')->insert([
            'slug' => 'house',
            'name' => 'Casa'
        ]);

        DB::table('types')->insert([
            'slug' => 'local',
            'name' => 'Local comercial'
        ]);

        DB::table('types')->insert([
            'slug' => 'other',
            'name' => 'Otros'
        ]);

        DB::table('types')->insert([
            'slug' => 'vehicle',
            'name' => 'Vehículo'
        ]);

        DB::table('types')->insert([
            'slug' => 'terrain',
            'name' => 'Terreno'
        ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('types');
    }
};
