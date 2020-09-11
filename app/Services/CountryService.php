<?php

namespace App\Services;

use App\Models\Country;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Arr;

class CountryService
{
    protected $model;

    public function __construct(Country $model)
	{
        $this->model = $model;
    }

    public function list(Request $request)
	{
        $list = $this->model
            ->with('languages')
            ->with('currency')
            ->get();

        $records = [
            'data' => $list
        ];
        return $records;
    }

    public function getAll($filter)
    {
        return $this->model
            ->filterBy('status', Arr::get($filter, 'status'))
            ->directOrder(Arr::get($filter, 'order'))
            ->get();
    }

    public function getById($id)
    {
        return $this->model
            ->where('id', $id)->first();
    }

    public function getByCode($code)
    {
        return $this->model
            ->where('code', $code)->first();
    }

    public function getAvailable()
    {
        return $this->model
            ->onlyActive()
            ->with('public_active_languages')
            ->get();
    }

    public function getActive()
    {
        return $this->model
            ->onlyActive()
            ->get();
    }

    public function getDraft()
    {
        return $this->model
            ->onlyActive()
            ->orderBy('status', 'desc')
            ->get();
    }

    public function getActiveWhereHasStates()
    {
        return $this->model
            ->onlyActive()
            ->whereHasStates()
            ->get();
    }

    public function getActiveWhereHasCities()
    {
        return $this->model
            ->onlyActive()
            ->whereHasCities()
            ->get();
    }

    public function getActiveWhereHasDistricts()
    {
        return $this->model
            ->onlyActive()
            ->whereHasDistricts()
            ->get();
    }

    public function create($data)
    {
        return $this->model->create($data);
    }

    public function update($id, $data)
    {
        $country = $this->getById($id);
        $country->update($data);
        return $country;
    }

    public function delete($id)
    {
        return $this->getById($id)->delete();
    }
}
