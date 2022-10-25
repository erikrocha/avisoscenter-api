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
        Schema::create('images', function (Blueprint $table) {
            $table->id();
            $table->string('description', '64')->nullable();
            $table->string('url', 256);
            $table->timestamps();
        });

        DB::table('images')->insert([
            'url' => 'https://acenter.s3.sa-east-1.amazonaws.com/19d56c8e85debd43f8bc56b192dc4576-se_large_800_400.webp'
        ]);

        DB::table('images')->insert([
            'url' => 'https://acenter.s3.sa-east-1.amazonaws.com/b7f94543786e1d8b36cd5f7c8c8bac00-se_large_800_400.webp'
        ]);

        DB::table('images')->insert([
            'url' => 'https://acenter.s3.sa-east-1.amazonaws.com/f8da1f1f5bb3053662e56f7287556602-se_large_800_400.webp'
        ]);

        DB::table('images')->insert([
            'url' => 'https://acenter.s3.sa-east-1.amazonaws.com/19d56c8e85debd43f8bc56b192dc4576-se_extra_large_1500_800.webp'
        ]);

        DB::table('images')->insert([
            'url' => 'https://acenter.s3.sa-east-1.amazonaws.com/b7f94543786e1d8b36cd5f7c8c8bac00-se_extra_large_1500_800.webp'
        ]);

        DB::table('images')->insert([
            'url' => 'https://acenter.s3.sa-east-1.amazonaws.com/f8da1f1f5bb3053662e56f7287556602-se_extra_large_1500_800.webp'
        ]);

        DB::table('images')->insert([
            'url' => 'https://acenter.s3.sa-east-1.amazonaws.com/282427123_5219699961417572_4797030558590674069_n.jpg'
        ]);

        
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('images');
    }
};
