<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Resources\Api\V1\LanguageCollection;
use App\Http\Resources\BaseJsonResource;
use App\Http\Resources\Api\V1\LanguageResource;
use App\Services\LanguageService;
use Illuminate\Http\Request;

/**
 * Api controller for languages
 */
class LanguageController extends Controller
{
    /**
     * @var App\Services\LanguageService $languageService
     */
    protected $languageService;
    
    /**
     * Initialization
     * 
     * @param App\Services\LanguageService $languageService
     */
    public function __construct(LanguageService $languageService)
    {
        $this->languageService = $languageService;
    }

    /**
     * Get list of languages
     *
     * @param Request $request
     * @return App\Http\Resources\Api\V1\LanguageCollection
     */
    public function index(Request $request)
    {
        return (new LanguageCollection($this->languageService->getAll($request->query())));
    }

    /**
     * Get language by ID
     *
     * @param Request $request
     * @return App\Http\Resources\Api\V1\LanguageResource
     */
    public function get(Request $request, $id)
    {
        return (new BaseJsonResource(
            LanguageResource::class,
            $this->languageService->getById($id))
        )->run();
    }

    /**
     * Get language by code
     *
     * @param Request $request
     * @return App\Http\Resources\Api\V1\LanguageResource
     */
    public function getByCode(Request $request, $code)
    {
        return (new BaseJsonResource(
            LanguageResource::class,
            $this->languageService->getByCode($code))
        )->run();
    }
}
