<?php

namespace App\Services;
 
use App\Models\Agent;
use App\Services\CountryService;
use App\Traits\HasUniqueCode;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Str;

/**
 * Business logic related to agents 
 */
class AgentService
{
    use HasUniqueCode;

    /**
     * @var Agent $model
     * @var CountryService $countryService
     */
    protected $model, $countryService;

    /**
     * Unique code prefix
     * 
     * @var string
     */
    protected $prefixCode = "SA";

    /**
     * Initialization
     *
     * @param Agent $model
     * @param CountryService $countryService
     */
    public function __construct(Agent $model, CountryService $countryService)
	{
        $this->model = $model;
        $this->countryService = $countryService;
    }

    /**
     * List of agents for table
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
            'gender',
            'date_of_birth',
            null,
            'type',
            'places_count',
            'status'
        ];

        $searchable = [
            'code',
            'first_name',
            'middle_name',
            'last_name',
            'gender',
            'type',
            'status'
        ];

        $result = $this->model->with('nationality_country')
            ->withCount('places')
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

    /**
     * List of all agents
     *
     * @param array $param
     * @return Collection<Agent>
     */
    public function getAll($param)
    {
        return $this->model
            ->filter($param)
            ->directOrder(Arr::get($param, 'order'))
            ->get();
    }

    /**
     * Get agent by ID
     *
     * @param int $id
     * @return Agent
     */
    public function getById($id)
    {
        return $this->model->find($id);
    }

    /**
     * Get agent by ID with relations
     *
     * @param int $id
     * @param string[] $relations
     * @return Agent
     */
    public function getByIdWith($id, $relations)
    {
        return $this->model
            ->with($relations)
            ->where('id', $id)
            ->first();
    }

    /**
     * Create an agent
     *
     * @param array $data
     * @return Agent
     */
    public function create($data)
    {
        $data['code'] = $this->generateUniqueCodeOnCountry($data['country_id']);
        $data = $this->uploadFiles($data);
        $languages = Arr::pull($data, 'languages', []);
        $agent = $this->model->create($data);
        $agent->languages()->sync($languages);
        return $agent;
    }

    /**
     * Update agent by ID
     *
     * @param int $id
     * @param array $data
     * @return Agent
     */
    public function update($id, $data)
    {
        $data = $this->uploadFiles($data);
        $languages = Arr::pull($data, 'languages', []);
        $agent = $this->getById($id);
        $agent->update($data);
        $agent->languages()->sync($languages);
        return $agent;
    }

    /**
     * Delete agent by ID
     *
     * @param int $id
     * @return bool
     */
    public function delete($id)
    {
        return $this->model->find($id)->delete();
    }

    /**
     * Upload files
     *
     * @param array $data
     * @return array
     */
    public function uploadFiles($data)
    {
        if (Arr::has($data, 'doc_file'))
            $data['doc_file'] = $this->uploadDoc(Arr::pull($data, 'doc_file'));
        if (Arr::has($data, 'photo_file'))
            $data['photo_file'] = $this->uploadPhoto(Arr::pull($data, 'photo_file'), Str::slug($data['first_name'].' '.$data['last_name']));
        return $data;
    }

    /**
     * Upload doc file
     *
     * @param Illuminate\Http\File $file
     * @return string doc file name
     */
    public function uploadDoc($file)
    {
        $name = md5_file($file->getRealPath()).'.'.$file->extension();
        $file->storeAs('docs', $name);
        return $name;
    }

    /**
     * Upload photo file
     *
     * @param Illuminate\Http\File $file
     * @param string $prefix
     * @return string photo file path
     */
    public function uploadPhoto($file, $prefix)
    {
        $folder = 'photos/agents';
        $name = $prefix.'_'.time().'.'.$file->extension();
        $file->storeAs($folder, $name, 'public');
        return $folder.'/'.$name;
    }
}