<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ReportChatModel extends Model
{
    protected $table = 'report_chat';


    static public function getTotalNewReport() {
    	return self::count();
    }


    static public function getReportDashboard() {
    	return self::orderBy('id','desc')->paginate(4);
    }


    public function getsender() {
    	return $this->belongsTo(UsersModel::class, "sender_id");
    }


    public function getreceiver() {
    	return $this->belongsTo(UsersModel::class, "receiver_id");
    }




}
