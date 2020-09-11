<?php

namespace App\Services;

use App\Models\ContactRequest;

class ContactRequestService
{
    protected $model;

    public function __construct(ContactRequest $model)
    {
        $this->model = $model;
    }

    /**
     * List of contact requests for table
     *
     * @param Illuminate\Http\Request $request
     * @param array $searchable
     * @param array $orderable
     * @return array Contains information for building datatable
     */
    public function list($request, $searchable, $orderable)
	{
        $result = $this->model
            ->ofDatatable($request, $searchable, $orderable);
        $records = [
            'data' => $result['query']->get(),
            'draw' => intval($request->draw),
            'recordsTotal' => $result['total'],
            'recordsFiltered' => $result['total']
        ];
        return $records;
    }

    public function getById($id)
    {
        return $this->model
            ->where('id', $id)->first();
    }

    public function create($data): ContactRequest
    {
        $data['status'] = 'new';
        $data['message'] = nl2br($data['message']);
        return $this->model->create($data);
        
    }

    /**
     * Update contact request by ID
     */
    public function update(int $id, array $data): ContactRequest
    {
        $contact = $this->getById($id);
        $contact->update($data);
        return $contact;
    }

    public function delete($id)
    {
        return $this->getById($id)->delete();
    }
}
