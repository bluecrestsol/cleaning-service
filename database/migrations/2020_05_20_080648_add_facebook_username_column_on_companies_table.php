<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

class AddFacebookUsernameColumnOnCompaniesTable extends Migration
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
                ADD COLUMN `facebook_username` VARCHAR(255) NULL AFTER `facebook`;
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
                DROP COLUMN `facebook_username`;
        ");
    }
}
