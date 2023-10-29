<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Inquiry_Session extends Model
{
    protected $fillable = [
        'inquiry_id',
        'start_time',
        'start_url',
        'duration',
        'join_url',
        'meeting_review',

    ];

    public function inquiry()
    {
        return $this->belongsTo(\App\Models\Inquiry::class);
    }
}
