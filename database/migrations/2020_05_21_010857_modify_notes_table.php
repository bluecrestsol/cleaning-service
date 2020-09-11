<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

class ModifyNotesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::statement("
            ALTER TABLE `notes`
                DROP COLUMN `subject`,
                CHANGE COLUMN `staff_id` `admin_id` INTEGER NULL;
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
            ALTER TABLE `notes`
                CHANGE COLUMN `admin_id` `staff_id` INTEGER NULL,
                ADD COLUMN `subject` VARCHAR(255) NULL AFTER `staff_id`;

        ");
    }
}
