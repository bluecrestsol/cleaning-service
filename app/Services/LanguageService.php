<?php

namespace App\Services;
 
use App\Models\Language;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
 
class LanguageService
{
    protected $model;

    public function __construct(Language $model)
	{
        $this->model = $model;
    }

    public function list(Request $request)
	{
        $orderable = [
            'id',
            'code',
            'name',
            'english_name',
            'countries_count',
            'status_public',
            'status_staff'
        ];

        $searchable = [
            'code',
            'name',
            'english_name'
        ];

        $result = $this->model
            ->withCount('countries')
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
            ->filterBy('status_public', Arr::get($filter, 'status_public'))
            ->filterBy('status_crew', Arr::get($filter, 'status_crew'))
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

    public function getStaffEnabled()
    {
        return $this->model
            ->ofStaffEnabled()
            ->get();
    }

    public function getPublicActive()
    {
        return $this->model
            ->ofPublicActive()
            ->get();
    }

    public function create($data)
    {
        return $this->model->create($data);
    }

    public function update($id, $data)
    {
        $language = $this->getById($id);
        $language->update($data);
        return $language;
    }

    public function delete($id)
    {
        return $this->getById($id)->delete();
    }

    public function countPublicActive()
    {
        return $this->model->ofPublicActive()->count();
    }
}