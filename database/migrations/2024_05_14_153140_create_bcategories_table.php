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
        Schema::create('bcategories', function (Blueprint $table) {
            $table->id();
            $table->string('name', 16);
            $table->boolean('status')->default(1);
        });

        DB::table('bcategories')->insert([
            'name' => 'GAS',
        ]);

        DB::table('bcategories')->insert([
            'name' => 'FERRETERIA',
        ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('b_categories');
    }
};
