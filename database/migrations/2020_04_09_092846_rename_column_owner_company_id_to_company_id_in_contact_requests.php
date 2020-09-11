<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class RenameColumnOwnerCompanyIdToCompanyIdInContactRequests extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::statement("
            ALTER TABLE `contact_requests`
                CHANGE COLUMN `owner_company_id` `company_id` integer(11)
        ");

        DB::statement("
            ALTER TABLE `contact_requests`
                CHANGE COLUMN `owner_country_id` `country_id` integer(11)
        ");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('contact_requests', function (Blueprint $table) {
            //
        });
    }
}
