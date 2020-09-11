<?php

namespace App\Http\Controllers\Ajax;

use App\Http\Controllers\Controller;
use App\Http\Resources\FaqQuestionCollection;
use App\Services\FaqService;
use Illuminate\Http\Request;
use App\Http\Resources\LocaleCollection;

/**
 * Ajax controller for FAQs category questions
 */
class FaqCategoryQuestionController extends Controller
{
    /**
     * @var FaqService $faqService
     */
    private $faqService;

    /**
     * Initialization
     *
     * @param FaqService $faqService
     */
    public function __construct(FaqService $faqService)
    {
        $this->faqService = $faqService;
    }

    /**
     * Get all faq questions by faq category id
     *
     * @param $category
     * @return \Illuminate\Http\JsonResponse
     */
    public function index(Request $request)
    {
        $request->merge([
            'order' => [
                [
                    'column' => 'order',
                    'dir' => 'asc'
                ]
            ]
        ]);

        $records = $this->faqService->getAll($request->query());

        return (new FaqQuestionCollection($records))
            ->additional(['success' => true]);
    }

    /**
     * List of FAQs category questions for table
     *
     * @param Request $request
     * @param int $category
     * @return \Illuminate\Http\JsonResponse
     */
    public function order(Request $request, $category)
    {
        $records = $this->faqService->updateSequence($category, $request->list);
        return response()->json($records);
    }



}
