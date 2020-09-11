<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

class AddStatusCrewColumnOnLanguagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::statement("
            ALTER TABLE `languages`
                ADD COLUMN `status_crew` ENUM('enabled', 'disabled') NULL DEFAULT 'disabled' AFTER `status_staff`;
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
            ALTER TABLE `languages`
                DROP COLUMN IF EXISTS `status_crew`;
        ");
    }
}
