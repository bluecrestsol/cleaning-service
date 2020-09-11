<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ModifyDeletedAtColumnToNullableOnCompaniesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::statement("
            ALTER TABLE `companies`
                MODIFY COLUMN `deleted_at` TIMESTAMP NULL;
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
            ALTER TABLE `companies`
                MODIFY COLUMN `deleted_at` TIMESTAMP NULL;
        ");
    }
}
