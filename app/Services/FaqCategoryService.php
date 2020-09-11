<?php

namespace App\Services;

use App\Models\FaqCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Helpers\LocaleHelper;
use Illuminate\Support\Arr;

/**
 * Business logic related to FAQs categories
 */
class FaqCategoryService
{
    /**
     * @var FaqCategory $model
     */
    protected $model;

    /**
     * Initializationx
     *
     * @param FaqCategory $model
     */
    public function __construct(FaqCategory $model)
	{
        $this->model = $model;
    }

    /**
     * List of FAQs categories for table
     *
     * @param Request $request
     * @return array Contains information for building datatable
     */
    public function list(Request $request)
	{
        $orderable = [
            'faq_categories.id',
            'faq_categories.order',
            '$$faq_categories.name',
            'faq_categories.status',
            'questions_count',
            'translations_count'
        ];

        $searchable = [
            '$$faq_categories.name',
            'faq_categories.status'
        ];

        $inner = $this->model
            ->select([
                'faq_categories.*',
                'languages.id AS language_id',
            ])
            ->leftJoin('languages', function($join) {
                $join->whereRaw(
                    LocaleHelper::isJsonNotNull("faq_categories.name", "CONCAT('$.', `languages`.`code`)")
                );
            })
            ->whereIn('languages.status_public', ['enabled', 'draft']);

        $result = $this->model
            ->select([
                'faq_categories.*',
                DB::raw('COUNT(DISTINCT f1.language_id) AS translations_count')
            ])
            ->leftJoin(DB::raw('('.$inner->toSql().') AS f1'), function ($join) use ($inner) {
                $join->on('faq_categories.id', 'f1.id');
                $join->bindings = array_merge($join->bindings, $inner->getBindings());
            })
            ->withCount('questions')
            ->filterBy('faq_categories.country_id', $request->query('country'))
            ->groupBy('faq_categories.id')
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
     * List of all FAQs categories
     *
     * @param array $filter
     * @return Collection<FaqCategory>
     */
    public function getAll($param)
    {
        return $this->model
            ->filter($param)
            ->directOrder(Arr::get($param, 'order'))
            ->get();
    }

    /**
     * Get FAQs category by ID
     *
     * @param int $id
     * @return FaqCategory
     */
    public function getById($id)
    {
        return $this->model
            ->where('id', $id)->first();
    }

    /**
     * Get FAQs category by ID
     *
     * @param int $id
     * @return FaqCategory
     */
    public function getWithQuestions($param)
    {
        return $this->model
            ->filter($param)
            ->with(['questions' => function($query) use ($param) {
                $param = [
                    'status' => Arr::get($param, 'questions_status'),
                    'order' => Arr::get($param, 'questions_order')
                ];
                $query->filter($param)
                    ->directOrder(Arr::get($param, 'order'));
            }])
            ->directOrder(Arr::get($param, 'order'))
            ->get();
    }

    /**
     * Create a FAQs category
     *
     * @param array $data
     * @return FaqCategory
     */
    public function create($data)
    {
        $data['uuid'] = $this->generateUniqueId();
        $data['order'] = $this->model
            ->where('country_id', $data['country_id'])
            ->max('order') + 1;
        return $this->model->create($data);
    }

    /**
     * Update FAQs category by ID
     *
     * @param int $id
     * @param array $data
     * @return FaqCategory
     */
    public function update($id, $data)
    {
        $faqCategory = $this->getById($id);
        $faqCategory->update($data);
        return $faqCategory;
    }

    /**
     * Delete FAQs category by ID
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
     * Update oder sequence of FAQs categories
     *
     * @param int $country
     * @param array $list
     * @return void
     */
    public function updateSequence($country, $list) {
        DB::beginTransaction();
        foreach ($list as $key => $item) {
            $this->model->where('id', $item['id'])
                ->where('country_id', $country)
                ->update([
                    'order' => $item['order']
                ]);
        }
        DB::commit();
    }
}
