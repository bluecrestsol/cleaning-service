<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAppointmentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('appointments', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('customer_id');
            $table->integer('place_id');
            $table->integer('service_id');
            $table->string('description');
            $table->integer('currency_id');
            $table->decimal('price', 10,2);
            $table->date('ordered_at');
            $table->enum('status',['booked', 'cancelled_by_customer', 'cancelled_by_company', 'completed']);
            $table->enum('payment_term',['prepaid', 'postpaid', 'on_appointment']);
            $table->enum('payment_method',['cash', 'bank', 'transfer', 'card']);
            $table->string('invoice_number');
            $table->string('invoice_file');
            $table->date('payment_due_at');
            $table->date('paid_at');
            $table->date('performed_at');
            $table->integer('staff_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('appointments');
    }
}
