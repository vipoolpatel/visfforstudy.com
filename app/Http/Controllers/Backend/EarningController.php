<?php

namespace App\Http\Controllers\Backend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\TransactionModel;
use App\Models\UsersModel;
use App\Models\WalletHistoryModel;
use Auth;
class EarningController extends Controller
{
      public function earning() {
          $data['earning'] = false;
      	  $id = Auth::user()->id;
      	  $data['user'] = UsersModel::getuser($id);
      	  $data['gettransaction'] = TransactionModel::getTransaction($id);
      	  $data['getwallettransaction'] = WalletHistoryModel::getWalletTransaction($id);
	        $data['body'] = 'loggedin earning';
	        return view('backend.earning.list', $data);
      }

      public function earning_admin($id) {
          $data['earning'] = true;
          $data['user'] = UsersModel::getuser($id);
          $data['gettransaction'] = TransactionModel::getTransaction($id);
          $data['getwallettransaction'] = WalletHistoryModel::getWalletTransaction($id);
          $data['body'] = 'loggedin earning';
          return view('backend.earning.list', $data);
      }

      public function paypal_save(Request $request) {
          $id   = Auth::user()->id;
          $user = UsersModel::getuser($id);
          $user->paypal = $request->paypal;
          $user->save();

          return redirect()->back()->with('success','Paypal information successfully save.');
      }

      public function bank_save(Request $request) {
          
          $id   = Auth::user()->id;
          $user = UsersModel::getuser($id);
          $user->bank_name      = $request->bank_name;
          $user->account_number = $request->account_number;
          $user->sort_code      = $request->sort_code;
          $user->name_of_card   = $request->name_of_card;
          $user->save();

          if($user->available_for_withdraw > 0) {

                $history               = new WalletHistoryModel;
                $history->user_id      = $id;
                $history->amount       = $user->available_for_withdraw;
                $history->payment_type = 'bank';

                $history->bank_name      = $request->bank_name;
                $history->account_number = $request->account_number;
                $history->sort_code      = $request->sort_code;
                $history->name_of_card   = $request->name_of_card;

                $history->save();

                $user->withdrawn = $user->withdrawn + $user->available_for_withdraw;
                $user->available_for_withdraw = 0;
                $user->save();

                return redirect()->back()->with('success','Thank you! Bank information successfully save and updated. Your withdrawn successfully.');
          }
          else 
          {
            return redirect()->back()->with('error',' Bank information successfully save and updated. You have no available balance for withdraw.');
          }

      }

      public function paypal_withdrawn(Request $request) {

      		  $id   = Auth::user()->id;
      	    $user = UsersModel::getuser($id);

      	    if($user->available_for_withdraw > 0) 
            {
                $history               = new WalletHistoryModel;
                $history->user_id      = $id;
                $history->amount       = $user->available_for_withdraw;
                $history->payment_type = 'paypal';
                $history->payment_id   = Auth::user()->paypal;
                $history->save();

      	    		$user->withdrawn = $user->withdrawn + $user->available_for_withdraw;
                $user->available_for_withdraw = 0;
      	    		$user->save();

      	    	  return redirect()->back()->with('success','Thank you! Your withdraw successfully.');
      	    }
      	    else 
            {
      	    	return redirect()->back()->with('error','Sorry, You have no available balance for withdraw.');
      	    }

      }


}
