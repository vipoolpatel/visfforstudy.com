<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\TransactionModel;
use App\Models\UsersModel;
use App\Models\WalletHistoryModel;

class CronJobController extends Controller
{
    public function paymentRelease(Request $request) {

    	$getTransaction = TransactionModel::where('release_date','=',date('Y-m-d'))->where('is_date','=',0)->get();
    	foreach($getTransaction as $value)
    	{
    		$value->is_date = 1;
    		$value->save();
    		
			$user = UsersModel::find($value->user_id);
			$available_for_withdraw = $user->available_for_withdraw + $value->amount;
			$user->available_for_withdraw = $available_for_withdraw;
			$user->save();
    	}
    }
}
