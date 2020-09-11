<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddMobileColumnsOnBillingDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::statement("
            ALTER TABLE `billing_details`
                ADD COLUMN `mobile_country_code` VARCHAR(255) AFTER `invoice_email`,
                ADD COLUMN `mobile_number` VARCHAR(255) AFTER `mobile_country_code`,
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
            ALTER TABLE `billing_details`
                DROP COLUMN `mobile_country_code`;
                DROP COLUMN `mobile_number`;
                DROP COLUMN `phone_country_code`,
                DROP COLUMN `phone_number`;
        ");
    }
}
