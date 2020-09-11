<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class RenameNationalityColumnToNationalityCountryIdOnCrewMembersTable extends Migration
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
                CHANGE COLUMN `nationality` `nationality_country_id` INTEGER NULL;
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
                CHANGE COLUMN `nationality_country_id` `nationality` INTEGER NULL;
        ");
    }
}
