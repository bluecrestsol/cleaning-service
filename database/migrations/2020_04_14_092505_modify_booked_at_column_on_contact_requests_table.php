<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ModifyBookedAtColumnOnContactRequestsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::statement("
            ALTER TABLE `contact_requests`
                CHANGE COLUMN `bookeed_at` `booked_at` DATETIME;
        ");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        DB::statement("
            ALTER TABLE `contact_requests`
                CHANGE COLUMN `booked_at` `bookeed_at` TIMESTAMP;
        ");
    }
}
