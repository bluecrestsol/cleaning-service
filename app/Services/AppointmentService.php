<?php

namespace App\Services;

use App\Models\Appointment;
use App\Models\CrewMember;
use App\Services\CountryService;
use App\Services\PlaceService;
use App\Traits\HasUniqueCode;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Arr;
use App\Helpers\LocaleHelper;
use App\Events\AppointmentMade;
use Carbon\Carbon;

/**
 * Business logic related to appointments
 */
class AppointmentService
{
    use HasUniqueCode;

    /**
     * @var Appointment $model
     * @var CountryService $countryService
     * @var PlaceService $placeService
     */
    protected $model, $countryService, $placeService;

    /**
     * Unique code prefix
     *
     * @var string
     */
    protected $prefixCode = "A";

    /**
     * Initialization
     *
     * @param Appointment $model
     * @param CountryService $countryService
     * @param PlaceService $placeService
     */
    public function __construct(Appointment $model, CountryService $countryService, PlaceService $placeService)
	{
        $this->model = $model;
        $this->countryService = $countryService;
        $this->placeService = $placeService;
    }

    /**
     * List of appointments for table
     *
     * @param Request $request
     * @return array Contains information for building datatable
     */
    public function list(Request $request)
	{
        $orderable = [
            'appointments.created_at',
            'appointments.code',
            'places.name',
            '$$places_categories.name',
            [
                '$$cities.name',
                '$$districts.name'
            ],
            'places.area',
            [
                'crew_members.first_name',
                'crew_members.middle_name',
                'crew_members.last_name'
            ],
            'crew_members_count',
            'scheduled_at',
            'serviced_at',
            'appointments.status',
        ];

        $searchable = [
            'appointments.code',
            'places.name',
            '$$places_categories.name',
            '$$cities.name',
            '$$districts.name',
            'places.area',
            'crew_members.first_name',
            'crew_members.middle_name',
            'crew_members.last_name',
            'scheduled_at',
            'serviced_at',
            'appointments.status',
        ];

        $members = CrewMember::joinAppointment();
        $leaders = CrewMember::joinAppointmentLeaders();
        $result = $this->model
            ->leftJoin('places', 'places.id', 'appointments.place_id')
            ->leftJoin('places_categories', 'places_categories.id', 'places.places_category_id')
            ->leftJoin('cities', 'cities.id', 'places.city_id')
            ->leftJoin('districts', 'districts.id', 'places.district_id')
            ->leftJoin(DB::raw('('.$members->toSql().') AS c_members'), function($join) use ($members) {
                $join->on('appointments.id', 'c_members.appointment_id');
                $join->bindings = array_merge($join->bindings, $members->getBindings());
            })
            ->leftJoin(DB::raw('('.$leaders->toSql().') AS crew_leaders'), function($join) use ($leaders) {
                $join->on('appointments.id', 'crew_leaders.appointment_id');
                $join->bindings = array_merge($join->bindings, $leaders->getBindings());
            })
            ->select([
                'appointments.id',
                'appointments.code',
                'appointments.status',
                'appointments.scheduled_at',
                'appointments.serviced_at',
                DB::raw('places.name AS place_name'),
                DB::raw(LocaleHelper::transColumn('places_categories.name').' AS place_category'),
                DB::raw('places.area AS area'),
                DB::raw(LocaleHelper::transColumn('cities.name').' AS city'),
                DB::raw(LocaleHelper::transColumn('districts.name').' AS district'),
                DB::raw('crew_leaders.first_name AS crew_member_leader_first_name'),
                DB::raw('crew_leaders.middle_name AS crew_member_leader_middle_name'),
                DB::raw('crew_leaders.last_name AS crew_member_leader_last_name'),
            ])
            ->withCount('crew_members')
            ->filterBy('place_id', $request->query('place'))
            ->filterBy('c_members.id', $request->query('crew_member'))
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
     * List of service history for table
     *
     * @param Request $request
     * @return array Contains information for building datatable
     */
    public function listServiceHistory(Request $request)
	{
        $orderable = ['serviced_at', null];
        $result = $this->model
            ->with('services')
            ->filterBy('place_id', $request->query('place'))
            ->filterBy('status', $request->query('status'))
            ->ofDatatable($request, [], $orderable);
        $records = [
            'data' => $result['query']->get(),
            'draw' => intval($request->draw),
            'recordsTotal' => $result['total'],
            'recordsFiltered' => $result['total']
        ];
        return $records;
    }

    /**
     * List of all appointments
     *
     * @param array $filter
     * @return Collection<Appointment>
     */
    public function getAll($filter = [])
    {
        return $this->model->get();
    }

    /**
     * List of all appointments with public services by company and country
     *
     * @return Collection<Appointment>
     */
    public function getWithPublicServices($company = null, $country = null, $order = null)
    {
        return $this->model
            ->hasPublicListingPlace()
            ->isServiceOnCompanyAndCountry($company, $country)
            ->with(['place', 'place.city', 'place.district', 'services'])
            ->filterBy('status', request()->query('status'))
            ->orderBy('serviced_at', 'DESC')
            ->directOrder($order)
            ->get();
    }

    /**
     * List of service history
     *
     * @param int $place
     * @return Collection<Appointment>
     */
    public function getServiceHistory($place)
    {
        return $this->model
            ->with('services')
            ->filterBy('place_id', $place)
            ->where('status', 'completed')
            ->get();
    }

    /**
     * Get appointment by ID
     *
     * @param int $id
     * @return Appointment
     */
    public function getById($id)
    {
        return $this->model
            ->where('id', $id)->first();
    }

    /**
     * Get appointment by ID with relations
     *
     * @param int $id
     * @param string[] $relations
     * @return Appointment
     */
    public function getByIdWith($id, $relations)
    {
        return $this->model
            ->with($relations)
            ->where('id', $id)
            ->first();
    }

    /**
     * Create an appointment
     *
     * @param array $data
     * @return Appointment
     */
    public function create($data)
    {
        $data['code'] = $this->generateUniqueCodeOnCountry($data['country_id']);
        $data['admin_id'] = app('shared')->get('admin')->id;
        $data = $this->handleData($data);
        // get agent of place
        $place = $this->placeService->getById($data['place_id']);
        $data['agent_id'] = $place->agent_id;
        // pull out relationship datas
        $services = Arr::pull($data, 'services');
        $crew = Arr::pull($data, 'crew_members');
        // main logic
        $appointment = $this->model->create($data);
        $appointment->services()->sync($services);
        $appointment->crew_members()->sync($crew);
        event(new AppointmentMade($appointment));
        return $appointment;
    }

    /**
     * Update appointment by ID
     *
     * @param int $id
     * @param array $data
     * @return Appointment
     */
    public function update($id, $data)
    {
        $data = $this->handleData($data);
        $services = Arr::pull($data, 'services');
        $crew = Arr::pull($data, 'crew_members');
        $appointment = $this->getById($id);
        $appointment->update($data);
        $appointment->services()->sync($services);
        $appointment->crew_members()->sync($crew);
        event(new AppointmentMade($appointment));
        return $appointment;
    }

    /**
     * Data handling before action
     *
     * @param array $data
     * @return array
     */
    private function handleData($data)
    {
        $country = $this->countryService->getById($data['country_id']);
        $timezone = getTimeZoneByCountry($country->code);
        // forget unnecessary values
        Arr::forget($data, 'customer');
        Arr::forget($data, 'country_id');
        // format crew members
        $crew = Arr::pull($data, 'crew');
        $data['crew_members'] = [
            $crew['leader'] => [ 'is_leader' => 1 ]
        ];
        if (isset($crew['members'])) {
            foreach ($crew['members'] as $key => $member) {
                $data['crew_members'][$member] = [
                    'is_leader' => 0
                ];
            }
        }
        // convert dates
        $data['ordered_at'] = toUtc($data['ordered_at'], $timezone[0]);
        $data['scheduled_at'] = toUtc($data['scheduled_at'], $timezone[0]);
        $data['serviced_at'] = toUtc($data['serviced_at'], $timezone[0]);
        return $data;
    }

    /**
     * Delete appointment by ID
     *
     * @param int $id
     * @return bool
     */
    public function delete($id)
    {
        return $this->getById($id)->delete();
    }

    /**
     * Get maximum value of serviced_at by place
     *
     * @param int $place
     * @return string
     */
    public function getLatestServicedAtByPlace($place)
    {
        return $this->model->where('place_id', $place)->max('serviced_at');
    }
}
