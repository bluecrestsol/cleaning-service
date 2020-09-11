<?php

use Illuminate\Database\Seeder;

class CompanySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \DB::table('companies')->truncate();
        \DB::table('companies')->insert(array (
            0 => 
            array (
                'id' => 1,
                'name' => 'Mister Shield Services Co., Ltd',
                'country_id' => 226,
                'website' => 'www.mistershield.co.th',
                'customer_service_email' => 'help@mistershield.co.th'
            )
        ));
    }
}
