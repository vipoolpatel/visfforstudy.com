<?php

namespace App\Http\Controllers\Backend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\OrderCourseModel;
use App\Models\UserPermissionModel;
use Auth;

class LessonController extends Controller
{
    public function lesson() {

  	    $data['getOrder'] = OrderCourseModel::getAppWebsiteTeacher(Auth::user()->id);

	    $data['body'] = 'loggedin teacher course';
	    return view('backend.tutor.lesson.list', $data);

    }

    public function view($id) {
        if(Auth::user()->is_admin == 1 || Auth::user()->is_admin == 4)
        {
            $data['value'] = OrderCourseModel::find($id);
        }
        elseif(Auth::user()->is_admin == 2)
        {
            $data['value'] = OrderCourseModel::where('is_payment','=',1)->where('id','=',$id)->where('user_id','=',Auth::user()->id)->first();    
        }
        elseif(Auth::user()->is_admin == 3)
        {
            $data['value'] = OrderCourseModel::where('is_payment','=',1)->where('id','=',$id)->where('student_id','=',Auth::user()->id)->first();    
        }
    	

	    $data['body'] = 'loggedin teacher course';

	    return view('backend.common.lesson.view', $data);
	    
    }


    // Admin Side OrderCourse Start 
      
    public function lesson_list()
    {

        $p_lesson_page = UserPermissionModel::getPermission('lesson_page');
         if(empty($p_lesson_page)) {
            return redirect('admin/dashboard');
         }
        $getrecord = OrderCourseModel::orderBy('id', 'desc');
        $getrecord = $getrecord->paginate(50);
            $data['getOrder'] = $getrecord;
        $data['body'] = 'loggedin teacher course';
        return view('backend.admin.lesson.list', $data);
    }
      // Admin Side OrderCourse End

}
