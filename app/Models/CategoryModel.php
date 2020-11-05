<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Session;

class CategoryModel extends Model
{
    protected $table = 'category';

    static public function getCategory() {
        return self::get();
    }

    public function getcategoryname() {

        if(Session::get('locale') == 'ch')
        {
            return $this->ch_category_name;
        }
        else
        {
            return $this->category_name;
        }
        
    }    

    public function getcategoryparent() {
		return $this->belongsTo(CategoryModel::class, "parent_id");
    }

    public function getImage() {
         if(!empty($this->category_pic) && file_exists('upload/category/'.$this->category_pic)) {
            return url('upload/category/'.$this->category_pic);
         }
         else {
            return url('assets/img/subject/subject-business.png');
         }
    }

    
}
