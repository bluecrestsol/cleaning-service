<?php

use Illuminate\Database\Seeder;
use App\Models\Customer;
use App\Models\BillingDetail;
use App\Models\Address;

class CustomerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(Customer::class, 5)->create()->each(function($customer) {
            $address = factory(Address::class)->make();
            $billingDetails = factory(BillingDetail::class)->make();

            $customer->billing_details()->save($billingDetails);
            $billingDetails->address()->save($address);
        });
    }
}
