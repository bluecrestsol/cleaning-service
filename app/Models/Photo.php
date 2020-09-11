<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Photo extends Model
{
     /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'photos';

    /**
    * The database primary key value.
    *
    * @var string
    */
    protected $primaryKey = 'id';

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = [
							'status',
							'appointment_id',
							'file',
							'size',
							'width',
							'height',
							'original_file',
							'sorting',
							'created_at',
							'updated_at'
							];
}
