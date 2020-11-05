<?php

namespace App\Http\Controllers\Backend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\UserAvailabilityModel;
use App\Models\WeekModel;
use App\Models\WeekSessionModel;
use App\Models\UsersModel;
use Auth;

class AvailabilityController extends Controller
{
	public function my_availability(Request $request)
	{
		$data['getWeek']        = WeekModel::get();
		$data['getWeekSession'] = WeekSessionModel::get();

		return view('backend.tutor.availability.list', $data);
	}



	public function update_my_availability(Request $request)
	{
		
		UserAvailabilityModel::where('user_id','=',Auth::user()->id)->delete();

		if(!empty($request->option))
		{
			foreach($request->option as $value)	
			{
				if(!empty($value['week_id']) && !empty($value['week_session_id']))
				{
					$save = new UserAvailabilityModel;
					$save->week_id  = $value['week_id'];
					$save->week_session_id  = $value['week_session_id'];
	    			$save->user_id = Auth::user()->id;
	    			$save->save();
				}
				
			}
		}

		return redirect()->back()->with('success','Availability successfully save.');

	}
}
