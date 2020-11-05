<?php

namespace App\Http\Controllers\Backend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\WalletHistoryModel;
use App\Models\UsersModel;
use App\Models\UserPermissionModel;
use Auth;

class WithdrawRequestController extends Controller
{

    public function withdraw_request()
    {
    	$p_withdraw_request_page = UserPermissionModel::getPermission('withdraw_request_page');
         if(empty($p_withdraw_request_page)) {
            return redirect('admin/dashboard');
         }
    	$data['getrecord']  = WalletHistoryModel::get_history_wallet();
	    $data['body'] = 'loggedin admin request';
	    return view('backend.admin.withdraw_request', $data);
    }

	public function earning_admin_approve($id) {
		$save = WalletHistoryModel::find($id);
		$save->status = 2;
		$save->admin_id = Auth::user()->id;
		$save->save();
		return redirect()->back()->with('success','Withdraw Request sucessfully approved.');
	}

	public function earning_admin_reject($id) {


		$save = WalletHistoryModel::find($id);
		$save->status = 3;
		$save->admin_id = Auth::user()->id;
		$save->save();

		$user = UsersModel::getuser($save->user_id);
		$withdrawn = $user->withdrawn - $save->amount;
		$available_for_withdraw = $user->available_for_withdraw + $save->amount;

		$user->withdrawn = $withdrawn;
		$user->available_for_withdraw = $available_for_withdraw;
		$user->save();
		
		return redirect()->back()->with('success','Withdraw Request sucessfully rejected.');
	}


}
