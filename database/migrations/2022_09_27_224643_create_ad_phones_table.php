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
        Schema::create('ad_phones', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('ad_id');
            $table->unsignedBigInteger('phone_id');
            $table->foreign('ad_id')->references('id')->on('ads')->onDelete('cascade');
            $table->foreign('phone_id')->references('id')->on('phones')->onDelete('cascade');
            $table->timestamps();
        });

        DB::table('ad_phones')->insert([
            'ad_id' => 1,
            'phone_id' => 1
        ]);

        DB::table('ad_phones')->insert([
            'ad_id' => 2,
            'phone_id' => 2
        ]);

        DB::table('ad_phones')->insert([
            'ad_id' => 3,
            'phone_id' => 3
        ]);

        DB::table('ad_phones')->insert([
            'ad_id' => 4,
            'phone_id' => 4
        ]);

        DB::table('ad_phones')->insert([
            'ad_id' => 5,
            'phone_id' => 5
        ]);

        DB::table('ad_phones')->insert([
            'ad_id' => 6,
            'phone_id' => 6
        ]);

        DB::table('ad_phones')->insert([
            'ad_id' => 7,
            'phone_id' => 7
        ]);

        DB::table('ad_phones')->insert([
            'ad_id' => 8,
            'phone_id' => 8
        ]);

        DB::table('ad_phones')->insert([
            'ad_id' => 9,
            'phone_id' => 9
        ]);

        DB::table('ad_phones')->insert([
            'ad_id' => 10,
            'phone_id' => 10
        ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('ad_phones');
    }
};
