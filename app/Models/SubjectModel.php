<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SubjectModel extends Model
{
    protected $table = 'subject';


    static public function getcoursesubject($id)
    {
    	$getsubject = self::select('subject.*');
        $getsubject = $getsubject->join('course','course.id','=','subject.course_id');
        $getsubject = $getsubject->where('course.user_id','=',$id);
        $getsubject = $getsubject->where('course.status','=',2);
        $getsubject = $getsubject->where('course.is_delete','=',0);
        $getsubject = $getsubject->get();

        return $getsubject;

    }

    static public function getCourseCategorySubject($id)
    {
        $getsubject = self::select('subject.*');
        $getsubject = $getsubject->join('course','course.id','=','subject.course_id');
        $getsubject = $getsubject->whereIn('course.id'  ,$id);
        $getsubject = $getsubject->where('course.status','=',2);
        $getsubject = $getsubject->where('subject.is_delete','=',0);
        $getsubject = $getsubject->where('course.is_delete','=',0);
        $getsubject = $getsubject->get();
        return $getsubject;
    }



    
}

