<?php

namespace App\Http\Controllers\Ajax;

use App\Http\Controllers\Controller;
use App\Http\Requests\ContactStoreRequest;
use App\Services\ContactRequestService;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class ContactRequestController extends Controller
{
    /**
     * @var ContactRequestService
     */
    private $contactRequestService;

    public function __construct(ContactRequestService $contactRequestService)
    {
        $this->contactRequestService = $contactRequestService;
    }

    public function index()
    {
        return view('customer.contact.index');
    }

    public function store(ContactStoreRequest $request)
    {
        $this->contactRequestService->create($request->validated());
        return response()->json([ 'success' => true ]);
    }

    /**
     * List of contact requests for table
     *
     * @param Illuminate\Http\Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function list(Request $request)
    {
        $searchable = ['name', 'message', 'status'];
        $orderable = ['id', 'created_at', 'name', 'message', 'status'];
        $records = $this->contactRequestService->list($request, $searchable, $orderable);
        $records['data']->transform(function($item) {
            $item->message = clean($item->message, 64);
            return $item;
        });
        return response()->json($records);
    }
}
