<?php

namespace App\Traits;

use App\Helpers\LocaleHelper;

/**
 * Trait for Datatable
 */
Trait HasDatatable {

    /**
     * Search functionality
     *
     * @param Illuminate\Database\Eloquent\Builder $query
     * @param string $search
     * @param array $columns
     * @return Illuminate\Database\Eloquent\Builder
     */
    public function scopeSearch($query, $search, $columns)
    {
        return $query->when($search, function($query, $search) use ($columns) {
            $query->where(function($query) use ($search, $columns) {
                foreach($columns as $column) {
                    $query->orWhereRaw(
                        LocaleHelper::magicTrans($column)." LIKE '%{$search}%'"
                    );

                }
            });
        });
    }

    /**
     * Order records using datatable format
     *
     * @param Illuminate\Database\Eloquent\Builder $query
     * @param array $list
     * @param array $fields
     * @return Illuminate\Database\Eloquent\Builder
     */
    public function scopeExternalOrder($query, $list, $fields)
    {
        foreach($list as $order) {
            $column = $fields[intval($order['column'])];
            $query = $this->handleMultipleOrder($query, $column, $order['dir']);
        }
        return $query;
    }

    /**
     * Order records using API format e.g asc(name)
     *
     * @param Illuminate\Database\Eloquent\Builder $query
     * @param string|array $list
     * @return Illuminate\Database\Eloquent\Builder
     */
    public function scopeDirectOrder($query, $list)
    {
        if (isset($list)) {
            if (is_array($list)) {
                foreach ($list as $order) {
                    $query = $this->handleMultipleOrder($query, $order['column'], $order['dir']);
                }
            } else {
                $list = explode(',', $list);
                foreach ($list as $order) {
                    preg_match("/\(([^\]]*)\)/", $order, $matches);
                    $dir = str_replace($matches[0], '', $order);
                    $query = $this->handleMultipleOrder($query, $matches[1], $dir);
                }
            }
        }
        return $query;
    }

    /**
     * Handle multiple column order
     *
     * @param Illuminate\Database\Eloquent\Builder $query
     * @param string|array $column
     * @param string $dir
     * @return Illuminate\Database\Eloquent\Builder
     */
    public function handleMultipleOrder($query, $column, $dir)
    {
        if (is_array($column)) {
            foreach ($column as $item) {
                if (!empty($item)) {
                    $query = $query->singleOrder($item, $dir);
                }
            }
        } else {
            if (!empty($column)) {
                $query = $query->singleOrder($column, $dir);
            }
        }
        return $query;
    }
    
    /**
     * Handle single column order
     *
     * @param Illuminate\Database\Eloquent\Builder $query
     * @param string $column
     * @param string $dir
     * @return Illuminate\Database\Eloquent\Builder
     */
    public function scopeSingleOrder($query, $column, $dir)
    {
        return $query->orderByRaw(
            LocaleHelper::magicTrans($column)." {$dir}"
        );
    }

    /**
     * Defining query as a datatable
     *
     * @param Illuminate\Database\Eloquent\Builder $query
     * @param Request $request
     * @param array $searchable
     * @param array $orderable
     * @return array
     */
    public function scopeOfDatatable($query, $request, $searchable, $orderable)
    {
        $query = $query->search($request->search['value'] ?? null, $searchable);
        $total =  $query->getQuery()->getCountForPagination();
        $limit = $request->length;
        $offset = $request->start;
        return [
            'total' => $total,
            'query' => $query->externalOrder($request->order, $orderable)
                ->when($limit > 0, function($query) use ($limit, $offset) {
                    return $query->offset($offset)
                        ->limit($limit);
                })
        ];
    }
}

?>