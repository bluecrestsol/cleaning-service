<?php

use Illuminate\Database\Seeder;

class FaqSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \DB::table('faq_categories')->truncate();

        foreach (range(1, 4) as $value)
        {
            \DB::table('faq_categories')->insert([
                'uuid' => mt_rand(10000, 99999),
                'country_id' => 1,
                'name' => json_encode(['en' => 'Faq En ' . $value, 'th' => 'Faq TH ' . $value]),
                'status' => 'enabled',
                'type' => 'customer',
                'order' => $value
            ]);
        }

        \DB::table('faq_questions')->truncate();

        foreach (range(1, 10) as $value)
        {
            \DB::table('faq_questions')->insert([
                'uuid' => mt_rand(10000, 99999),
                'faq_category_id' => mt_rand(1, 4),
                'question' => json_encode(['en' => 'Question En ' . $value, 'th' => 'Question TH ' . $value]),
                'answer' => json_encode(['en' => 'Answer EN ' . $value, 'th' => 'Answer TH ' . $value]),
                'status' => 'enabled',
                'order' => $value
            ]);
        }


    }
}
