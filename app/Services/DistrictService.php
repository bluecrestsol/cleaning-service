<?php

namespace App\Services;
 
use App\Models\District;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Arr;
use App\Helpers\LocaleHelper;
 
class DistrictService
{
    protected $model;

    public function __construct(District $model)
	{
        $this->model = $model;
    }

    public function list(Request $request)
	{
        $orderable = [
            'districts.id',
            '$$districts.name',
            '$$cities.name',
            '$$states.name'
        ];

        $searchable = [
            '$$districts.name',
            '$$cities.name',
            '$$states.name'
        ];

        $result = $this->model
            ->select([
                'districts.*',
                DB::raw(LocaleHelper::transColumn('states.name').' AS state'),
                DB::raw(LocaleHelper::transColumn('cities.name').' AS city')
            ])
            ->with('country')
            ->leftJoin('states', 'states.id', 'districts.state_id')
            ->leftJoin('cities', 'cities.id', 'districts.city_id')
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
     * List of all districts
     *
     * @param array $param
     * @return Collection<District>
     */
    public function getAll($param)
    {
        return $this->model
            ->filter($param)
            ->directOrder(Arr::get($param, 'order'))
            ->get();
    }

    /**
     * List of all districts with count
     *
     * @param array $param
     * @return Collection<District>
     */
    public function getAllWithCount($param)
    {
        return $this->model
            ->filter($param)
            ->withCount('serviced_public_listing_places')
            ->directOrder(Arr::get($param, 'order'))
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
        $district = $this->getById($id);
        $district->update($data);
        return $district;
    }

    public function delete($id)
    {
        return $this->getById($id)->delete();
    }
}