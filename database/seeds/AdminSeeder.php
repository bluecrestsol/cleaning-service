<?php

use Illuminate\Database\Seeder;
use App\Models\Admin;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Admin::truncate();
        factory(Admin::class)->create([
            'first_name' => 'System',
            'last_name' => 'Administrator',
            'email' => 'admin@mistershield.com',
            'status' => 'enabled',
            'active_company_id' => 1,
            'active_country_id' => 226
        ]);
    }
}
