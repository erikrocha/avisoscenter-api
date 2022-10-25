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
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name')->nullable();
            $table->string('email')->unique()->nullable();
            $table->string('token_device', 255)->unique()->nullable();
            $table->string('phone', 16)->nullable();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password')->nullable();
            $table->rememberToken()->nullable();
            $table->char('status', 1);
            $table->timestamps();
        });

        DB::table('users')->insert([
            'token_device' => 'fF95p0SAajY:APA91bFLOiRTZUkl7nXcbtF7Z53nH0xGxmEoAZRgb7MDvmLbr6xVIHCgE3YNk9lBT8Ex910ecLlGY_uBRzV9NgcLSBH3W5LpRULueZI2rqVxPaztNXA4lZau030erFqFgjHt_5Mv5wGS',
            'status' => 1
        ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
};
