<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Author extends Model
{
    protected $table     = 'authors';
    protected $fillable  = ['name', 'alias', 'keyword', 'description'];

    public function stories()
    {
        return $this->belongsToMany('App\Models\Story', 'story_authors');
    }
}
