<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Auth;

class OrderCourseModel extends Model
{
    protected $table = 'order_course';

    static public function getAppWebsiteTeacher($user_id) {
        return self::where('is_payment','=',1)->where('user_id','=',$user_id)->orderBy('id','desc')->paginate(40);
    }

    static public function getAppWebsiteStudent($user_id) {
        return self::where('is_payment','=',1)->where('student_id','=',$user_id)->orderBy('id','desc')->paginate(40);
    }

    static public function getStudentOrderDashboard($user_id) {
        return self::where('is_payment','=',1)->where('student_id','=',$user_id)->orderBy('id','desc')->paginate(4);
    }

    static public function getTutorOrderDashboard($user_id) {
        return self::where('is_payment','=',1)->where('user_id','=',$user_id)->orderBy('id','desc')->paginate(4);
    }

    static public function getAdminBookedLesson() {
        return self::where('is_payment','=',1)->orderBy('id','desc')->paginate(6);
    }

    static public function getTotalBookedLesson() {
        return self::where('is_payment','=',1)->count();
    }

    public function getusers()
    {
        return $this->belongsTo(UsersModel::class, "user_id");
    }

    public function getstudent()
    {
        return $this->belongsTo(UsersModel::class, "student_id");
    }


    public function getcourse()
    {
        return $this->belongsTo(CourseModel::class, "course_id");
    }

    public function getlesson()
    {
        return $this->belongsTo(CourseLessonModel::class, "lesson_id");
    }


    public function getstatus()
    {
        return $this->belongsTo(StatusModel::class, "status");
    }

    public function getlessontype()
    {
        return $this->belongsTo(RequestTypeModel::class, "lesson_type_id");
    }


    public function getlevelname()
    {
        return $this->belongsTo(LevelOfStudentModel::class, "level_of_student_id");
    }


    public function getnote()
    {
        if(Auth::user()->is_admin == 1)
        {
            return $this->hasMany(OrderCourseNoteModel::class, "order_course_id")->where('type','=','course')->orderBy('id','desc');
        }
        else
        {
            return $this->hasMany(OrderCourseNoteModel::class, "order_course_id")->where('type','=','course')->where('user_id','=',Auth::user()->id)->orderBy('id','desc');    
        }
        
    }

    

    public function gethomework()
    {
        return $this->hasMany(OrderCourseHomeWorkModel::class, "order_course_id")->where('type','=','course')->orderBy('id','desc');
    }

    public function gethomeworksubmited()
    {
        return $this->hasMany(OrderCourseHomeWorkModel::class, "order_course_id")->orderBy('id','desc')->where('type','=','course')->where('is_complete','=',1);
    }


   static public function getSubmitedHomeworkTeacherDashbaord($user_id){
        $record = self::select('order_course.*','orders_course_home_work.title','orders_course_home_work.complete_date');
        $record = $record->join('orders_course_home_work','orders_course_home_work.order_course_id','=','order_course.id');
        $record = $record->where('order_course.user_id','=',$user_id);
        $record = $record->where('orders_course_home_work.is_complete','=','1');
        $record = $record->where('order_course.is_payment','=',1);
        $record = $record->where('orders_course_home_work.type','=','course');
        $record = $record->orderBy('orders_course_home_work.id','desc');
        $record = $record->limit(5);
        $record = $record->get();
        return $record;

    }

    static public function getSubmitedHomeworkStudentDashbaord($user_id){
        $record = self::select('order_course.*','orders_course_home_work.title','orders_course_home_work.complete_date','orders_course_home_work.lesson_time');
        $record = $record->join('orders_course_home_work','orders_course_home_work.order_course_id','=','order_course.id');
        $record = $record->where('order_course.student_id','=',$user_id);
        $record = $record->where('order_course.is_payment','=',1);
        $record = $record->where('orders_course_home_work.is_complete','=','0');
        $record = $record->where('orders_course_home_work.type','=','course');
        $record = $record->orderBy('orders_course_home_work.id','desc');
        $record = $record->limit(5);
        $record = $record->get();
        return $record;

    }
    

    

}