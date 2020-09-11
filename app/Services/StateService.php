<?php

namespace App\Services;
 
use App\Models\State;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
 
class StateService
{
    protected $model;

    public function __construct(State $model)
	{
        $this->model = $model;
    }

    public function list(Request $request)
	{
        $orderable = [
            'id',
            '$$states.name'
        ];

        $searchable = [
            '$$states.name'
        ];

        $result = $this->model
            ->with('country')
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
            ->filterBy('country_id', Arr::get($filter, 'country'))
            ->orderBy('name')
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
        $state = $this->getById($id);
        $state->update($data);
        return $state;
    }

    public function delete($id)
    {
        return $this->getById($id)->delete();
    }
}