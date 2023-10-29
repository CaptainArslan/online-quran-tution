<?php

namespace App\Models;

use App\Http\Controllers\admin\InquiryController;
use Illuminate\Database\Eloquent\Model;


class Inquiry extends Model
{
    protected $guarded = [];

    public function user()
    {
        return $this->belongsTo(\App\Models\User::class, 'student_id');
    }

    public function child(){
        return $this->belongsTo(\App\Models\Children::class, 'child_id');
    }

    public function inquiry_sessions()
    {
        return $this->hasMany(\App\Models\Inquiry_Session::class);
    }

    public function plan()
    {
        return $this->belongsTo(\App\Models\Plan::class);
    }

    public function tutor()
    {
        return $this->belongsTo(\App\Models\User::class, 'tutor_id');
    }

    public function schedules()
    {
        return $this->hasMany(InquirySchedule::class, 'inquiry_id', 'id');
    }

    public function getInquiryDay($tutorId)
    {
        $inquirySch = InquirySchedule::where('inquiry_id', $this->id)->where('tutor_id', $tutorId)->first();
        if ($inquirySch !== null) {
            if ($inquirySch['day'] == 1) {
                return 'Monday';
            } elseif ($inquirySch['day'] == 2) {
                return 'Tuesday';
            } elseif ($inquirySch['day'] == 2) {
                return 'Tuesday';
            } elseif ($inquirySch['day'] == 3) {
                return 'Wednesday';
            } elseif ($inquirySch['day'] == 4) {
                return 'Thursday';
            } elseif ($inquirySch['day'] == 5) {
                return 'Friday';
            } elseif ($inquirySch['day'] == 6) {
                return 'Saturday';
            } elseif ($inquirySch['day'] == 7) {
                return 'Sunday';
            }
        }
    }
}
