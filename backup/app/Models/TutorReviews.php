<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TutorReviews extends Model
{
    protected $guarded = [];

    public function student()
    {
        return $this->belongsTo(User::class, 'student_id', 'id');
    }

    public function tutor()
    {
        return $this->belongsTo(User::class, 'tutor_id', 'id');
    }
}
