<?php

namespace App\Http\Controllers\Backend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\ActivityModel;
use App\Models\UserPermissionModel;
use Auth;

class ActivityController extends Controller
{
    public function list(Request $request)
    {
      $p_activity = UserPermissionModel::getPermission('staff_report_page');
      if(empty($p_activity)) {
          return redirect('admin/dashboard');
      }


     
        if (Auth::user()->is_admin == "1"){
              $getrecord = ActivityModel::where('user_id', '=', Auth::user()->id)
                ->orderBy('id', 'desc');
        }else{
            $getrecord = ActivityModel::orderBy('id', 'desc');
        }
    	// Search Box Start
        if (!empty($request->id)) {
            $getrecord = $getrecord->where('id', '=', $request->id);
        }
        if (!empty($request->title)){
        $getrecord = $getrecord->where('title', 'like', '%' . $request->title . '%');
        }
         // Search Box End
    	 // dd(Auth::user()->id);
    	//$getrecord = ActivityModel::get();

    	$getrecord = $getrecord->where('is_delete', '=', 0);
    	$getrecord = $getrecord->paginate(50);
    	$data['getrecord'] = $getrecord;


    	$data['body'] = 'loggedin admin';
    	return view('backend.admin.activity.list', $data);
    }
    public function add()
    {
         $p_activity = UserPermissionModel::getPermission('activity_page');
         if(empty($p_activity)) {
            return redirect('admin/dashboard');
         }


    	$data['body'] = 'booking loggedin student request';
    	return view('backend.admin.activity.add', $data);
    }
    public function insert(Request $request)
    {
    	//dd(request()->all());
    	$save                   = new ActivityModel;
        $save->user_id          = Auth::user()->id;
        $save->title            = trim($request->title);
        $save->description      = trim($request->description);
        $save->save();
        return redirect('admin/activity')->with('success', 'Activity successfully created');

    }

    public function edit($id)
    {
    	$data['value']  = ActivityModel::find($id);  
    	$data['body']   = 'booking loggedin student request';
    	return view('backend.admin.activity.edit', $data);
    }

    public function update($id, Request $request)
    {
    	$update               = ActivityModel::find($id);
    	$update->title        = trim($request->title);
    	$update->description  = trim($request->description);
    	$update->save();

       return redirect('admin/activity')->with('success', 'Activity successfully updated.');
    }
    public function delete($id) {
        $record  = ActivityModel::find($id);
        $record->is_delete = 1;
        $record->save();
        return redirect('admin/activity')->with('success', 'Activity successfully delete.');
    }

}
