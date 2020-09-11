<?php

namespace App\Http\Controllers\Ajax;

use App\Http\Controllers\Controller;
use App\Services\FaqCategoryService;
use App\Services\LanguageService;
use Illuminate\Http\Request;
use App\Http\Resources\LocaleCollection;

/**
 * Ajax controller for FAQs categories
 */
class FaqCategoryController extends Controller
{
    /**
     * @var FaqCategoryService $faqCategoryService
     * @var LanguageService $languageService
     */
    private $faqCategoryService, $languageService;

    /**
     * Initialization
     *
     * @param FaqCategoryService $faqCategoryService
     * @param LanguageService $languageService
     */
    public function __construct(FaqCategoryService $faqCategoryService, LanguageService $languageService)
    {
        $this->faqCategoryService = $faqCategoryService;
        $this->languageService = $languageService;
    }

    /**
     * List of FAQs categories for table
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function list(Request $request)
    {
        $records = $this->faqCategoryService->list($request);
        $records['data'] = new LocaleCollection($records['data']);
        $records['others'] = [
            'languages_count' => $this->languageService->countPublicActive()
        ];
        return response()->json($records);
    }

    /**
     * Fetch list of FAQs categories
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function fetch(Request $request)
    {
        $request->merge([
            'order' => [
                [
                    'column' => 'order',
                    'dir' => 'asc'
                ]
            ]
        ]);

        $response['success'] = true;
        return (new LocaleCollection($this->faqCategoryService->getAll($request->query())))
            ->additional(['success' => true]);
    }

    /**
     * Update order sequence of FAQs categories
     *
     * @param Request $request
     * @param int $country
     * @return \Illuminate\Http\JsonResponse
     */
    public function order(Request $request, $country)
    {
        $records = $this->faqCategoryService->updateSequence($country, $request->list);
        return response()->json($records);
    }
}
