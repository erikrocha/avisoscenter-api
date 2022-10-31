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
        Schema::create('categories', function (Blueprint $table) {
            $table->id();
            $table->string('name', 32);
            $table->timestamps();
        });

        DB::table('categories')->insert([
            'name' => 'NECESITO',
        ]);

        DB::table('categories')->insert([
            'name' => 'ALQUILO',
        ]);

        DB::table('categories')->insert([
            'name' => 'VENDO',
        ]);

        DB::table('categories')->insert([
            'name' => 'TRASPASO',
        ]);

        DB::table('categories')->insert([
            'name' => 'ANTICRESIS',
        ]);

        DB::table('categories')->insert([
            'name' => 'SERVICIOS',
        ]);

        DB::table('categories')->insert([
            'name' => 'OTROS',
        ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('categories');
    }
};
