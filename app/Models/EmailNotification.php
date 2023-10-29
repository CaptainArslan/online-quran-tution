<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class EmailNotification extends Model
{
    protected $fillable = ['id', 'inquiry_mail_to_admin', 'cred_mail_to_student', 'tutor_mail_to_student', 'on_trial_mail_to_tutor', 'start_mail_to_tutor', 'appointment_mail_to_student',
        'appointment_mail_to_tutor', 'tutor_salary_mail', ];
}
