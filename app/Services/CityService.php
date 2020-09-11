<?php

namespace App\Services;

use App\Models\City;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Arr;
use App\Helpers\LocaleHelper;

class CityService
{
    protected $model;

    public function __construct(City $model)
	{
        $this->model = $model;
    }

    public function list(Request $request)
	{
        $orderable = [
            'cities.id',
            '$$cities.name',
            '$$states.name'
        ];

        $searchable = [
            '$$cities.name',
            '$$states.name'
        ];

        $result = $this->model
            ->select([
                'cities.*',
                DB::raw(LocaleHelper::transColumn('states.name').' AS state'),
            ])
            ->with('country')
            ->leftJoin('states', 'states.id', 'cities.state_id')
            ->ofDatatable($request, $searchable, $orderable);

        $records = [
            'data' => $result['query']->get(),
            'draw' => intval($request->draw),
            'recordsTotal' => $result['total'],
            'recordsFiltered' => $result['total']
        ];
        return $records;
    }

    public function getAll($param)
    {
        return $this->model
            ->filter($param)
            ->get();
    }

    public function getServicedWithDistricts($param)
    {
        return $this->model
            ->with(['districts' => function($query) {
                $query->withCount('serviced_public_listing_places');
            }])
            ->filter($param)
            ->get();
    }

    public function getById($id)
    {
        return $this->model
            ->where('id', $id)->first();
    }

    public function create($data)
    {
        return $this->model->create($data);
    }

    public function update($id, $data)
    {
        $city = $this->getById($id);
        $city->update($data);
        return $city;
    }

    public function delete($id)
    {
        return $this->getById($id)->delete();
    }
}
