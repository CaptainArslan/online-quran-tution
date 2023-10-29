<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Blog extends Model
{
    protected $fillable = ['id', 'meta_title', 'meta_description', 'meta_keywords', 'title', 'image', 'tags', 'written_by', 'description', 'slug'];
}
