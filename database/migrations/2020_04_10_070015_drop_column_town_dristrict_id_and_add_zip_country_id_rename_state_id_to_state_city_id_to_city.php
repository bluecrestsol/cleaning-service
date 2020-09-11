<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class DropColumnTownDristrictIdAndAddZipCountryIdRenameStateIdToStateCityIdToCity extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::statement("
            ALTER TABLE `addresses`
                CHANGE COLUMN `state_id` `state` VARCHAR(255) NOT NULL
        ");

        DB::statement("
            ALTER TABLE `addresses`
                CHANGE COLUMN `city_id` `city` VARCHAR(255) NOT NULL
        ");

        Schema::table('addresses', function (Blueprint $table) {
            $table->dropColumn('town');
            $table->dropColumn('district_id');
            $table->string('zip')->after('city');
            $table->integer('country_id')->after('zip');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('addresses', function (Blueprint $table) {
            //
        });
    }
}
