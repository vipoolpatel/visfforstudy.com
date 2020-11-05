<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;
use DB;
use Auth;

class ActivityModel extends Model
{
    protected $table = 'activity';

    public function getusers()
    {
        return $this->belongsTo(UsersModel::class, "user_id");
    }

    static public function getActivityDashboard() {
    	 if (Auth::user()->is_admin == "1"){
    	return self::orderBy('id','desc')->where('user_id', '=', Auth::user()->id)->where(DB::raw("(DATE_FORMAT(created_at,'%Y-%m-%d'))"),"=",date('Y-m-d'))->where('is_delete','=','0')->get();
    }else{
    	return self::orderBy('id','desc')->where(DB::raw("(DATE_FORMAT(created_at,'%Y-%m-%d'))"),"=",date('Y-m-d'))->where('is_delete','=','0')->get();
    }
    	// dd(Carbon::today());
    }
    

    // static public function getusers_new()
    // {
    // 	return self::select('activity.*')
				// 	->join('users','users.id','=','activity.user_id')
				// 	->whereIn('users.is_admin', array('1','4'))
				// 	->where('activity.is_delete','=',0)
				// 	->orderBy('activity.id', 'desc')
				// 	->get();
    //   //  return $this->belongsTo(UsersModel::class, "user_id");
    // }
}
