<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Admin\BaseController;
use App\Services\FaqCategoryService;
use App\Services\FaqService;
use App\Services\LanguageService;
use App\Http\Requests\FaqStoreRequest;

/**
 * Ajax controller for FAQs category questions
 */
class FaqCategoryQuestionController extends BaseController
{
    /**
     * @var FaqCategoryService $faqCategoryService
     * @var FaqService $faqService
     * @var LanguageService $languageService
     */
    private $faqCategoryService, $faqService, $languageService;

    /**
     * Initialization
     *
     * @param FaqCategoryService $faqCategoryService
     * @param FaqService $faqService
     * @param LanguageService $languageService
     */
    public function __construct(FaqCategoryService $faqCategoryService, FaqService $faqService, LanguageService $languageService)
    {
        parent::__construct();
        $this->faqCategoryService = $faqCategoryService;
        $this->faqService = $faqService;
        $this->languageService = $languageService;
        $this->middleware('permission:faqs-questions-list', ['only' => ['index']]);
        $this->middleware('permission:faqs-questions-create', ['only' => ['create', 'store']]);
        $this->middleware('permission:faqs-questions-edit', ['only' => ['edit', 'update']]);
        $this->middleware('permission:faqs-questions-delete', ['only' => ['destroy']]);
        $this->middleware('permission:faqs-questions-view', ['only' => ['show']]);
    }
    
    /**
     * FAQs category questions index page
     *
     * @param int $id
     * @return \Illuminate\View\View|\Illuminate\Contracts\View\Factory
     */
    public function index($id)
    {
        $faqCategory = $this->faqCategoryService->getById($id);
        return view('admin.faqs.categories.questions.index', compact('faqCategory'));
    }

    /**
     * FAQs category questions create page
     *
     * @param int $id
     * @return \Illuminate\View\View|\Illuminate\Contracts\View\Factory
     */
    public function create($id)
    {
        $languages = $this->languageService->getPublicActive();
        $faqCategory = $this->faqCategoryService->getById($id);
        return view('admin.faqs.categories.questions.crud', compact('languages', 'faqCategory'));
    }

    /**
     * Store a FAQs category question
     *
     * @param FaqStoreRequest $request
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(FaqStoreRequest $request, $id)
    {
        $this->faqService->create($request->validated());
        return redirect()->route('admin.faqs_categories.questions.index', $id)->with('notification', [
            [ 'type' => 'success', 'message' => __('staff/notifications.faqs_categories_questions_created_successfully') ]
        ]);
    }

    /**
     * FAQs category questions edit page
     *
     * @param int $id
     * @param int $questionId
     * @return \Illuminate\View\View|\Illuminate\Contracts\View\Factory
     */
    public function edit($id, $questionId)
    {
        $languages = $this->languageService->getPublicActive();
        $faqCategory = $this->faqCategoryService->getById($id);
        $faqQuestion = $this->faqService->getById($questionId);
        return view('admin.faqs.categories.questions.crud', compact('languages', 'faqCategory', 'faqQuestion'));
    }

    /**
     * Update a FAQs category question
     *
     * @param FaqStoreRequest $request
     * @param int $id
     * @param int $questionId
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(FaqStoreRequest $request, $id, $questionId)
    {
        $this->faqService->update($questionId, $request->validated());
        return redirect()->route('admin.faqs_categories.questions.index', $id)->with('notification', [
            [ 'type' => 'success', 'message' => __('staff/notifications.faqs_categories_questions_updated_successfully') ]
        ]);
    }

    /**
     * FAQs category questions view page
     *
     * @param int $id
     * @param int $questionId
     * @return \Illuminate\View\View|\Illuminate\Contracts\View\Factory
     */
    public function show($id, $questionId)
    {
        $languages = $this->languageService->getPublicActive();
        $faqCategory = $this->faqCategoryService->getById($id);
        $faqQuestion = $this->faqService->getById($questionId);
        return view('admin.faqs.categories.questions.show', compact('languages', 'faqCategory', 'faqQuestion'));
    }

    /**
     * Delete a FAQs category question
     *
     * @param int $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy($id)
    {
        $success = $this->faqService->delete($id);
        $response = [
            'success' => $success
        ];
        return response()->json($response);
    }
}
