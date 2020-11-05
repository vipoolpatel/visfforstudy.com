<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CourseLessonModel extends Model
{
     protected $table = 'course_lesson';


	static public function getCourseTime($lesson_start_date,$course_id)
	{
		$get = self::select('course_lesson.*');
        $get = $get->where('course_id','=',$course_id);
        $get = $get->where('lesson_start_date','=',$lesson_start_date);
        $get = $get->where('lesson_date','>=',time());
        $get = $get->where('is_delete','=',0);
        $get = $get->get();
        return $get;
	}

}
