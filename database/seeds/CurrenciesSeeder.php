<?php

use Illuminate\Database\Seeder;

class CurrenciesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \DB::table('currencies')->truncate();
        \DB::table('currencies')->insert(array (
            0 => 
            array (
                'id' => 1,
                'Code' => 'THB',
                'Name' => 'Thai baht',
                'Symbol' => '฿'
            )
        ));
    }
}
