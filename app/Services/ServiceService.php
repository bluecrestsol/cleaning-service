<?php

namespace App\Services;

use App\Models\Service;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\DB;

/**
 * Business logic related to services
 */
class ServiceService
{
    /**
     * @var Service $model
     */
    protected $model;

    /**
     * Initialization
     *
     * @param Service $model
     */
    public function __construct(Service $model)
	{
        $this->model = $model;
    }

    /**
     * List of services for table
     *
     * @param Request $request
     * @return array Contains information for building datatable
     */
    public function list(Request $request, $searchable, $orderable)
	{
        $result = $this->model
            ->filterBy('company_id', $request->query('company'))
            ->filterBy('country_id', $request->query('country'))
            ->filterBy('status', $request->query('status'))
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
     * List of all services
     *
     * @param array $filter
     * @return Collection<Service>
     */
    public function getAll($filter)
    {
        return $this->model
            ->filterBy('company_id', Arr::get($filter, 'company'))
            ->filterBy('country_id', Arr::get($filter, 'country'))
            ->filterBy('type', Arr::get($filter, 'type'))
            ->filterBy('status', Arr::get($filter, 'status'))
            ->directOrder(Arr::get($filter, 'order'))
            ->get();
    }

    /**
     * Get service by ID
     *
     * @param int $id
     * @return Service
     */
    public function getById($id)
    {
        return $this->model->find($id);
    }

    /**
     * Get services by IDs
     *
     * @param int[] $ids
     * @return Collection<Service>
     */
    public function getByIds($ids)
    {
        return $this->model
            ->whereIn('id', $ids)
            ->get();
    }

    /**
     * Create a service
     *
     * @param array $data
     * @return Service
     */
    public function create($data)
    {
        $data['order'] = $this->model
            ->where('country_id', $data['country_id'])
            ->max('order') + 1;
        return $this->model->create($data);
    }

    /**
     * Update service by ID
     *
     * @param int $id
     * @param array $data
     * @return Service
     */
    public function update($id, $data)
    {
        $service = $this->getById($id);
        $service->update($data);
        return $service;
    }

    /**
     * Delete service by ID
     *
     * @param int $id
     * @return bool
     */
    public function delete($id)
    {
        return $this->model->find($id)->delete();
    }

    /**
     * Update sequence order of specific records
     *
     * @param int $country
     * @param array $list
     * @return void
     */
    public function updateSequence($country, $list) {
        DB::beginTransaction();
        foreach ($list as $item) {
            $this->model->where('id', $item['id'])
                ->where('country_id', $country)
                ->update([
                    'order' => $item['order']
                ]);
        }
        DB::commit();
    }

    /**
     * List of services for table
     *
     * @param Request $request
     * @return array Contains information for building datatable
     */
    public function listWithOrder(Request $request)
    {
        $orderable = [
            'order',
            'type',
            '$$name',
            'price',
            'discounted_price'
        ];

        $searchable = [
            'type',
            '$$name',
            'price',
            'discounted_price'
        ];

        $result = $this->model
            ->filterBy('status', $request->input('status'))
            ->directOrder(Arr::get($request->all(), 'order'))
            ->ofDatatable($request, $searchable, $orderable);

        $records = [
            'data' => $result['query']->get(),
            'draw' => intval($request->draw),
            'recordsTotal' => $result['total'],
            'recordsFiltered' => $result['total']
        ];

        return $records;
    }
}
