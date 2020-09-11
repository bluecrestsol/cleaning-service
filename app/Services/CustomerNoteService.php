<?php

namespace App\Services;
 
use App\Models\Customer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Arr;

/**
 * Business logic related to customers notes 
 */
class CustomerNoteService
{
    /**
     * @var Customer $model
     */
    protected $model;

    /**
     * Initialization
     *
     * @param Customer $model
     */
    public function __construct(Customer $model)
	{
        $this->model = $model;
    }

    /**
     * List of customers notes for table
     *
     * @param int $id
     * @param Request $request
     * @return array Contains information for building datatable
     */
    public function list($id, Request $request)
	{
        $orderable = [
            'notes.id',
            'notes.created_at',
            [
                'admins.first_name',
                'admins.last_name'
            ],
            'notes.message'
        ];

        $searchable = [
            'admins.first_name',
            'admins.last_name',
            'notes.message'
        ];

        $result = $this->model->find($id)
            ->notes()
            ->select([
                'notes.*',
                DB::raw('admins.first_name AS admin_first_name'),
                DB::raw('admins.last_name AS admin_last_name')
            ])
            ->leftJoin('admins', 'admins.id', 'notes.admin_id')
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
     * Get customer note by ID
     *
     * @param int $id
     * @param int $note
     * @return void
     */
    public function getById($id, $note)
    {
        return $this->model->find($id)
            ->notes()
            ->where('notes.id', $note)
            ->first();
    }

    /**
     * Create a customer note
     *
     * @param int $id
     * @param array $data
     * @return void
     */
    public function create($id, $data)
    {
        $data['admin_id'] = app('shared')->get('admin')->id;
        return $this->model->find($id)
            ->notes()
            ->create($data);
    }

    /**
     * Delete customer note by ID
     *
     * @param int $id
     * @param int $language
     * @return bool
     */
    public function delete($id, $note)
    {
        return $this->model->find($id)
            ->notes()
            ->find($note)
            ->delete();
    }
}