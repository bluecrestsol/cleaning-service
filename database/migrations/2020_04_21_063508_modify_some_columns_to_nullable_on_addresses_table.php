<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ModifySomeColumnsToNullableOnAddressesTable extends Migration
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
                MODIFY `state` VARCHAR(255) NULL,
                MODIFY `city` VARCHAR(255) NULL,
                MODIFY `zip` VARCHAR(255) NULL,
                MODIFY `country_id` VARCHAR(255) NULL;
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
            ALTER TABLE `addresses`
                MODIFY `state` VARCHAR(255) NOT NULL,
                MODIFY `city` VARCHAR(255) NOT NULL,
                MODIFY `zip` VARCHAR(255) NOT NULL,
                MODIFY `country_id` VARCHAR(255) NOT NULL;
        ");
    }
}
