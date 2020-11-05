<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Auth;
class OfferModel extends Model
{
    protected $table = 'offers';

    static public function get_single($id) {
        return self::find($id);
    }


    static public function get_admin_dashboard_offer()
    {
        return self::where('status','=','1')->where('is_delete','=','0')->orderBy('id','desc')->limit(5)->get();
    }
    
	public function getusers() {
        return $this->belongsTo(UsersModel::class, "user_id");
    }
    
    public function getstudent() {
        return $this->belongsTo(UsersModel::class, "student_id");
    }
    
    public function getcategory() {
    	return $this->belongsTo(CategoryModel::class, "category_id");
    }

    public function getlanguage() {
     	return $this->belongsTo(LanguageModel::class, "language_id");
    }

    public function getlevel() {
     	return $this->belongsTo(LevelOfStudentModel::class, "level_id");
    }

    public function getrequest() {
     	return $this->belongsTo(RequestModel::class, "request_id");
    }

    public function get_lesson_type() {
       return $this->belongsTo(RequestTypeModel::class, "lesson_type_id");
    }

    public function getImage() {
        if(!empty($this->profile_pic) && file_exists('upload/profile/'.$this->profile_pic)) {
           return url('upload/profile/'.$this->profile_pic);
        }
        else {
           return url('upload/profile/iconprofile.png');
        }
    }

    public function getstatus() {
        return $this->belongsTo(StatusModel::class, "status");
    }

    public function getVideoCourse() {
         if(!empty($this->course_video_new) && file_exists('upload/course/'.$this->course_video_new)) {
            return url('upload/course/'.$this->course_video_new);
         }
         else {
            return '';
         }
    }

     public function getnote()
    {
        if(Auth::user()->is_admin == 1)
        {
            return $this->hasMany(OrderCourseNoteModel::class, "offer_id")->where('type','=','offer')->orderBy('id','desc');
        }
        else
        {
            return $this->hasMany(OrderCourseNoteModel::class, "offer_id")->where('type','=','offer')->where('user_id','=',Auth::user()->id)->orderBy('id','desc');    
        }
        
    }

    public function gethomework()
    {
        return $this->hasMany(OrderCourseHomeWorkModel::class, "offer_id")->where('type','=','offer')->orderBy('id','desc');
    }

    public function gethomeworksubmited()
    {
        return $this->hasMany(OrderCourseHomeWorkModel::class, "offer_id")->orderBy('id','desc')->where('type','=','offer')->where('is_complete','=',1);
    }


}
