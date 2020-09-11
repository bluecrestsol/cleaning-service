<?php

namespace App\Services;
 
use App\Models\Contract;
use App\Services\CountryService;
use App\Traits\HasUniqueCode;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Arr;
 
/**
 * Business logic related to contracts 
 */
class ContractService
{
    use HasUniqueCode;
    
    /**
     * @var Contract $model
     * @var CountryService $countryService
     */
    protected $model, $countryService;

    /**
     * Unique code prefix
     *
     * @var string
     */
    protected $prefixCode = "CO";

    /**
     * Initialization
     *
     * @param Contract $model
     * @param CountryService $countryService
     */
    public function __construct(Contract $model, CountryService $countryService)
	{
        $this->model = $model;
        $this->countryService = $countryService;
    }

    /**
     * List of contracts for table
     *
     * @param Request $request
     * @return array Contains information for building datatable
     */
    public function list(Request $request)
	{
        $orderable = [
            'contracts.id',
            'contracts.code',
            [
                'customers.first_name',
                'customers.middle_name',
                'customers.last_name'
            ],
            'places.name',
            'contracts.started_at',
            'contracts.ended_at',
            'contracts.frequency',
            [
                'contracts.price',
                'contracts.price_unit'
            ]
        ];

        $searchable = [
            'contracts.code',
            'customers.first_name',
            'customers.middle_name',
            'customers.last_name',
            'places.name',
            'contracts.frequency',
            'contracts.price',
            'contracts.price_unit'
        ];

        $result = $this->model
            ->select([
                'contracts.*',
                DB::raw('customers.first_name AS customer_first_name'),
                DB::raw('customers.middle_name AS customer_middle_name'),
                DB::raw('customers.last_name AS customer_last_name'),
                DB::raw('places.name AS place_name'),
                DB::raw('currencies.symbol AS currency_symbol')
            ])
            ->leftJoin('customers', 'customers.id', 'contracts.customer_id')
            ->leftJoin('currencies', 'currencies.id', 'contracts.currency_id')
            ->leftJoin('places', 'places.id', 'contracts.place_id')
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
     * List of all contracts
     *
     * @param array $filter
     * @return Collection<Contract>
     */
    public function getAll($param)
    {
        return $this->model
            ->filter($param)
            ->directOrder(Arr::get($param, 'order'))
            ->get();
    }

    /**
     * Get contract by ID
     *
     * @param int $id
     * @return Contract
     */
    public function getById($id)
    {
        return $this->model
            ->where('id', $id)->first();
    }

    /**
     * Create a contract
     *
     * @param array $data
     * @return Contract
     */
    public function create($data)
    {
        $data['code'] = $this->generateUniqueCodeOnCountry($data['country_id']);
        return $this->model->create($data);
    }

    /**
     * Update contract by ID
     *
     * @param int $id
     * @param array $data
     * @return Contract
     */
    public function update($id, $data)
    {
        $contract = $this->getById($id);
        $contract->update($data);
        return $contract;
    }

    /**
     * Delete contract by ID
     *
     * @param int $id
     * @return bool
     */
    public function delete($id)
    {
        $contract = $this->getById($id);
        if ($contract->appointments()->exists()) {
            return false;
        }
        return $contract->delete();
    }
}