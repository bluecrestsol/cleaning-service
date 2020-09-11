<?php

namespace App\Services;
 
use App\Models\CrewMember;
use App\Services\CountryService;
use App\Traits\HasUniqueCode;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Str;
 
class CrewMemberService
{
    use HasUniqueCode;

    protected $model;
    protected $countryService;
    protected $prefixCode = "M";

    public function __construct(CrewMember $model, CountryService $countryService)
	{
        $this->model = $model;
        $this->countryService = $countryService;
    }

    /**
     * List of crew members for table
     *
     * @param Request $request
     * @return array Contains information for building datatable
     */
    public function list(Request $request)
	{
        $orderable = [
            'id',
            'code',
            [
                'first_name',
                'middle_name',
                'last_name'
            ],
            'position',
            'gender',
            'date_of_birth',
            null,
            'type',
            'appointments_count',
            'status'
        ];

        $searchable = [
            'code',
            'first_name',
            'middle_name',
            'last_name',
            'position',
            'gender',
            'type',
            'status'
        ];

        $result = $this->model->with('nationality_country')
            ->withCount('appointments')
            ->filterBy('company_id', $request->query('company'))
            ->filterBy('country_id', $request->query('country'))
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
            ->filterBy('company_id', $filter['company'])
            ->filterBy('country_id', $filter['country'])
            ->directOrder(Arr::get($filter, 'order'))
            ->get();
    }

    public function getById($id)
    {
        return $this->model->find($id);
    }

    public function getByIdWith($id, $relations)
    {
        return $this->model
            ->with($relations)
            ->where('id', $id)
            ->first();
    }

    public function create($data)
    {
        $data['code'] = $this->generateUniqueCodeOnCountry($data['country_id']);
        $data = $this->uploadFiles($data);
        $languages = Arr::pull($data, 'languages', []);
        $crewMember = $this->model->create($data);
        $crewMember->languages()->sync($languages);
        return $crewMember;
    }

    public function update($id, $data)
    {
        $data = $this->uploadFiles($data);
        $languages = Arr::pull($data, 'languages', []);
        $crewMember = $this->getById($id);
        $crewMember->update($data);
        $crewMember->languages()->sync($languages);

        return $crewMember;
    }

    public function delete($id)
    {
        return $this->model->find($id)->delete();
    }

    public function uploadFiles($data)
    {
        if (Arr::has($data, 'doc_file'))
            $data['doc_file'] = $this->uploadDoc(Arr::pull($data, 'doc_file'));
        if (Arr::has($data, 'photo_file'))
            $data['photo_file'] = $this->uploadPhoto(Arr::pull($data, 'photo_file'), Str::slug($data['first_name'].' '.$data['last_name']));
        return $data;
    }

    public function uploadDoc($file)
    {
        $name = md5_file($file->getRealPath()).'.'.$file->extension();
        $file->storeAs('docs', $name);
        return $name;
    }

    public function uploadPhoto($file, $prefix)
    {
        $folder = 'photos/crew_members';
        $name = $prefix.'_'.time().'.'.$file->extension();
        $file->storeAs($folder, $name, 'public');
        return $folder.'/'.$name;
    }
}