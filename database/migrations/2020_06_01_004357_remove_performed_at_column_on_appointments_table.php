<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

class RemovePerformedAtColumnOnAppointmentsTable extends Migration
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
                DROP COLUMN `performed_at`,
                CHANGE COLUMN `serviced_at` `serviced_at` DATETIME NULL AFTER `paid_at`;
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
                ADD COLUMN `performed_at` DATETIME NULL AFTER `paid_at`,
                CHANGE COLUMN `serviced_at` `serviced_at` DATETIME NULL AFTER `scheduled_at`;
        ");
    }
}
