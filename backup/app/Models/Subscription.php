<?php

namespace App\Models;

use App\Models\Plan;
use Illuminate\Database\Eloquent\Model;

class Subscription extends Model
{
    protected $guarded = [];

    public function plan()
    {
        return $this->belongsTo(\App\Models\Plan::class, 'plan_id', 'id');
    }

    public function username()
    {
        return $this->belongsTo(User::class, 'id', 'user_id');
    }
}
