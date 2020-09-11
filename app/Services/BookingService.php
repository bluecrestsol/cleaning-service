<?php

namespace App\Services;

use App\Helpers\LocaleHelper;
use App\Models\Booking;
use App\Services\ServiceService;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\DB;

/**
 * Business logic related to bookings
 */
class BookingService
{
    /**
     * @var Booking $model
     * @var ServiceService $serviceService
     */
    protected $model, $serviceService;

    /**
     * Initialization
     *
     * @param Booking $model
     * @param ServiceService $serviceService
     */
    public function __construct(Booking $model, ServiceService $serviceService)
	{
        $this->model = $model;
        $this->serviceService = $serviceService;
    }

    /**
     * List of bookings for table
     *
     * @param Request $request
     * @return array Contains information for building datatable
     */
    public function list(Request $request)
	{
        $orderable = [
            'id',
            'created_at',
            'booked_at',
            'name',
            'business_name',
            null,
            'status'
        ];

        $searchable = [
            'name',
            'business_name',
            null,
            'status'
        ];

        $result = $this->model
            ->select([
                'bookings.*',
                DB::raw(LocaleHelper::transColumn('services.name').' AS service'),
            ])
            ->leftJoin('services', 'services.id', 'bookings.service_id')
            ->filterBy('bookings.company_id', $request->query('company'))
            ->filterBy('bookings.country_id', $request->query('country'))
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
     * List of all bookings
     *
     * @param array $filter
     * @return Collection<Booking>
     */
    public function getAll($filter)
    {
        return $this->model
            ->filterBy('customer_id', Arr::get($filter, 'customer'))
            ->get();
    }

    /**
     * Get booking by ID
     *
     * @param int $id
     * @return Booking
     */
    public function getById($id)
    {
        return $this->model
            ->where('id', $id)->first();
    }

    /**
     * Create a booking
     *
     * @param array $data
     * @return Booking
     */
    public function create($data)
    {
        return $this->model->create($data);
    }

    /**
     * Update booking by ID
     *
     * @param int $id
     * @param array $data
     * @return Booking
     */
    public function update($id, $data)
    {
        $booking = $this->getById($id);
        $booking->update($data);
        return $booking;
    }

    /**
     * Delete booking by ID
     *
     * @param int $id
     * @return bool
     */
    public function delete($id)
    {
        return $this->getById($id)->delete();
    }
}
