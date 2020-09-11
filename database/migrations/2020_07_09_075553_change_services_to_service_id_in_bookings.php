<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ChangeServicesToServiceIdInBookings extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('bookings', function (Blueprint $table) {
            $table->dropColumn('services');
        });

        Schema::table('bookings', function (Blueprint $table) {
            $table->bigInteger('service_id')->after('notes')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('bookings', function (Blueprint $table) {
            $table->longText('services')->nullable();
        });

        Schema::table('bookings', function (Blueprint $table) {
            $table->dropColumn('service_id');
        });
    }
}
