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

        DB::table('ad_phones')->insert([
            'ad_id' => 11,
            'phone_id' => 11
        ]);

        DB::table('ad_phones')->insert([
            'ad_id' => 12,
            'phone_id' => 12
        ]);

        DB::table('ad_phones')->insert([
            'ad_id' => 13,
            'phone_id' => 13
        ]);

        DB::table('ad_phones')->insert([
            'ad_id' => 14,
            'phone_id' => 14
        ]);

        DB::table('ad_phones')->insert([
            'ad_id' => 15,
            'phone_id' => 15
        ]);

        DB::table('ad_phones')->insert([
            'ad_id' => 16,
            'phone_id' => 16
        ]);

        DB::table('ad_phones')->insert([
            'ad_id' => 17,
            'phone_id' => 17
        ]);

        DB::table('ad_phones')->insert([
            'ad_id' => 18,
            'phone_id' => 18
        ]);

        DB::table('ad_phones')->insert([
            'ad_id' => 19,
            'phone_id' => 19
        ]);

        DB::table('ad_phones')->insert([
            'ad_id' => 20,
            'phone_id' => 20
        ]);

        DB::table('ad_phones')->insert([
            'ad_id' => 21,
            'phone_id' => 21
        ]);

        DB::table('ad_phones')->insert([
            'ad_id' => 22,
            'phone_id' => 22
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
