<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Report extends Model
{
  protected $table     = 'reports';

  public function chapter()
  {
      return $this->belongsTo('App\Models\Chapter')->where('active', 1);
  }

  static public function getCount()
  {
      $count = self::count();
      return $count;
  }

  static public function getListReportNotSolved()
  {
    $result = self::take(5)->get();
    return $result;
  }

}
