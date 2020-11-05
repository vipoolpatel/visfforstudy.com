<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class WalletHistoryModel extends Model
{
    protected $table = 'wallet_history';


    static public function getWalletTransaction($id)
    {
    	return self::where('user_id','=',$id)->orderBy('id','desc')->paginate(50);
    }

    static public function get_history_wallet()
    {
    	return self::orderBy('id','desc')->paginate(50);
    }

    static public function get_history_wallet_count($status_id)
    {
    	return self::where('status', '=', $status_id)->count();
    }


    public function getstatus() {
	    return $this->belongsTo(StatusModel::class, "status");
    }

    public function getuser() {
	    return $this->belongsTo(UsersModel::class, "user_id");
    }

    public function getadmin() {
	    return $this->belongsTo(UsersModel::class, "admin_id");
    }
}
