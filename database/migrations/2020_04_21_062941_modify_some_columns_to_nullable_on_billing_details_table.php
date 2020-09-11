<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ModifySomeColumnsToNullableOnBillingDetailsTable extends Migration
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
                MODIFY `name` VARCHAR(255) NULL,
                MODIFY `contact_first_name` VARCHAR(255) NULL,
                MODIFY `contact_last_name` VARCHAR(255) NULL,
                MODIFY `contact_email` VARCHAR(255) NULL,
                MODIFY `contact_phone` VARCHAR(255) NULL,
                MODIFY `invoice_email` VARCHAR(255) NULL,
                MODIFY `tax_code` VARCHAR(255) NULL;
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
                MODIFY `name` VARCHAR(255) NOT NULL,
                MODIFY `contact_first_name` VARCHAR(255) NOT NULL,
                MODIFY `contact_last_name` VARCHAR(255) NOT NULL,
                MODIFY `contact_email` VARCHAR(255) NOT NULL,
                MODIFY `contact_phone` VARCHAR(255) NOT NULL,
                MODIFY `invoice_email` VARCHAR(255) NOT NULL,
                MODIFY `tax_code` VARCHAR(255) NOT NULL;
        ");
    }
}
