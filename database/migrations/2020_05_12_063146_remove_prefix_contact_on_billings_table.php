<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class RemovePrefixContactOnBillingsTable extends Migration
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
                CHANGE COLUMN `contact_first_name` `first_name` VARCHAR(255) NULL,
                CHANGE COLUMN `contact_last_name` `last_name` VARCHAR(255) NULL,
                CHANGE COLUMN `contact_email` `email` VARCHAR(255) NULL,
                DROP COLUMN `contact_phone`;
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
                CHANGE COLUMN `first_name` `contact_first_name` VARCHAR(255) NULL,
                CHANGE COLUMN `last_name` `contact_last_name` VARCHAR(255) NULL,
                CHANGE COLUMN `email` `contact_email` VARCHAR(255) NULL,
                ADD COLUMN `contact_phone` VARCHAR(255) NULL AFTER `contact_email`;
        ");
    }
}
