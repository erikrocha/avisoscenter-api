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
        Schema::create('ad_categories', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('ad_id');
            $table->unsignedBigInteger('category_id');
            $table->foreign('ad_id')->references('id')->on('ads')->onDelete('cascade');
            $table->foreign('category_id')->references('id')->on('categories')->onDelete('cascade');                        
            $table->timestamps();
        });

        DB::table('ad_categories')->insert([
            'ad_id' => 1,
            'category_id' => 1
        ]);

        DB::table('ad_categories')->insert([
            'ad_id' => 2,
            'category_id' => 3
        ]);

        DB::table('ad_categories')->insert([
            'ad_id' => 3,
            'category_id' => 2
        ]);

        DB::table('ad_categories')->insert([
            'ad_id' => 4,
            'category_id' => 1
        ]);

        DB::table('ad_categories')->insert([
            'ad_id' => 5,
            'category_id' => 3
        ]);

        DB::table('ad_categories')->insert([
            'ad_id' => 6,
            'category_id' => 1
        ]);

        DB::table('ad_categories')->insert([
            'ad_id' => 7,
            'category_id' => 1
        ]);

        DB::table('ad_categories')->insert([
            'ad_id' => 8,
            'category_id' => 2
        ]);

        DB::table('ad_categories')->insert([
            'ad_id' => 9,
            'category_id' => 2
        ]);

        DB::table('ad_categories')->insert([
            'ad_id' => 10,
            'category_id' => 3
        ]);

        // 11
        DB::table('ad_categories')->insert([
            'ad_id' => 11,
            'category_id' => 2
        ]);

        // 12
        DB::table('ad_categories')->insert([
            'ad_id' => 12,
            'category_id' => 2
        ]);

        // 13
        DB::table('ad_categories')->insert([
            'ad_id' => 13,
            'category_id' => 2
        ]);

        // 14
        DB::table('ad_categories')->insert([
            'ad_id' => 14,
            'category_id' => 2
        ]);

        // 15
        DB::table('ad_categories')->insert([
            'ad_id' => 15,
            'category_id' => 2
        ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('ad_categories');
    }
};
