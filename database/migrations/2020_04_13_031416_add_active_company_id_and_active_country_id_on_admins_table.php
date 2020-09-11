<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddActiveCompanyIdAndActiveCountryIdOnAdminsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::statement("
            ALTER TABLE `admins`
                ADD COLUMN `active_company_id` INTEGER AFTER `country_id`,
                ADD COLUMN `active_country_id` INTEGER AFTER `active_company_id`;
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
            ALTER TABLE `admins`
                DROP COLUMN `active_company_id`,
                DROP COLUMN `active_country_id`;
        ");
    }
}
