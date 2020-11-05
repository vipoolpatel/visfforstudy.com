<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Session;

class LevelOfStudentModel extends Model
{
    protected $table = 'level_of_student';

    static public function getLevelOfStudent()
    {
     	return self::where('is_delete','=',0)->get();
    }

    public function getlevelofstudentname()
    {
    	if(Session::get('locale') == 'ch')
    	{
    		return $this->ch_level_of_student_name;
    	}else
    	{
    		return $this->level_of_student_name;
    	}
    }

}
