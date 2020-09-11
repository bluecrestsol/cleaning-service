<?php

namespace App\Services;
 
use App\Models\Currency;
use Illuminate\Http\Request;
 
class CurrencyService
{
    protected $model;

    public function __construct(Currency $model)
	{
        $this->model = $model;
    }

    public function list(Request $request)
	{
        $orderable = [
            'id',
            'code',
            'name',
            'symbol'
        ];

        $searchable = [
            'code',
            'name',
            'symbol'
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

    public function getAll($filter)
    {
        return $this->model
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
        $currency = $this->getById($id);
        $currency->update($data);
        return $currency;
    }

    public function delete($id)
    {
        return $this->getById($id)->delete();
    }
}