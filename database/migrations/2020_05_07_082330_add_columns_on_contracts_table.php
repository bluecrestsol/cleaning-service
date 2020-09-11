<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColumnsOnContractsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::statement("
            ALTER TABLE `contracts`
                ADD COLUMN `started_at` DATE NULL AFTER `code`,
                ADD COLUMN `ended_at` DATE NULL AFTER `started_at`,
                CHANGE COLUMN `price` `monthly_price` DECIMAL(10, 2) NULL;
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
            ALTER TABLE `contracts`
                DROP COLUMN `started_at`,
                DROP COLUMN `ended_at`,
                CHANGE COLUMN `monthly_price` `price` DECIMAL(10, 2) NULL;
        ");
    }
}
