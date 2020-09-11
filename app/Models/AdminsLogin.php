<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Admin;

class AdminsLogin extends Model
{
    protected $guarded = ['id'];
    protected $table = 'admins_logins';

    const STATUS = [
        'UNSUCCESSFUL' => 0,
        'SUCCESS' => 1
    ];

    public function admin()
    {
        return $this->belongsTo(Admin::class, 'user_id');
    }
}