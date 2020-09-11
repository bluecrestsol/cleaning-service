<?php

namespace App\Services;

use App\Models\Country;
use App\Models\Language;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Arr;

class CountryLanguageService
{
    protected $model;
    protected $language;

    public function __construct(Country $model, Language $language)
    {
        $this->model = $model;
        $this->language = $language;
    }

    public function list(Request $request, $id)
    {
        $orderable = [
            'languages.id',
            [
                'languages.english_name',
                'languages.name'
            ],
            'country_language.status',
            'country_language.is_primary'
        ];

        $searchable = [
            'languages.english_name',
            'languages.name',
            'country_language.status'
        ];

        $result = $this->model->find($id)
            ->languages()
            ->select([
                'languages.*',
                DB::raw('country_language.status'),
                DB::raw('country_language.is_primary')
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

    public function getAll($id, $filter)
    {
        return $this->model->find($id)
            ->languages()
            ->filterBy('country_language.country_id', Arr::get($filter, 'country'))
            ->filterBy('country_language.status', Arr::get($filter, 'status'))
            ->orderBy('english_name')
            ->orderBy('name')
            ->get();
    }

    public function getById($id, $language)
    {
        return $this->model->find($id)
            ->languages()
            ->where('languages.id', $language)
            ->first();
    }

    public function getByCode($id, $code)
    {
        return $this->model->find($id)
            ->languages()
            ->where('code', $code)
            ->first();
    }

    public function create($id, $data)
    {
        $language = Arr::pull($data, 'language_id');
        return $this->model->find($id)
            ->languages()
            ->attach($language, $data);
    }

    public function update($id, $language, $data)
    {
        return $this->model->find($id)
            ->languages()
            ->updateExistingPivot($language, $data);
    }

    public function delete($id, $language)
    {
        return $this->model->find($id)
            ->languages()
            ->detach($language);
    }

    public function getNotBelongToCountry($id, $except)
    {
        return $this->language->whereDoesntHave('countries', function ($q) use ($id, $except) {
            $q->where('countries.id', $id);
            $q->when($except, function ($q, $except) {
                $q->where('country_language.language_id', '!=', $except);
            });
        })
            ->get();
    }
}
