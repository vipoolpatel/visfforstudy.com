<?php

namespace App\Http\Controllers\Backend;

use App\Models\SubscribeEmailModel;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class SubscribeEmailController extends Controller
{
    public function subscribe_email(Request $request)
    {
    	$getrecord = SubscribeEmailModel::orderBy('id', 'desc');

        // Search Box start
        if (!empty($request->email)) {
            $getrecord = $getrecord->where('email', 'like', '%' . $request->email . '%');
        }
        // Search Box end

    	$getrecord = $getrecord->paginate(45);
        $data['getrecord'] = $getrecord;
    	$data['body'] = 'loggedin admin';
    	return view('backend.admin.subscribe_email', $data);
    }

    public function delete($id)
    {
    	$record  = SubscribeEmailModel::find($id);
        $record->delete();
        return redirect('admin/subscribe-email')->with('success', 'Record successfully deleted!');
    }
}
