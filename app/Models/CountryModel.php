<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Session;

class CountryModel extends Model
{
    protected $table = 'country';

    static public function getCountry() {
        return self::get();
    }
    public function getnicename()
    {
      if(Session::get('locale') == 'ch'){
        if(!empty($this->ch_nicename))
        {
            return $this->ch_nicename;  
        }
        else
        {
            return $this->nicename;
        }
      }else{
        return $this->nicename;
      }
    }

    public function getImage() {
         if(!empty($this->image_name) && file_exists('upload/country/'.$this->image_name)) {
            return url('upload/country/'.$this->image_name);
         }
         else {
            return url('upload/country/iconprofile.png');
         }
    }


}
