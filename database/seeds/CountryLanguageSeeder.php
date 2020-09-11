<?php

use Illuminate\Database\Seeder;

class CountryLanguageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // \DB::table('country_language')->truncate();

        \DB::table('country_language')->insert(array (
            0 => 
            array (
                'id' => 1,
                'country_id' => 226,
                'language_id' => 41,
                'status' => 'enabled',
                'is_primary' => 0,
            ),
            1 => 
            array (
                'id' => 2,
                'country_id' => 226,
                'language_id' => 157,
                'status' => 'enabled',
                'is_primary' => 1,
            )
        ));
    }
}
