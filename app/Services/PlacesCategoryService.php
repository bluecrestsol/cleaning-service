<?php

namespace App\Services;

use App\Models\PlacesCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;

/**
 * Business logic related to places category 
 */
class PlacesCategoryService
{
    /**
     * @var PlacesCategory $model
     */
    protected $model;

     /**
     * Initialization
     *
     * @param PlacesCategory $model
     */
    public function __construct(PlacesCategory $model)
	{
        $this->model = $model;
    }

    /**
     * List of places category for table
     *
     * @param Request $request
     * @return array Contains information for building datatable
     */
    public function list(Request $request)
	{
        $orderable = [
            'id',
            '$$name',
            'type'
        ];

        $searchable = [
            '$$name',
            'type'
        ];

        $result = $this->model
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
     * List of all places category
     *
     * @param array $filter
     * @return Collection<PlacesCategory>
     */
    public function getAll($filter)
    {
        return $this->model
            ->filterBy('type', Arr::get($filter, 'type'))
            ->directOrder(Arr::get($filter, 'order'))
            ->get();
    }

    /**
     * Get places category by ID
     *
     * @param int $id
     * @return PlacesCategory
     */
    public function getById($id)
    {
        return $this->model
            ->where('id', $id)->first();
    }

    /**
     * Create a places category
     *
     * @param array $data
     * @return PlacesCategory
     */
    public function create($data)
    {
        return $this->model->create($data);
    }

     /**
     * Update places category by ID
     *
     * @param int $id
     * @param array $data
     * @return PlacesCategory
     */
    public function update($id, $data)
    {
        $placesCategory = $this->getById($id);
        $placesCategory->update($data);
        return $placesCategory;
    }

    /**
     * Delete places category by ID
     *
     * @param int $id
     * @return bool
     */
    public function delete($id)
    {
        return $this->getById($id)->delete();
    }

}
