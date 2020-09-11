<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddIsLeaderColumnOnAppointmentCrewMemberTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::statement("
            ALTER TABLE `appointment_crew_member`
                ADD COLUMN `is_leader` BOOLEAN DEFAULT 0 AFTER `appointment_id`;
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
            ALTER TABLE `appointment_crew_member`
                DROP COLUMN `is_leader`;
        ");
    }
}
