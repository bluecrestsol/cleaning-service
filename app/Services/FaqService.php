<?php

namespace App\Services;

use App\Models\FaqQuestion;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Helpers\LocaleHelper;
use Illuminate\Support\Arr;


/**
 * Business logic related to FAQs questions
 */
class FaqService
{
    /**
     * @var FaqQuestion $model
     */
    protected $model;

    /**
     * Initialization
     *
     * @param FaqQuestion $model
     */
    public function __construct(FaqQuestion $model)
	{
        $this->model = $model;
    }

    /**
     * List of FAQs questions for table
     *
     * @param Request $request
     * @return array Contains information for building datatable
     */
    public function list(Request $request)
	{
        $orderable = [
            'faq_questions.id',
            '$$faq_categories.name',
            '$$faq_questions.question',
            'faq_questions.status',
            'translations_count'
        ];

        $searchable = [
            '$$faq_categories.name',
            '$$faq_questions.question',
            'faq_questions.status'
        ];

        if ($request->has('category')) {
            $orderable = [
                'faq_questions.id',
                'faq_questions.order',
                '$$faq_questions.question',
                'faq_questions.uuid',
                'faq_questions.status',
                'translations_count'
            ];

            $searchable = [
                '$$faq_questions.question',
                'faq_questions.uuid',
                'faq_questions.status'
            ];
        }

        $inner = $this->model
            ->select([
                'faq_questions.*',
                'languages.id AS language_id',
            ])
            ->leftJoin('languages', function($join) {
                $join->whereRaw(
                    LocaleHelper::isJsonNotNull("faq_questions.question", "CONCAT('$.', `languages`.`code`)")
                    . " AND ".
                    LocaleHelper::isJsonNotNull("faq_questions.answer", "CONCAT('$.', `languages`.`code`)")
                );
            })
            ->whereIn('languages.status_public', ['enabled', 'draft']);

        $result = $this->model
            ->select([
                'faq_questions.*',
                DB::raw(LocaleHelper::transColumn('faq_categories.name').' AS category_name'),
                DB::raw('COUNT(DISTINCT f1.language_id) AS translations_count')
            ])
            ->leftJoin(DB::raw('('.$inner->toSql().') AS f1'), function ($join) use ($inner) {
                $join->on('faq_questions.id', 'f1.id');
                $join->bindings = array_merge($join->bindings, $inner->getBindings());
            })
            ->leftJoin('faq_categories', 'faq_categories.id', 'faq_questions.faq_category_id')
            ->filterBy('faq_questions.faq_category_id', $request->query('category'))
            ->groupBy('faq_questions.id')
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
     * List of all FAQs questions
     *
     * @param array $filter
     * @return Collection<FaqQuestion>
     */
    public function getAll($param)
    {
        return $this->model
            ->filter($param)
            ->directOrder(Arr::get($param, 'order'))
            ->get();
    }

    /**
     * Get FAQs question by ID
     *
     * @param int $id
     * @return FaqQuestion
     */
    public function getById($id)
    {
        return $this->model
            ->where('id', $id)->first();
    }

    /**
     * Create a FAQs question
     *
     * @param array $data
     * @return FaqQuestion
     */
    public function create($data)
    {
        $data['uuid'] = $this->generateUniqueId();
        $data['order'] = $this->model
            ->where('faq_category_id', $data['faq_category_id'])
            ->max('order') + 1;
        return $this->model->create($data);
    }

    /**
     * Update FAQs question by ID
     *
     * @param int $id
     * @param array $data
     * @return FaqQuestion
     */
    public function update($id, $data)
    {
        $faq = $this->getById($id);
        $faq->update($data);
        return $faq;
    }

    /**
     * Delete FAQs question by ID
     *
     * @param int $id
     * @return bool
     */
    public function delete($id)
    {
        return $this->getById($id)->delete();
    }

    /**
     * Generate UUID
     *
     * @return void
     */
    public function generateUniqueId()
    {
        do {
            $uniqueId = mt_rand(0000, 9999);
        } while($this->isUniqueIdExist($uniqueId));
        return $uniqueId;
    }

    /**
     * Check if UUID already exist
     *
     * @param int $uniqueId
     * @return boolean
     */
    public function isUniqueIdExist($uniqueId)
    {
        $count = $this->model
            ->where('uuid', $uniqueId)
            ->count();
        return $count > 0;
    }

    /**
     * Update oder sequence of FAQs questions
     *
     * @param int $category
     * @param array $list
     * @return void
     */
    public function updateSequence($category, $list) {
        DB::beginTransaction();
        foreach ($list as $key => $item) {
            $this->model->where('id', $item['id'])
                ->where('faq_category_id', $category)
                ->update([
                    'order' => $item['order']
                ]);
        }
        DB::commit();
    }
}
