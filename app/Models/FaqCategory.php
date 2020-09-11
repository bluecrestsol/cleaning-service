<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Traits\ExtendedEloquentTrait;
use App\Traits\HasDatatable;
use Spatie\Translatable\HasTranslations;
use App\Models\FaqQuestion;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Arr;

class FaqCategory extends Model
{
    use HasDatatable, ExtendedEloquentTrait, HasTranslations;

    protected $fillable = [
        'uuid',
        'country_id',
        'name',
        'status',
        'type',
        'order',
        'created_at',
        'updated_at'
    ];

    public $translatable = ['name'];

    public function questions()
    {
        return $this->hasMany(FaqQuestion::class, 'faq_category_id');
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
        return $query->filterBy('status', Arr::get($param, 'status'))
            ->filterBy('country_id', Arr::get($param, 'country'));
    }

    // this is a recommended way to declare event handlers
    public static function boot() {
        parent::boot();
        self::deleting(function($faqCategory) { // before delete() method call this
            static::where('country_id', $faqCategory->country_id)
                ->where('order', '>', $faqCategory->order)
                ->update(['order' => DB::raw('`order` - 1')]);
        });
    }
}
