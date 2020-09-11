<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Note;
use App\Models\Address;

class BillingDetail extends Model
{
    protected $fillable = [
        'place_id',
        'first_name',
        'last_name',
        'email',
        'mobile',
        'phone',
        'name',
        'tax_code',
        'created_at',
        'updated_at'
    ];

    public function notes()
    {
        return $this->morphMany(Note::class, 'noteable');
    }

    public function address()
    {
        return $this->morphOne(Address::class, 'addressable');
    }

    public function billing_detailable()
    {
        return $this->morphTo();
    }

    // this is a recommended way to declare event handlers
    public static function boot() {
        parent::boot();
        self::deleting(function($billing_details) { // before delete() method call this
             optional($billing_details->address)->delete();
        });
    }
}
