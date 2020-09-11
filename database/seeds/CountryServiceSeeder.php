<?php

use Illuminate\Database\Seeder;
use App\Models\CountryService;

class CountryServiceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(CountryService::class, 15)->create();
    }
}
