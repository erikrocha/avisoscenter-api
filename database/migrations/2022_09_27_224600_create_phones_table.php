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
            'number' => '111-111111',
        ]);

        DB::table('phones')->insert([
            'number' => '222-222222',
        ]);

        DB::table('phones')->insert([
            'number' => '333-333333',
        ]);

        DB::table('phones')->insert([
            'number' => '444-444444',
        ]);

        DB::table('phones')->insert([
            'number' => '555-555555',
        ]);

        DB::table('phones')->insert([
            'number' => '666-666666',
        ]);

        DB::table('phones')->insert([
            'number' => '777-777777',
        ]);

        DB::table('phones')->insert([
            'number' => '888-888888',
        ]);

        DB::table('phones')->insert([
            'number' => '999-999999',
        ]);

        DB::table('phones')->insert([
            'number' => '010-000010',
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
