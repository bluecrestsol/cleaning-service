<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\ContactStoreRequest;
use App\Http\Resources\BaseJsonResource;
use App\Http\Resources\ContactRequestResource;
use App\Services\ContactRequestService;
use Illuminate\Http\Request;

class ContactRequestController extends Controller
{
    /**
     * @var ContactRequestService
     */
    private $contactRequestService;

    /**
     * Initialization
     * 
     * @param App\Services\ContactRequestService $contactRequestService
     */
    public function __construct(ContactRequestService $contactRequestService)
    {
        $this->contactRequestService = $contactRequestService;
    }

    /**
     * Store a contact request
     *
     * @param App\Http\Requests\Api\ContactStoreRequest $request
     * @return App\Http\Resources\ContactRequestResource
     */
    public function store(ContactStoreRequest $request, $company)
    {
        $data = array_merge($request->validated(), ['company_id' => $company]);
        return (new BaseJsonResource(
            ContactRequestResource::class,
            $this->contactRequestService->create($data))
        )->run();
    }
}
