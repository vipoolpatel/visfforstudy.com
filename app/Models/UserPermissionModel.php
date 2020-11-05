<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Auth;

class UserPermissionModel extends Model
{
    protected $table = 'user_permission';


    static public function getPermission($slug)
    {
    	if(Auth::user()->is_admin == 4)
    	{
    		return 1;
    	}
    	else
    	{
    		return self::select('user_permission.*')
					->join('permission','permission.id','=','user_permission.permission_id')
					->where('user_permission.user_id','=',Auth::user()->id)
					->where('permission.slug','=',$slug)
					->count();
    	}

    }	
}
