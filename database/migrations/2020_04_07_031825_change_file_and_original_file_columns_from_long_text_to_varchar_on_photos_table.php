<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ChangeFileAndOriginalFileColumnsFromLongTextToVarcharOnPhotosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::statement("
            ALTER TABLE `photos`
                MODIFY COLUMN `file` VARCHAR(255) NOT NULL,
                MODIFY COLUMN `original_file` VARCHAR(255) NOT NULL;
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
            ALTER TABLE `photos`
                MODIFY COLUMN `file` LONGTEXT NOT NULL,
                MODIFY COLUMN `original_file` LONGTEXT NOT NULL;
        ");
    }
}
