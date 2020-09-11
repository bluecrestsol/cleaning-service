<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddCountryIdAndCompanyIdColumnOnCrewMembersTable extends Migration
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
                ADD COLUMN `country_id` INTEGER AFTER `nationality_country_id`,
                ADD COLUMN `company_id` INTEGER AFTER `country_id`;
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
                DROP COLUMN `country_id`,
                DROP COLUMN `company_id`;
        ");
    }
}
