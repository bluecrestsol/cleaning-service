<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class RenameCustomerServiceNumberColumnToCustomerServicePhoneColumnOnCompaniesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::statement("
            ALTER TABLE `companies`
                CHANGE COLUMN `customer_service_number` `customer_service_phone` VARCHAR(255) NULL;
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
            ALTER TABLE `companies`
                CHANGE COLUMN `customer_service_phone` `customer_service_number` VARCHAR(255) NULL;
        ");
    }
}
