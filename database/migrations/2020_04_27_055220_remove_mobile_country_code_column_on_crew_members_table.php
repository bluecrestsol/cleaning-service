<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

class RemoveMobileCountryCodeColumnOnCrewMembersTable extends Migration
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
                DROP COLUMN `mobile_country_code`;
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
                ADD COLUMN `mobile_country_code` VARCHAR(255) NULL AFTER `doc_number`;
        ");
    }
}
