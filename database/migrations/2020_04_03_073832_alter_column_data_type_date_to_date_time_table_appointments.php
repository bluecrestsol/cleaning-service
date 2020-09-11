<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AlterColumnDataTypeDateToDateTimeTableAppointments extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        \DB::statement("ALTER TABLE `appointments` MODIFY COLUMN `ordered_at` dateTime");
        \DB::statement("ALTER TABLE `appointments` MODIFY COLUMN `payment_due_at` dateTime");
        \DB::statement("ALTER TABLE `appointments` MODIFY COLUMN `paid_at` dateTime");
        \DB::statement("ALTER TABLE `appointments` MODIFY COLUMN `performed_at` dateTime");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
    }
}
