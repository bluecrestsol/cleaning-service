<?php

namespace App\Services;
 
use App\Models\Customer;
use App\Services\CountryService;
use App\Traits\HasUniqueCode;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Arr;
 
class CustomerService
{
    use HasUniqueCode;

    protected $model;
    protected $countryService;
    protected $prefixCode = "C";

    public function __construct(Customer $model, CountryService $countryService)
	{
        $this->model = $model;
        $this->countryService = $countryService;
    }

    public function list(Request $request)
	{
        $orderable = [
            'customers.id',
            'code',
            [
                'first_name',
                'last_name'
            ],
            'business_name',
            null,
            'places_count'
        ];

        $searchable = [
            'code',
            'first_name',
            'last_name',
            'business_name'
        ];

        $result = $this->model
            ->select([
                'customers.*',
                DB::raw('companies.name AS company_name')
            ])
            ->withCount('places')
            ->withCount('notes')
            ->leftJoin('companies', 'companies.id', 'customers.company_id')
            ->filterBy('customers.company_id', $request->query('company'))
            ->filterBy('customers.country_id', $request->query('country'))
            ->ofDatatable($request, $searchable, $orderable);

        $records = [
            'data' => $result['query']->get(),
            'draw' => intval($request->draw),
            'recordsTotal' => $result['total'],
            'recordsFiltered' => $result['total']
        ];

        return $records;
    }

    public function getAll($filter)
    {
        return $this->model
            ->filterBy('code', Arr::get($filter, 'code'))
            ->filterBy('company_id', Arr::get($filter, 'company'))
            ->filterBy('country_id', Arr::get($filter, 'country'))
            ->get();
    }

    public function getById($id)
    {
        return $this->model
            ->where('id', $id)->first();
    }

    public function getBillingDetailsById($id)
    {
        return $this->model
            ->where('id', $id)->first()
            ->billing_details()->with('address')
            ->first();
    }

    public function create($data)
    {
        $address = Arr::pull($data, 'billing_details.address');
        $billing_details = Arr::pull($data, 'billing_details');

        $data['code'] = $this->generateUniqueCodeOnCountry($data['country_id']);
        $customer = $this->model->create($data);
        $customer->billing_details()->create($billing_details)
            ->address()->create($address);
        return $customer;
    }

    public function update($id, $data)
    {
        $address = Arr::pull($data, 'billing_details.address');
        $billing_details = Arr::pull($data, 'billing_details');

        $customer = $this->getById($id);
        $customer->update($data);

        $customer->billing_details->update($billing_details);
        $customer->billing_details->address->update($address);
        return $customer;
    }

    /**
     * Delete customer by ID
     *
     * @param int $id
     * @return bool
     */
    public function delete($id)
    {
        $customer = $this->getById($id);
        if ($customer->places()->exists()) {
            return false;
        }
        return $customer->delete();
    }
}