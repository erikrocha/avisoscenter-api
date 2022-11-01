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
        Schema::create('phones', function (Blueprint $table) {
            $table->id();
            // $table->string('number', 16);
            $table->integer('number');
            $table->timestamps();
        });

        DB::table('phones')->insert([
            'number' => 111111111
        ]);

        DB::table('phones')->insert([
            'number' => 222222222
        ]);

        DB::table('phones')->insert([
            'number' => 333333333
        ]);

        DB::table('phones')->insert([
            'number' => 444444444
        ]);

        DB::table('phones')->insert([
            'number' => 555555555
        ]);

        DB::table('phones')->insert([
            'number' => 666666666
        ]);

        DB::table('phones')->insert([
            'number' => 777777777
        ]);

        DB::table('phones')->insert([
            'number' => 888888888
        ]);

        DB::table('phones')->insert([
            'number' => 999999999
        ]);

        DB::table('phones')->insert([
            'number' => 100101010
        ]);

        DB::table('phones')->insert([
            'number' => 111000000
        ]);

        DB::table('phones')->insert([
            'number' => 112000000
        ]);

        DB::table('phones')->insert([
            'number' => 113000000
        ]);

        DB::table('phones')->insert([
            'number' => 114000000
        ]);

        DB::table('phones')->insert([
            'number' => 115000000
        ]);

        DB::table('phones')->insert([
            'number' => 116000000
        ]);

        DB::table('phones')->insert([
            'number' => 117000000
        ]);

        DB::table('phones')->insert([
            'number' => 118000000
        ]);

        DB::table('phones')->insert([
            'number' => 119000000
        ]);

        DB::table('phones')->insert([
            'number' => 220000000
        ]);

        DB::table('phones')->insert([
            'number' => 221000021
        ]);

        DB::table('phones')->insert([
            'number' => 222000022
        ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('phones');
    }
};
