<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

class ModifyServicesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::statement("
            ALTER TABLE `services`
                ADD COLUMN `status` ENUM('enabled', 'disabled') NULL DEFAULT 'disabled' AFTER `description`,
                ADD COLUMN `company_id` INTEGER NULL AFTER `status`,
                ADD COLUMN `country_id` INTEGER NULL AFTER `company_id`,
                ADD COLUMN `price` DECIMAL(10, 2) NULL AFTER `country_id`,
                ADD COLUMN `discounted_price` DECIMAL(10, 2) NULL AFTER `price`,
                ADD COLUMN `order` INTEGER NULL AFTER `discounted_price`;
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
            ALTER TABLE `services`
                DROP COLUMN `status`,
                DROP COLUMN `company_id`,
                DROP COLUMN `country_id`,
                DROP COLUMN `price`,
                DROP COLUMN `discounted_price`,
                DROP COLUMN `order`;
        ");
    }
}
