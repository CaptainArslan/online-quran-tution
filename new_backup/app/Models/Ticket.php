<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Ticket extends Model
{
    protected $fillable = [
        'user_id', 'enquiry_type', 'ticket_id', 'subject', 'priority', 'description', 'status',
    ];

    // public function enquiry_type()
    // {
    //     return $this->belongsTo(EnquiryType::class);
    // }

    public function comments()
    {
        return $this->hasMany(Comment::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
