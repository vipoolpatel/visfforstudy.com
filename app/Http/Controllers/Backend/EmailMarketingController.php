<?php

namespace App\Http\Controllers\Backend;

use App\Models\SubscribeEmailModel;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\UserPermissionModel;

class EmailMarketingController extends Controller
{
    
    public function email_marketing()
    {

        $p_email_marketing_page = UserPermissionModel::getPermission('email_marketing_page');
         if(empty($p_email_marketing_page)) {
            return redirect('admin/dashboard');
         }
    	$getrecord = SubscribeEmailModel::orderBy('id', 'desc');

    	$getrecord = $getrecord->paginate(45);
        $data['getrecord'] = $getrecord;

    	$data['body'] = 'loggedin admin chat';
		return view('backend.admin.email_marketing.add',$data);
    }

    public function delete($id)
    {
    	$record  = SubscribeEmailModel::find($id);
        $record->delete();
        return redirect('admin/email-marketing')->with('success', 'Record successfully deleted!');
    }

}
