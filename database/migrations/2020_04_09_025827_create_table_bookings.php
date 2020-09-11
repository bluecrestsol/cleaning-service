<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTableBookings extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bookings', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('customer_id')->nullable();
            $table->enum('status',['new', 'processed', 'deleted']);
            $table->string('name')->nullable();
            $table->string('business_name')->nullable();
            $table->integer('category_id')->nullable();
            $table->string('email')->nullable();
            $table->string('phone')->nullable();
            $table->integer('country_id')->nullable();
            $table->integer('size_unit')->nullable();
            $table->decimal('size')->nullable();
            $table->text('services')->nullable();
            $table->text('address')->nullable();
            $table->text('notes')->nullable();
            $table->text('booked_at')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('bookings');
    }
}
