<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Traits\ExtendedEloquentTrait;
use App\Traits\HasDatatable;
use Spatie\Translatable\HasTranslations;
use App\Models\FaqCategory;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Arr;

class FaqQuestion extends Model
{
    use HasDatatable, ExtendedEloquentTrait, HasTranslations;

    protected $fillable = [
        'uuid',
        'faq_category_id',
        'question',
        'answer',
        'status',
        'order',
        'created_at',
        'updated_at'
    ];

    public $translatable = ['question', 'answer'];

    public function category()
    {
        return $this->belongsTo(FaqCategory::class, 'faq_category_id');
    }

    /**
     * Scope a query for filtering
     *
     * @param $query
     * @param $param
     * @return mixed
     */
    public function scopeFilter($query, $param)
    {
        return $query->filterBy('faq_category_id', Arr::get($param, 'faq_category_id'));

    }

    // this is a recommended way to declare event handlers
    public static function boot() {
        parent::boot();
        self::deleting(function($faqQuestion) { // before delete() method call this
            static::where('faq_category_id', $faqQuestion->faq_category_id)
                ->where('order', '>', $faqQuestion->order)
                ->update(['order' => DB::raw('`order` - 1')]);
        });
    }
}
