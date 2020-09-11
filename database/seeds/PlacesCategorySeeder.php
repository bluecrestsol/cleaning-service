<?php

use Illuminate\Database\Seeder;
use App\Models\PlacesCategory;

class PlacesCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $data = [
            [
                'name' => $this->encode([
                    'en' => 'Condominium',
                    'th' => 'TH Condominium',
                ]),
                'type' => 'private'
            ],
            [
                'name' => $this->encode([
                    'en' => 'Single house',
                    'th' => 'TH Single house',
                ]),
                'type' => 'private'
            ],
            [
                'name' => $this->encode([
                    'en' => 'Town house',
                    'th' => 'TH Town house',
                ]),
                'type' => 'private'
            ],
            [
                'name' => $this->encode([
                    'en' => 'Restaurant',
                    'th' => 'TH Restaurant',
                ]),
                'type' => 'commercial'
            ],
            [
                'name' => $this->encode([
                    'en' => 'Office',
                    'th' => 'TH Office',
                ]),
                'type' => 'commercial'
            ],
            [
                'name' => $this->encode([
                    'en' => 'Bar',
                    'th' => 'TH Bar',
                ]),
                'type' => 'commercial'
            ],
            [
                'name' => $this->encode([
                    'en' => 'Clinic',
                    'th' => 'TH Clinic',
                ]),
                'type' => 'commercial'
            ],
            [
                'name' => $this->encode([
                    'en' => 'Shop',
                    'th' => 'TH Shop',
                ]),
                'type' => 'commercial'
            ],
            [
                'name' => $this->encode([
                    'en' => 'Park',
                    'th' => 'TH Park',
                ]),
                'type' => 'public'
            ],
            [
                'name' => $this->encode([
                    'en' => 'Train station',
                    'th' => 'TH Train station',
                ]),
                'type' => 'public'
            ]
        ];

        PlacesCategory::truncate();
        PlacesCategory::insert($data);
    }

    private function encode($item) {
        return json_encode($item);
    }
}
