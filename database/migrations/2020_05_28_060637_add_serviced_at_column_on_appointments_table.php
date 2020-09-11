<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

class AddServicedAtColumnOnAppointmentsTable extends Migration
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
                ADD COLUMN `serviced_at` DATETIME NULL AFTER `scheduled_at`;
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
                DROP COLUMN `serviced_at`;
        ");
    }
}
