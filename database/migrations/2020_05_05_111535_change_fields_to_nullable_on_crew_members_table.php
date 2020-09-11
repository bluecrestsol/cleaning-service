<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ChangeFieldsToNullableOnCrewMembersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::statement("
            ALTER TABLE `crew_members`
                MODIFY COLUMN `position` VARCHAR(255) NULL,
                MODIFY COLUMN `doc_type` ENUM('passport', 'id_card', 'drivers_license') NULL,
                MODIFY COLUMN `line` VARCHAR(255) NULL,
                MODIFY COLUMN `whatsapp` VARCHAR(255) NULL;
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
            ALTER TABLE `crew_members`
                MODIFY COLUMN `position` VARCHAR(255) NOT NULL,
                MODIFY COLUMN `doc_type` ENUM('passport', 'id_card', 'drivers_license') NOT NULL,
                MODIFY COLUMN `line` VARCHAR(255) NOT NULL,
                MODIFY COLUMN `whatsapp` VARCHAR(255) NOT NULL;
        ");
    }
}
