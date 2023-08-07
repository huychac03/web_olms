<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Option extends Model
{
    protected $table     = 'options';
    protected $fillable  = ['name', 'value'];

    /**
     * lấy dữ liệu trong bảng options
     * @param $name
     * @return bool
     */
    public static function getvalue($name)
    {
        $option = self::select('value')->where('name',$name)->first();
        if($option)
            return $option->value;
        else
            return false;
    }

    /**
     * @param $name
     * @param $value
     * @return bool
     */
    public static function put($name, $value)
    {
        $option = self::where('name',$name)->first();
        if($option)
        {
            $option->value = $value;
            $option->created_at = Carbon::now();
            $option->updated_at = Carbon::now();
            $option->save();
        }
        else
            return false;
    }

    /**
     * @param $name
     * @param $value
     * @return mixed
     */
    public static function add($name, $value)
    {
        return self::create(['name'=>$name, 'value'=>$value]);
    }

    /**
     * @param $name
     */
    public static function del($name)
    {
        $option = self::where('name',$name)->first();
        if($option) $option->delete();
    }
}
