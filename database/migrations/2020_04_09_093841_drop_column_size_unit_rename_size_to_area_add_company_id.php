<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class DropColumnSizeUnitRenameSizeToAreaAddCompanyId extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::statement("
            ALTER TABLE bookings
                DROP COLUMN size_unit;
        ");

        DB::statement("
            ALTER TABLE `bookings`
                CHANGE COLUMN `size` `area` VARCHAR(255) NOT NULL
        ");

        Schema::table('bookings', function (Blueprint $table) {
            $table->integer('company_id')->after('country_id')->nullable();
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
            //
        });
    }
}
