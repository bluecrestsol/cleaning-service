<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ModifyContactRequestsTable extends Migration
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
                DROP COLUMN `property_type`,
                DROP COLUMN `category_id`,
                DROP COLUMN `size`,
                DROP COLUMN `service_id`,
                DROP COLUMN `booked_at`,
                CHANGE COLUMN `address` `message` TEXT NULL,
                ADD COLUMN `status` ENUM('new', 'processed') NULL AFTER `business_name`;
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
        ALTER TABLE `contact_requests`
            ADD COLUMN `property_type` ENUM('private', 'commercial', 'public') NULL AFTER `phone`,
            ADD COLUMN `category_id` INTEGER NULL AFTER `property_type`,
            ADD COLUMN `size` DECIMAL(8,2) NULL AFTER `category_id`,
            ADD COLUMN `service_id` INTEGER NULL AFTER `size`,
            ADD COLUMN `booked_at` DATETIME NULL AFTER `service_id`,
            CHANGE COLUMN `message` `address` TEXT NULL,
            DROP COLUMN `status`;
    ");
    }
}
