<?php

namespace App\Services;

use App\Models\Place;
use App\Services\CountryService;
use App\Traits\HasUniqueCode;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Arr;
use App\Helpers\LocaleHelper;

/**
 * Business logic related to places
 */
class PlaceService
{
    use HasUniqueCode;

    /**
     * @var Place $model
     * @var CountryService $countryService
     */
    protected $model, $countryService;

     /**
     * Unique code prefix
     *
     * @var string
     */
    protected $prefixCode = "P";

    /**
     * Initialization
     *
     * @param Place $model
     * @param CountryService $countryService
     */
    public function __construct(Place $model, CountryService $countryService)
	{
        $this->model = $model;
        $this->countryService = $countryService;
    }

    /**
     * List of places for table
     *
     * @param Request $request
     * @return array Contains information for building datatable
     */
    public function list(Request $request)
	{
        $orderable = [
            'places.id',
            'places.code',
            'places.name',
            'places.type',
            '$$places_categories.name',
            'places.area',
            '$$states.name',
            '$$cities.name',
            '$$districts.name',
            'places.financial_type',
            [
                'customers.first_name',
                'customers.last_name'
            ],
            'appointments_count',
            'places.status'
        ];

        $searchable = [
            'places.code',
            'places.name',
            'places.type',
            '$$places_categories.name',
            'places.area',
            '$$states.name',
            '$$cities.name',
            '$$districts.name',
            'places.financial_type',
            'customers.first_name',
            'customers.last_name',
            'places.status'
        ];

        $result = $this->model
            ->select([
                'places.*',
                DB::raw('customers.first_name AS customer_first_name'),
                DB::raw('customers.last_name AS customer_last_name'),
                DB::raw(LocaleHelper::transColumn('places_categories.name').' AS category_name'),
                DB::raw(LocaleHelper::transColumn('states.name').' AS state_name'),
                DB::raw(LocaleHelper::transColumn('cities.name').' AS city_name'),
                DB::raw(LocaleHelper::transColumn('districts.name').' AS district_name')
            ])
            ->withCount('appointments')
            ->leftJoin('customers', 'customers.id', 'places.customer_id')
            ->leftJoin('places_categories', 'places_categories.id', 'places.places_category_id')
            ->leftJoin('states', 'states.id', 'places.state_id')
            ->leftJoin('cities', 'cities.id', 'places.city_id')
            ->leftJoin('districts', 'districts.id', 'places.district_id')
            ->filterBy('customer_id', $request->query('customer'))
            ->filterBy('agent_id', $request->query('agent'))
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
     * List of all places
     *
     * @param array $param
     * @return Collection<Place>
     */
    public function getAll($param)
    {
        return $this->model
            ->with('country')
            ->with('category')
            ->filter($param)
            ->directOrder(Arr::get($param, 'order'))
            ->get();
    }

    /**
     * List of all serviced places
     *
     * @param int $id
     * @param array $param
     * @return Collection<Place>
     */
    public function getAllServiced($param)
    {
        return $this->model
            ->publicListing()
            ->serviced()
            ->filter($param)
            ->directOrder(Arr::get($param, 'order'))
            ->get();
    }

    /**
     * Get place by ID
     *
     * @param int $id
     * @return Place
     */
    public function getById($id)
    {
        return $this->model
            ->where('id', $id)->first();
    }

    /**
     * Get place by code
     *
     * @param array $filter
     * @return Collection<Place>
     */
    public function getByCode($code)
    {
        return $this->model
            ->where('code', $code)->first();
    }

    /**
     * Create a place
     *
     * @param array $data
     * @return Place
     */
    public function create($data)
    {
        $data['code'] = $this->generateUniqueCodeOnCountry($data['country_id']);
        $address = Arr::pull($data, 'address');
        $billing_details = Arr::pull($data, 'billing_details');
        $place = $this->model->create($data);
        // address
        $place->address()->create($address);
        // billing details
        if (!empty($billing_details)) {
            $address = Arr::pull($billing_details, 'address');
            $place->billing_details()->create($billing_details)
                ->address()->create($address);
        }
        return $place;
    }

    /**
     * Update place by ID
     *
     * @param int $id
     * @param array $data
     * @return Place
     */
    public function update($id, $data)
    {
        $address = Arr::pull($data, 'address');
        $billing_details = Arr::pull($data, 'billing_details');
        $place = $this->getById($id);
        $place->update($data);
        // address
        if (isset($place->address)) {
            $place->address->update($address);
        } else {
            $place->address()->create($address);
        }
        // billing details
        if (!empty($billing_details)) {
            $address = Arr::pull($billing_details, 'address');
            if (isset($place->billing_details)) {
                $place->billing_details->update($billing_details);
                $place->billing_details->address->update($address);
            } else {
                $place->billing_details()->create($billing_details)
                    ->address()->create($address);
            }
        } else {
            optional($place->billing_details)->delete();
        }

        return $place;
    }

    /**
     * Data handling before action
     *
     * @param array $data
     * @return array
     */
    public function delete($id)
    {
        $place = $this->getById($id);
        if ($place->contracts()->exists() || $place->appointments()->exists()) {
            return false;
        }
        return $place->delete();
    }

    /**
     * Update place's last serviced
     *
     * @param int $id
     * @param string $serviced_at
     * @return bool
     */
    public function updateLastServicedById($id, $serviced_at)
    {
        return $this->model->find($id)
            ->update(['last_serviced_at' => $serviced_at]);
    }
}
