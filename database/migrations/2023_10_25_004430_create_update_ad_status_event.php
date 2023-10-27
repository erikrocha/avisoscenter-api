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
        DB::unprepared('
            CREATE EVENT UpdateAdStatus
            ON SCHEDULE EVERY 1 HOUR
            DO
              UPDATE ads
              SET 
                status = 0,
                notes = CONCAT(notes, ", inactive(event)")
              WHERE expired_at <= NOW();
        ');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        DB::unprepared('DROP EVENT IF EXISTS UpdateAdStatus');
    }
};
