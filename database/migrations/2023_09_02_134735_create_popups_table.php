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
        Schema::create('popups', function (Blueprint $table) {
            $table->id();
            $table->string('title', 32);
            $table->text('body')->nullable();
            $table->string('image', 256);
            $table->string('link', 128)->nullable();
            $table->boolean('status')->default(1);
            $table->timestamps();
        });

        DB::table('popups')->insert([
            'title' => 'popup-1',
            'body'  => 'body-1',
            'image' => 'https://avisoscenter.nyc3.cdn.digitaloceanspaces.com/popups/popup-1.jpg',
            'link'  => '\'customer\', {customer_id: 1}',
        ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('popups');
    }
};
