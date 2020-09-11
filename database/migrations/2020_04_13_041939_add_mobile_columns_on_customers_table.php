<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddMobileColumnsOnCustomersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::statement("
            ALTER TABLE `customers`
                ADD COLUMN `mobile_country_code` VARCHAR(255) AFTER `business_name`,
                CHANGE COLUMN `mobile` `mobile_number` VARCHAR(255),
                ADD COLUMN `phone_country_code` VARCHAR(255) AFTER `mobile_number`,
                ADD COLUMN `phone_number` VARCHAR(255) AFTER `phone_country_code`;
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
            ALTER TABLE `customers`
                DROP COLUMN `mobile_country_code`;
                CHANGE COLUMN `mobile_number` `mobile` VARCHAR(255),
                DROP COLUMN `phone_country_code`,
                DROP COLUMN `phone_number`;
        ");
    }
}
