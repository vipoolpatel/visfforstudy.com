<?php

namespace App\Models;
use Session;
use Illuminate\Database\Eloquent\Model;

class StatusModel extends Model
{
    protected $table = 'status';

    static public function getStatus()
    {
        return self::get();
    }

    public function getstatusname()
    {
    	if (Session::get('locale') == 'ch') 
    	{
    		return $this->ch_status_name;
    	}
    	else
    	{
    		return $this->status_name;
    	}
    }
    
}
