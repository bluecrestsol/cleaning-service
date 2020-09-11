<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class RenameMobileRelatedColumnsAndAddAdditionalColumnsOnCrewMembersTable extends Migration
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
                CHANGE COLUMN `mobile` `mobile_country_code` VARCHAR(255),
                ADD COLUMN `mobile_number` VARCHAR(255) AFTER `mobile_country_code`,
                ADD COLUMN `doc_number` VARCHAR(255) AFTER `doc_type`,
                ADD COLUMN `status` ENUM('enabled', 'disabled', 'dismissed') AFTER `last_name`;
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
                CHANGE COLUMN `mobile_country_code` `mobile` VARCHAR(255),
                DROP COLUMN `mobile_number`,
                DROP COLUMN `doc_number`,
                DROP COLUMN `status`;
        ");
    }
}
