<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OrderCourseHomeWorkModel extends Model
{
    protected $table = 'orders_course_home_work';

    public function getattchament(){
        if(!empty($this->attachment) && file_exists('upload/homework/'.$this->attachment)) 
        {
            return url('upload/homework/'.$this->attachment);    
        }
        else
        {
            return '';   
        }        
    }

     public function getattachment_complete(){
        if(!empty($this->attachment_complete) && file_exists('upload/homework/'.$this->attachment_complete)) 
        {
            return url('upload/homework/'.$this->attachment_complete);    
        }
        else
        {
            return '';   
        }        
    }

    

}
