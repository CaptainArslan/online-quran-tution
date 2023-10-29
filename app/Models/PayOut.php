<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PayOut extends Model
{
    protected $fillable = [];

    public function tutor()
    {
        return $this->belongsTo(\App\Models\User::class, 'tutor_id');
    }

    public function manager()
    {
        return $this->belongsTo(\App\Models\User::class, 'manager_id');
    }
}
