<?php

namespace App\Models;

use Illuminate\Auth\Middleware\Authenticate;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Contracts\Auth\MustVerifyEmail;

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
