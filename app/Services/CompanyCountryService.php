<?php

namespace App\Services;
 
use App\Models\Company;
use App\Models\Country;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
 
class CompanyCountryService
{
    protected $model;
    protected $country;

    public function __construct(Company $model, Country $country)
	{
        $this->model = $model;
        $this->country = $country;
    }

    public function list(Request $request, $id)
    {
        $list = $this->getAll($id);
        $records = [
            'data' => $list
        ];
        return $records;
    }

    public function getAll($id)
    {
        return $this->model->find($id)
            ->serviced_countries()
            ->get();
    }

    public function getById($id, $country)
    {
        return $this->model->find($id)
            ->serviced_countries()
            ->where('countries.id', $country)
            ->first();
    }

    public function getFirstCompanyByCountry($id)
    {
        return $this->country->find($id)
            ->companies()
            ->first();
    }

    public function create($id, $data)
    {
        $country = Arr::pull($data, 'country_id');
        return $this->model->find($id)
            ->serviced_countries()
            ->attach($country, $data);
    }

    public function update($id, $country, $data)
    {
        return $this->model->find($id)
            ->serviced_countries()
            ->updateExistingPivot($country, $data);
    }

    public function delete($id, $country)
    {
        return $this->model->find($id)
            ->serviced_countries()
            ->detach($country);
    }

    public function getNotBelongToCompany($id, $except)
    {
        return $this->country->whereDoesntHave('companies', function($q) use ($id, $except) {
                $q->where('companies.id', $id);
                $q->when($except, function($q, $except) {
                    $q->where('company_country.country_id', '!=', $except);
                });
            })
            ->get();
    }
}