<?php

namespace App\Http\Controllers\Backend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\UserPermissionModel;
use App\Models\RequestModel;
use App\Models\CourseModel;
use App\Models\OfferModel;
use App\Models\StatusModel;
use App\Models\NotificationModel;
use Auth;




class NotificationController extends Controller
{
  public function notification()
  {

  	$p_notification_page = UserPermissionModel::getPermission('notification_page');
    if(empty($p_notification_page)) {
         return redirect('admin/dashboard');
    }

    $data['getstatus'] =  StatusModel::get();
      
    $data['getrecord'] = NotificationModel::getNotification(Auth::user()->id);

    return view('backend.admin.notification.list', $data);
  }



  public function tutor_notification()
  {
        $data['getrecord'] = NotificationModel::getNotificationTeacher(Auth::user()->id);
        return view('backend.tutor.notification.list', $data);
  }

  public function student_notification()
  {
        $getRequestStudent = RequestModel::orderBy('id', 'desc')->where('is_delete', '=', 0)->where('is_notification', '=', 1)->get();

        $data['getRequestStudent'] = $getRequestStudent;

        $data['getrecord'] = NotificationModel::getNotificationStudent(Auth::user()->id);

        return view('backend.student.notification.list', $data); 
  }

}
