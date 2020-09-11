<?php

namespace App\Services;

use App\Models\Country;
use App\Models\Currency;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Arr;

class CountryCurrencyService
{
    protected $model;
    protected $currency;

    public function __construct(Country $model, Currency $currency)
	{
        $this->model = $model;
        $this->currency = $currency;
    }

   public function list(Request $request, $id)
   {
        $orderable = [
            'currencies.id',
            'currencies.name',
            'country_currency.status',
            'country_currency.is_primary'
        ];

        $searchable = [
            'currencies.name',
            'country_currency.status'
        ];

       $result = $this->model->find($id)
           ->currencies()
           ->select([
                'currencies.*',
                DB::raw('country_currency.status'),
                DB::raw('country_currency.is_primary')
            ])
           ->ofDatatable($request, $searchable, $orderable);

       $records = [
           'data' => $result['query']->get(),
           'draw' => intval($request->draw),
           'recordsTotal' => $result['total'],
           'recordsFiltered' => $result['total']
       ];
       return $records;
   }

   public function getAll($id)
   {
        return $this->model->find($id)
            ->get();
   }

   public function getById($id, $currency)
    {
        return $this->model->find($id)
                ->currencies()
                ->where('currencies.id', $currency)
                ->first();
    }

    public function create($id, $data)
    {
        $currency = Arr::pull($data, 'currency_id');
        return $this->model->find($id)
                ->currencies()
                ->attach($currency, $data);
    }

    public function update($id, $currency, $data)
    {
        return $this->model->find($id)
                ->currencies()
                ->updateExistingPivot($currency, $data);
    }

    public function delete($id, $currency)
    {
        return $this->model->find($id)
                ->currencies()
                ->detach($currency);
    }

   public function getNotBelongToCountry($id, $except)
    {
        return $this->currency->whereDoesntHave('countries', function($q) use ($id, $except) {
                $q->where('countries.id', $id);
                $q->when($except, function($q, $except) {
                    $q->where('country_currency.currency_id', '!=', $except);
                });
            })
            ->get();
    }
}
