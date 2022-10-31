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
            $table->string('number', 16);
            $table->timestamps();
        });

        DB::table('phones')->insert([
            'number' => '111 111111',
        ]);

        DB::table('phones')->insert([
            'number' => '222 222222',
        ]);

        DB::table('phones')->insert([
            'number' => '333 333333',
        ]);

        DB::table('phones')->insert([
            'number' => '444444444',
        ]);

        DB::table('phones')->insert([
            'number' => '555555555',
        ]);

        DB::table('phones')->insert([
            'number' => '666666666',
        ]);

        DB::table('phones')->insert([
            'number' => '777777777',
        ]);

        DB::table('phones')->insert([
            'number' => '888888888',
        ]);

        DB::table('phones')->insert([
            'number' => '999999999',
        ]);

        DB::table('phones')->insert([
            'number' => '010000010',
        ]);

        DB::table('phones')->insert([
            'number' => '011000000',
        ]);

        DB::table('phones')->insert([
            'number' => '012000000',
        ]);

        DB::table('phones')->insert([
            'number' => '013000000',
        ]);

        DB::table('phones')->insert([
            'number' => '014000000',
        ]);

        DB::table('phones')->insert([
            'number' => '015000000',
        ]);

        DB::table('phones')->insert([
            'number' => '016000000',
        ]);

        DB::table('phones')->insert([
            'number' => '017 000000',
        ]);

        DB::table('phones')->insert([
            'number' => '018 000000',
        ]);

        DB::table('phones')->insert([
            'number' => '019 000000',
        ]);

        DB::table('phones')->insert([
            'number' => '020 000000',
        ]);

        DB::table('phones')->insert([
            'number' => '021 000000',
        ]);

        DB::table('phones')->insert([
            'number' => '022 000000',
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
