<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Admin\BaseController;
use App\Services\FaqService;
use App\Services\LanguageService;
use App\Http\Requests\FaqStoreRequest;

/**
 * Ajax controller for FAQs questions
 */
class FaqController extends BaseController
{
    /**
     * @var FaqService $faqService
     * @var LanguageService $languageService
     */
    private $faqService, $languageService;

    /**
     * Initialization
     *
     * @param FaqService $faqService
     * @param LanguageService $languageService
     */
    public function __construct(FaqService $faqService, LanguageService $languageService)
    {
        parent::__construct();
        $this->faqService = $faqService;
        $this->languageService = $languageService;
        $this->middleware('permission:faqs-questions-list', ['only' => ['index']]);
        $this->middleware('permission:faqs-questions-create', ['only' => ['create', 'store']]);
        $this->middleware('permission:faqs-questions-edit', ['only' => ['edit', 'update']]);
        $this->middleware('permission:faqs-questions-delete', ['only' => ['destroy']]);
        $this->middleware('permission:faqs-questions-view', ['only' => ['show']]);
    }
    
    /**
     * FAQs questions index page
     *
     * @return \Illuminate\View\View|\Illuminate\Contracts\View\Factory
     */
    public function index()
    {
        return view('admin.faqs.index');
    }

    /**
     * FAQs questions create page
     *
     * @return \Illuminate\View\View|\Illuminate\Contracts\View\Factory
     */
    public function create()
    {
        $languages = $this->languageService->getPublicActive();
        return view('admin.faqs.crud', compact('languages'));
    }

    /**
     * Store a FAQs question
     *
     * @param FaqStoreRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(FaqStoreRequest $request)
    {
        $this->faqService->create($request->validated());
        return redirect()->route('admin.faqs_questions.index')->with('notification', [
            [ 'type' => 'success', 'message' => __('staff/notifications.faqs_questions_created_successfully') ]
        ]);
    }

    /**
     * FAQs questions edit page
     *
     * @param int $id
     * @return \Illuminate\View\View|\Illuminate\Contracts\View\Factory
     */
    public function edit($id)
    {
        $languages = $this->languageService->getPublicActive();
        $faqQuestion = $this->faqService->getById($id);
        return view('admin.faqs.crud', compact('languages', 'faqQuestion'));
    }

    /**
     * Update a FAQs question
     *
     * @param FaqStoreRequest $request
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(FaqStoreRequest $request, $id)
    {
        $this->faqService->update($id, $request->validated());
        return redirect()->route('admin.faqs_questions.index')->with('notification', [
            [ 'type' => 'success', 'message' => __('staff/notifications.faqs_questions_updated_successfully') ]
        ]);
    }

    /**
     * FAQs questions view page
     *
     * @param int $id
     * @return \Illuminate\View\View|\Illuminate\Contracts\View\Factory
     */
    public function show($id)
    {
        $languages = $this->languageService->getPublicActive();
        $faqQuestion = $this->faqService->getById($id);
        return view('admin.faqs.show', compact('languages', 'faqQuestion'));
    }

    /**
     * Delete a FAQs question
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
