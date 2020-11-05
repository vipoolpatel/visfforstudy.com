<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class NotificationModel extends Model
{
    protected $table = 'notifications';

    static public function getNotification($id) {

		return self::orderBy('created_at','desc')->where('type','=','App\Notifications\CommonNotification')->paginate(20);
    }


    static public function getNotificationTeacher($id)
    {
		return self::orderBy('created_at','desc')->where('notifiable_id','=',$id)->where('type','=','App\Notifications\TeacherNotification')->paginate(20);
    }

    static public function getNotificationStudent($id)
    {
		return self::orderBy('created_at','desc')->where('notifiable_id','=',$id)->where('type','=','App\Notifications\StudentNotification')->paginate(20);
    }

    

    public function getusers() {
        return $this->belongsTo(UsersModel::class, "notifiable_id");
    }

}
