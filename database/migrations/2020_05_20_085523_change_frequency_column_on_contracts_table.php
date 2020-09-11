<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

class ChangeFrequencyColumnOnContractsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //'daily','twice_a_week','weekly','biweekly','monthly'
        DB::statement("
            ALTER TABLE `contracts`
                MODIFY COLUMN `frequency` ENUM('daily', 'twice_a_week', 'weekly', 'biweekly', 'monthly') NULL;
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
                MODIFY COLUMN `frequency` ENUM('daily', 'biweekly', 'weekly', 'bimonthly', 'monthly', 'quarterly') NULL;
        ");
    }
}
