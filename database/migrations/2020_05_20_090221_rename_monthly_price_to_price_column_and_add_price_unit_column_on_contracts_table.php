<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

class RenameMonthlyPriceToPriceColumnAndAddPriceUnitColumnOnContractsTable extends Migration
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
                CHANGE COLUMN `monthly_price` `price` DECIMAL(10, 2) NULL,
                ADD COLUMN `price_unit` ENUM('appointment', 'week', 'month') NULL AFTER `price`;
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
                CHANGE COLUMN `price` `monthly_price` DECIMAL(10, 2) NULL,
                DROP COLUMN `price_unit`;
        ");
    }
}
