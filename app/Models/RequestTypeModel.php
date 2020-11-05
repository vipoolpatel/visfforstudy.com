<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Session;

class RequestTypeModel extends Model
{
    protected $table = 'request_type';

    static public function getRequestType()
    {
      return self::where('is_delete','=',0)->get();
    }

    public function getrequesttypename()
    {
    	if (Session::get('locale') == 'ch') 
    	{
    		return $this->ch_request_type_name;
    	}
    	else
    	{
    		return $this->request_type_name;
    	}
    }

}
