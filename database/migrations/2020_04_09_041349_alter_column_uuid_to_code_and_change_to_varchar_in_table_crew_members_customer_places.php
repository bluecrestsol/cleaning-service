<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AlterColumnUuidToCodeAndChangeToVarcharInTableCrewMembersCustomerPlaces extends Migration
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
                MODIFY COLUMN `uuid` VARCHAR(255) NOT NULL
        ");

        DB::statement("
            ALTER TABLE `crew_members`
                CHANGE COLUMN `uuid` `code` VARCHAR(255) NOT NULL
        ");

        DB::statement("
            ALTER TABLE `customers`
                MODIFY COLUMN `uuid` VARCHAR(255) NOT NULL
        ");

        DB::statement("
            ALTER TABLE `customers`
                CHANGE COLUMN `uuid` `code` VARCHAR(255) NOT NULL
        ");

        DB::statement("
            ALTER TABLE `places`
                MODIFY COLUMN `uuid` VARCHAR(255) NOT NULL
        ");

        DB::statement("
            ALTER TABLE `places`
                CHANGE COLUMN `uuid` `code` VARCHAR(255) NOT NULL
        ");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
       //
    }
}
