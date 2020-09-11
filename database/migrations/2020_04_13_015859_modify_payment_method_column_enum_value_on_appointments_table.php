<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ModifyPaymentMethodColumnEnumValueOnAppointmentsTable extends Migration
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
                MODIFY COLUMN `payment_method` ENUM('cash', 'bank_transfer', 'card') DEFAULT NULL
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
                MODIFY COLUMN `payment_method` ENUM('cash', 'bank transfer', 'card') DEFAULT NULL
        ");
    }
}
