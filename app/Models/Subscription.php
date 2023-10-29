<?php

namespace App\Models;

use App\Models\Plan;
use Illuminate\Database\Eloquent\Model;

class Subscription extends Model
{
    protected $guarded = [];

    public function plan()
    {
        return $this->belongsTo(Plan::class, 'plan_id', 'id');
    }

    public function username()
    {
        return $this->belongsTo(User::class, 'id', 'user_id');
    }

    public function user(){
        return $this->hasOne(User::class, 'id', 'user_id');
    }

    public function child(){
        return $this->belongsTo(Children::class, 'id', 'child_id');
    }
}
