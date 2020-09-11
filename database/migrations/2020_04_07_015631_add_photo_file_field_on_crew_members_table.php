<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;

class AddPhotoFileFieldOnCrewMembersTable extends Migration
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
                ADD COLUMN `photo_file` VARCHAR(255) AFTER `whatsapp`;
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
                DROP COLUMN `photo_file`;
        ");
    }
}
