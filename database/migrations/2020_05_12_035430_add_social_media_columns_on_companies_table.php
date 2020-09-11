<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddSocialMediaColumnsOnCompaniesTable extends Migration
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
                ADD COLUMN `linkedin` VARCHAR(255) NULL AFTER `instagram`,
                ADD COLUMN `youtube` VARCHAR(255) NULL AFTER `linkedin`;
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
                DROP COLUMN `linkedin`,
                DROP COLUMN `youtube`;
        ");
    }
}
