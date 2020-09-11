<?php

namespace App\Services;

use App\Models\Company;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;

/**
 * Business logic related to companies
 */
class CompanyService
{
    /**
     * @var Company $model
     */
    protected $model;

    /**
     * Initialization
     *
     * @param Company $model
     */
    public function __construct(Company $model)
	{
        $this->model = $model;
    }

    /**
     * List of companies for table
     *
     * @param Request $request
     * @return array Contains information for building datatable
     */
    public function list(Request $request)
	{
        $orderable = [
            'id',
            'name'
        ];

        $searchable = [
            'name'
        ];

        $result = $this->model
            ->with('country')
            ->with('serviced_countries')
            ->ofDatatable($request, $searchable, $orderable);

        $records = [
            'data' => $result['query']->get(),
            'draw' => intval($request->draw),
            'recordsTotal' => $result['total'],
            'recordsFiltered' => $result['total']
        ];
        return $records;
    }

    /**
     * List of all companies
     *
     * @param array $filter
     * @return Collection<Company>
     */
    public function getAll($filter)
    {
        return $this->model->get();
    }

    /**
     * Get company by ID
     *
     * @param int $id
     * @return Company
     */
    public function getById($id)
    {
        return $this->model
            ->where('id', $id)->first();
    }

    /**
     * Create a company
     *
     * @param array $data
     * @return Company
     */
    public function create($data)
    {
        // pull out relationship datas
        $address = Arr::pull($data, 'address');
        $billing_details = Arr::pull($data, 'billing_details');
        // main logic
        $company = $this->model->create($data);
        $company->address()->create($address);
        // create billing details
        $address = Arr::pull($billing_details, 'address');
        $company->billing_details()->create($billing_details)
            ->address()->create($address);
        return $company;
    }

    /**
     * Update company by ID
     *
     * @param int $id
     * @param array $data
     * @return Company
     */
    public function update($id, $data)
    {
        // pull out relationship datas
        $address = Arr::pull($data, 'address');
        $billing_details = Arr::pull($data, 'billing_details');
        // main logic
        $company = $this->getById($id);
        $company->update($data);
        // update company address
        if (isset($company->address)) {
            $company->address->update($address);
        } else {
            $company->address()->create($address);
        }
        // update billing details
        $address = Arr::pull($billing_details, 'address');
        if (isset($company->billing_details)) {
            $company->billing_details->update($billing_details);
            $company->billing_details->address->update($address);
        } else {
            $company->billing_details()->create($billing_details)
                ->address()->create($address);
        }
        return $company;
    }

    /**
     * Delete company by ID
     *
     * @param int $id
     * @return bool
     */
    public function delete($id)
    {
        return $this->getById($id)->delete();
    }
}
