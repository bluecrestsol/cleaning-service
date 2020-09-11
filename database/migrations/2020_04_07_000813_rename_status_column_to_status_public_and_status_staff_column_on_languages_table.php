<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

class RenameStatusColumnToStatusPublicAndStatusStaffColumnOnLanguagesTable extends Migration
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
                CHANGE COLUMN `status` `status_public` ENUM('enabled', 'disabled', 'draft'),
                ADD COLUMN `status_staff` ENUM('enabled', 'disabled') AFTER `status_public`;
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
                CHANGE COLUMN `status_public` `status` ENUM('enabled', 'disabled', 'draft'),
                DROP COLUMN `status_staff`;
        ");
    }
}
