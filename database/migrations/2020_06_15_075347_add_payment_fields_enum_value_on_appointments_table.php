<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

class AddPaymentFieldsEnumValueOnAppointmentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::statement("
            ALTER TABLE `appointments`
                MODIFY COLUMN `payment_term` ENUM('prepaid', 'postpaid', 'on_appointment', 'not_applicable') NULL,
                MODIFY COLUMN `payment_method` ENUM('cash', 'bank_transfer', 'card', 'not_applicable') NULL;
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
            ALTER TABLE `appointments`
                MODIFY COLUMN `payment_term` ENUM('prepaid', 'postpaid', 'on_appointment') NULL,
                MODIFY COLUMN `payment_method` ENUM('cash', 'bank_transfer', 'card') NULL;
        ");
    }
}
