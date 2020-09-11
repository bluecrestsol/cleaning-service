<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ModifyMobileAndPhoneRelatedFieldsOnBillingDetailsTable extends Migration
{
    public function up()
    {
        DB::statement("
            ALTER TABLE `billing_details`
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
            ALTER TABLE `billing_details`
                CHANGE COLUMN `mobile` `mobile_number` VARCHAR(255) NULL,
                CHANGE COLUMN `phone` `phone_number` VARCHAR(255) NULL,
                ADD COLUMN `mobile_country_code` VARCHAR(255) NULL AFTER `invoice_email`,
                ADD COLUMN `phone_country_code` VARCHAR(255) NULL AFTER `mobile_number`;
        ");
    }
}
