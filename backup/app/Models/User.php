<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable implements MustVerifyEmail
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'fathername', 'mothername', 'review_notification', 'address', 'address2', 'address3', 'age', 'otp',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function tutor()
    {
        return $this->hasOne(\App\Models\Tutor::class);
    }

    public function inquiry()
    {
        return $this->hasOne(\App\Models\Inquiry::class, 'student_id');
    }

    public function tutor_inquiries()
    {
        return $this->hasMany(\App\Models\Inquiry::class, 'tutor_id');
    }

    public function payment_manager()
    {
        return $this->hasOne(\App\Models\PaymentManager::class);
    }

    public function schedules()
    {
        return $this->hasMany(InquirySchedule::class, 'tutor_id', 'id');
    }
}
