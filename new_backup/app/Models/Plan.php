<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Plan extends Model
{
    protected $fillable = [
        'name',
        'price',
        'discount',
        'days_in_week',
        'classes_in_month',
        'duration',
        'price_per_month',
        'note',
        'country_id',
        'is_private',
    ];

    public function country()
    {
        return $this->belongsTo(\App\Models\Country::class);
    }

    public function inquiry()
    {
        return $this->hasMany(\App\Models\Inquiry::class);
    }
}
