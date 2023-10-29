<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Country extends Model
{
    protected $fillable = [
        'code',
        'name',
        'currency',
    ];

    public function plan()
    {
        return $this->hasMany(\App\Models\Plan::class);
    }
}
