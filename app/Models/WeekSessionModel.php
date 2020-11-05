<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Auth;
class WeekSessionModel extends Model
{
     protected $table = 'week_session';

     public function getcount($week_id,$user_id) {
     	return self::select('week_session.*')
     		->join('user_availability','user_availability.week_session_id','=','week_session.id')
     		->join('week','week.id','=','user_availability.week_id')
     		->where('week_session.id','=',$this->id)
     		->where('user_availability.week_id','=',$week_id)
     		->where('user_availability.user_id','=',$user_id)->count();
     }
}
