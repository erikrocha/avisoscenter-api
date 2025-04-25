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
      Schema::create('bventa_gas', function (Blueprint $table) {
        $table->id();
        $table->string('key', 6)->unique();
        $table->string('user_name', 32)->nullable();
        $table->string('user_phone', 16)->nullable();
        $table->string('user_whatsapp', 16)->nullable();
        $table->boolean('is_used')->default(false);
        $table->string('machine_id', 8)->nullable();
        $table->string('license_type', 16)->nullable();
        $table->string('referral_source', 16)->nullable();
        $table->boolean('is_fully_paid')->default(false);
        $table->timestamp('activated_at')->nullable();
        $table->timestamp('expires_at')->nullable();
      });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
      Schema::dropIfExists('bventa_gas');
    }
};
