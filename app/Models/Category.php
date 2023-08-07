<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $table     = 'categories';
    protected $fillable  = ['name', 'alias', 'parent_id', 'keyword', 'description'];
    //public $timestamps   = false;

    public function parent()
    {
        return $this->hasOne($this,'id', 'parent_id');
    }
    public function stories()
    {
        return $this->belongsToMany('App\Models\Story', 'story_categories')->where('active', 1);
    }
}
