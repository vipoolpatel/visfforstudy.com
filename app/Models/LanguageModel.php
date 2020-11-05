<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Session;
class LanguageModel extends Model
{
    protected $table = 'language';

    static public function getLanguge()
    {
    	return self::where('is_delete','=',0)->get();
    	//return self::get();
    }
    
    public function getlanguagename()
    {
    	if(Session::get('locale') == 'ch'){
    		return $this->ch_language_name;
    	}else{
    		return $this->language_name;
    	}
    }

}
