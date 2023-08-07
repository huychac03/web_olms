<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Story extends Model
{
    protected $table     = 'stories';
    protected $fillable  = ['name', 'alias', 'content', 'view', 'status', 'user_id', 'source', 'keyword', 'description', 'active'];
    //public $timestamps   = false;

    public function categories()
    {
        return $this->belongsToMany('App\Models\Category', 'story_categories');
    }

    public function authors()
    {
        return $this->belongsToMany('App\Models\Author', 'story_authors');
    }

    public function chapters()
    {
        return $this->hasMany('App\Models\Chapter');
    }

    public function user()
    {
        return $this->belongsTo('App\Models\User');
    }

    /**
     * Lấy truyện Hot về
     * @param int $categoryID
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public static function getListHotStories($categoryID = 0){
        if($categoryID != 0)
        {
            $category = Category::where('id', $categoryID)->first();
            $stories = $category->stories()->orderBy('view', 'DESC')->skip(0)->take(13)->get();
        }
        else
            $stories = Story::where('active', 1)->orderBy('view', 'DESC')->skip(0)->take(13)->get();
        return view('user.templates.hot', compact('stories'));
    }

    /**
     * Mẫu lấy danh sách index
     * @param int $categoryID
     * @return string
     */
    public static function getListNewStories($categoryID = 0)
    {
        if($categoryID != 0)
        {
            $category = Category::where('id', $categoryID)->first();
            $stories = $category->stories()->where('active', 1)->orderBy('updated_at', 'DESC')->skip(0)->take(25)->get();
        }
        else
            $stories = Story::where('active', 1)->orderBy('updated_at', 'DESC')->skip(0)->take(25)->get();
        return view('user.templates.new', compact('stories'));
    }

    /**
     * Mẫu lấy truyện đã hoàn thành
     * @return view
     */
    public static function getListDoneStories()
    {
        $stories = self::where(['status' => 1, 'active' => 1])->orderBy('updated_at', 'DESC')->skip(0)->take(12)->get();
        return view('user.templates.slide', compact('stories'));
    }

}