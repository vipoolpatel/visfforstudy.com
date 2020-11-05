<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RequestModel extends Model
{
    protected $table = 'request';



    static public function get_single($id) {
        return self::find($id);
    }


    static public function get_admin_dashboard_request()
    {
      return self::where('status','=','1')->where('is_delete','=','0')->orderBy('id','desc')->limit(5)->get();
    }
    
    public function getProfileRequestLink() {
         return url('student-profile/'.$this->id);
    }

    static public function get_tutor_dashboard_request()
    {
      return self::where('status','=','2')->where('is_delete','=','0')->orderBy('id','desc')->limit(5)->get();
    }

    public function getusers()
    {
      return $this->belongsTo(UsersModel::class, "user_id");
    }
    public function getlanguage()
    {
      return $this->belongsTo(LanguageModel::class, "language_id");
    }
    public function getrequesttype()
    {
      return $this->belongsTo(RequestTypeModel::class, "request_type_id");
    }
    public function getlevelofstudent()
    {
      return $this->belongsTo(LevelOfStudentModel::class, "level_of_student_id");
    }
    public function getcategory()
    {
      return $this->belongsTo(CategoryModel::class, "category_id");
    }

    public function getstatus()
    {
      return $this->belongsTo(StatusModel::class, "status");
    }

    public function checkAlreadySent($user_id) {
        return self::join('offers','offers.request_id','=','request.id')->where('request.id','=',$this->id)->where('offers.user_id','=',$user_id)->count(); 
    }
}
