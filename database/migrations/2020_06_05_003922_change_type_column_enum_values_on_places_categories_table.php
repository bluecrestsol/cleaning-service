<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

class ChangeTypeColumnEnumValuesOnPlacesCategoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::statement("
            ALTER TABLE `places_categories`
                MODIFY COLUMN `type` ENUM('residential', 'commercial', 'public');
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
            ALTER TABLE `places_categories`
                MODIFY COLUMN `type` ENUM('private', 'commercial', 'public');
        ");
    }
}
