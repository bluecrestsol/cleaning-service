<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddSomeFieldsOnCrewMembersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::statement("
            ALTER TABLE `crew_members`
                ADD COLUMN `title` ENUM('mr', 'mrs', 'ms', 'dr', 'prof') NULL AFTER `type`,
                ADD COLUMN `phone` VARCHAR(255) NULL AFTER `mobile_number`,
                ADD COLUMN `doc_file` VARCHAR(255) NULL AFTER `whatsapp`;
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
            ALTER TABLE `crew_members`
                DROP COLUMN `title`,
                DROP COLUMN `phone`,
                DROP COLUMN `doc_file`;
        ");
    }
}
