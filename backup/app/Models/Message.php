<?php

namespace App\Models;

use App\Traits\SyncsWithFirebase;
use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    use SyncsWithFirebase;

    protected $table = 'messages';

    public function user()
    {
        return $this->belongsTo(\App\Models\User::class);
    }

    public function conversation()
    {
        return $this->belongsTo(Conversation::class, 'conversation_id', 'id');
    }
}
