<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ModifyMobileAndPhoneRelatedFieldsOnCustomersTable extends Migration
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
                DROP COLUMN `mobile_country_code`,
                DROP COLUMN `phone_country_code`,
                CHANGE COLUMN `mobile_number` `mobile` VARCHAR(255) NULL,
                CHANGE COLUMN `phone_number` `phone` VARCHAR(255) NULL;
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
                CHANGE COLUMN `mobile` `mobile_number` VARCHAR(255) NULL,
                CHANGE COLUMN `phone` `phone_number` VARCHAR(255) NULL,
                ADD COLUMN `mobile_country_code` VARCHAR(255) NULL AFTER `business_name`,
                ADD COLUMN `phone_country_code` VARCHAR(255) NULL AFTER `mobile_number`;
        ");
    }
}
