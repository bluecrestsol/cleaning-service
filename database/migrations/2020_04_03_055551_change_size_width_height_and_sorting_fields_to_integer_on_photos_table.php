<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

class ChangeSizeWidthHeightAndSortingFieldsToIntegerOnPhotosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::statement('
            ALTER TABLE `photos`
                MODIFY `size` INTEGER NOT NULL,
                MODIFY `width` INTEGER NOT NULL,
                MODIFY `height` INTEGER NOT NULL,
                MODIFY `sorting` INTEGER
        ');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        DB::statement('
            ALTER TABLE `photos`
                MODIFY `size` VARCHAR NOT NULL,
                MODIFY `width` VARCHAR NOT NULL,
                MODIFY `height` VARCHAR NOT NULL,
                MODIFY `sorting` VARCHAR
        ');
    }
}
