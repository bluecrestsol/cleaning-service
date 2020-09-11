<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ModifySomeColumnsToNullableOnCompaniesTable extends Migration
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
                MODIFY `code` VARCHAR(255) NULL,
                MODIFY `email` VARCHAR(255) NULL,
                MODIFY `password` VARCHAR(255) NULL,
                MODIFY `first_name` VARCHAR(255) NULL,
                MODIFY `last_name` VARCHAR(255) NULL AFTER `first_name`,
                MODIFY `middle_name` VARCHAR(255) NULL,
                MODIFY `title` ENUM('mr', 'mrs', 'ms', 'dr', 'prof') NULL,
                MODIFY `business_name` VARCHAR(255) NULL,
                MODIFY `line` VARCHAR(255) NULL,
                MODIFY `whatsapp` VARCHAR(255) NULL
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
                MODIFY `code` VARCHAR(255) NOT NULL,
                MODIFY `email` VARCHAR(255) NOT NULL,
                MODIFY `password` VARCHAR(255) NOT NULL,
                MODIFY `first_name` VARCHAR(255) NOT NULL,
                MODIFY `last_name` VARCHAR(255) NOT NULL AFTER `title`,
                MODIFY `middle_name` VARCHAR(255) NOT NULL,
                MODIFY `title` ENUM('mr', 'mrs', 'ms', 'dr', 'prof') NOT NULL,
                MODIFY `business_name` VARCHAR(255) NOT NULL,
                MODIFY `line` VARCHAR(255) NOT NULL,
                MODIFY `whatsapp` VARCHAR(255) NOT NULL
        ");
    }
}
