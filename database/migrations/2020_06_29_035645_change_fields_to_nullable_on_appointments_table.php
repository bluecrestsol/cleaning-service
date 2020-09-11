<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

class ChangeFieldsToNullableOnAppointmentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('appointments', function (Blueprint $table) {
            $table->integer('customer_id')->nullable()->change();
            $table->integer('place_id')->nullable()->change();
            $table->integer('service_id')->nullable()->change();
            $table->string('description')->nullable()->change();
            $table->integer('currency_id')->nullable()->change();
            $table->decimal('price',10,2)->nullable()->change();
            $table->string('invoice_number')->nullable()->change();
            $table->string('invoice_file')->nullable()->change();
        });
        DB::statement("
            ALTER TABLE `appointments`
                MODIFY COLUMN `status` ENUM('booked', 'cancelled_by_customer', 'cancelled_by_company', 'completed') NULL,
                MODIFY COLUMN `payment_term` ENUM('prepaid', 'postpaid', 'on_appointment', 'not_applicable') NULL;
        ");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('appointments', function (Blueprint $table) {
            $table->integer('customer_id')->nullable(false)->change();
            $table->integer('place_id')->nullable(false)->change();
            $table->integer('service_id')->nullable(false)->change();
            $table->string('description')->nullable(false)->change();
            $table->integer('currency_id')->nullable(false)->change();
            $table->decimal('price',10,2)->nullable(false)->change();
            $table->string('invoice_number')->nullable(false)->change();
            $table->string('invoice_file')->nullable(false)->change();
        });
        DB::statement("
            ALTER TABLE `appointments`
                MODIFY COLUMN `status` ENUM('booked', 'cancelled_by_customer', 'cancelled_by_company', 'completed') NOT NULL,
                MODIFY COLUMN `payment_term` ENUM('prepaid', 'postpaid', 'on_appointment', 'not_applicable') NOT NULL;
        ");
    }
}
