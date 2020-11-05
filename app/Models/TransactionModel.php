<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TransactionModel extends Model
{
    protected $table = 'transaction';

    static public function getTransaction($id) {
		return self::where('user_id','=',$id)->orderBy('id','desc')->paginate(50);
    }

    public function getuser() {
   	   return $this->belongsTo(UsersModel::class, "user_id");
    }

    public function getstudent() {
   	   return $this->belongsTo(UsersModel::class, "student_id");
    }

    public function getordercourse(){
        return $this->belongsTo(OrderCourseModel::class, "order_course_id");
    }

    public function getoffer(){
        return $this->belongsTo(OfferModel::class, "offer_id");
    }
    
}
