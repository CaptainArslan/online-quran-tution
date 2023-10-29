<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Children extends Model
{
    use HasFactory;

    protected $fillable = ['parent_id', 'name', 'age', 'fatherName', 'motherName', 'skype_id', 'skype_assigned_at'];

    public function parent()
    {
        return $this->belongsTo(User::class, 'id', 'parent_id');
    }

    public function inquiry()
    {
        return $this->hasOne(\App\Models\Inquiry::class, 'child_id');
    }

    public function subscriptions()
    {
        return $this->hasMany(Subscription::class, 'child_id', 'id');
    }
}
