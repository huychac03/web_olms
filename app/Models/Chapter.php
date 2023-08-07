<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Chapter extends Model
{
    protected $table     = 'chapters';
    protected $fillable  = ['name', 'subname', 'alias', 'content', 'view', 'story_id', 'keyword', 'description', 'active', 'point', 'status'];

    public function story()
    {
        return $this->belongsTo('App\Models\Story');
    }

    public function userChapter()
    {
        return $this->hasMany('App\Models\UserChapter', 'chapter_id', 'id');
    }

    public static function theNextSubname($id)
    {
        $count = static::where('story_id', $id)->count() + 1;
        return 'Chương ' . $count;
    }

}
