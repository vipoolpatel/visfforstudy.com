<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CourseModel extends Model
{
    protected $table = 'course';

    static public function get_single($id) {
        return self::find($id);
    }



    static public function get_admin_dashboard()
    {
    	return self::where('status','=','1')->where('is_delete','=','0')->orderBy('id','desc')->limit(5)->get();
    }

    public function getstatus()
    {
        return $this->belongsTo(StatusModel::class, "status");
    }

    public function getcategory()
    {
    	return $this->belongsTo(CategoryModel::class, "category_id");
    }


    public function getlanguage() {
    	return $this->belongsTo(LanguageModel::class, "language_id");
    }

    public function get_lesson_type() {
        return $this->belongsTo(RequestTypeModel::class, "lesson_type_id");
    }

    public function get_course_lesson() {
        return $this->hasMany(CourseLessonModel::class, "course_id")->where('lesson_date','>=',time())->where('is_delete','=',0);
    }

    public function get_course_lesson_date() {
        return $this->hasMany(CourseLessonModel::class, "course_id")->where('is_delete','=',0)->where('lesson_date','>=',time())->groupBy('lesson_start_date');
    }

    public function get_course_subject() {
        return $this->hasMany(SubjectModel::class, "course_id")->where('is_delete','=',0);
    }


    public function getusers()
    {
        return $this->belongsTo(UsersModel::class, "user_id");
    }

    public function getstudent()
    {
        return $this->belongsTo(UsersModel::class, "student_id");
    }
    

    public function getImageCourse() {
         if(!empty($this->image) && file_exists('upload/course/'.$this->image)) {
            return url('upload/course/'.$this->image);
         }
         else {
            return '';
         }
    }

    public function getVideoCourse() {
         if(!empty($this->course_video) && file_exists('upload/course/'.$this->course_video)) {
            return url('upload/course/'.$this->course_video);
         }
         else {
            return '';
         }
    }


    static public function getCourseCategory($user_id) {
        $get = self::select('category.*');
        $get = $get->join('category','category.id','=','course.category_id');
        $get = $get->where('course.user_id','=',$user_id);
        $get = $get->where('course.status','=',2);
        $get = $get->where('course.is_delete','=',0);
        $get = $get->groupBy('course.category_id');
        $get = $get->get();

        return $get;
    }


    static public function getCourseCategorySingle($category_id, $user_id) {
        $get = self::select('course.*');
        $get = $get->where('course.category_id','=',$category_id);
        $get = $get->where('course.user_id','=',$user_id);
        $get = $get->where('course.status','=',2);
        $get = $get->where('course.is_delete','=',0);
        $get = $get->get();
        return $get;
    }






    



    
}
