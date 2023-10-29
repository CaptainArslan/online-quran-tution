<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class InquirySchedule extends Model
{
    // protected $table = 'inquiry_schedules';
    protected $guarded = [];

    public function inquiry()
    {
        return $this->belongsTo(Inquiry::class, 'inquiry_id', 'id');
    }
}
