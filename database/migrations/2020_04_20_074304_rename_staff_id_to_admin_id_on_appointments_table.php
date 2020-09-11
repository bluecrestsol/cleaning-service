<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class RenameStaffIdToAdminIdOnAppointmentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::statement("
            ALTER TABLE `appointments`
                CHANGE COLUMN `staff_id` `admin_id` INTEGER AFTER `customer_id`;
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
            ALTER TABLE `appointments`
                CHANGE COLUMN `admin_id` `staff_id` INTEGER AFTER `customer_id`;
        ");
    }
}
