<?php

namespace App\Http\Controllers\Backend;

use App\Models\RequestTypeModel;
use App\Models\LevelOfStudentModel;
use App\Models\CategoryModel;
use App\Models\LanguageModel;
use App\Models\RequestModel;
use App\Models\StatusModel;
use App\Models\PriceModel;
use App\Models\UsersModel;
use App\Models\UserPermissionModel;
use App\Notifications\StudentNotification;
use Auth;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DateTimeZone;
use DateTime;

use App\Notifications\CommonNotification;


class RequestController extends Controller
{
    public function request_page(Request $request)
    {
        $getrecord = RequestModel::where('user_id', '=', Auth::user()->id)->orderBy('id', 'desc');
        //Search Box Start
        if (!empty($request->request_title)){
          $getrecord = $getrecord->where('request_title', 'like', '%' . $request->request_title . '%');
        }
        if(!empty($request->request_type_id)) {
            $getrecord = $getrecord->where('request_type_id', 'like', '%' . $request->request_type_id . '%');
          }
          
        if(!empty($request->category_id)) {
            $getrecord = $getrecord->where('category_id', 'like', '%' . $request->category_id . '%'); 
          }
   
        if(!empty($request->level_of_student_id)) {
            $getrecord = $getrecord->where('level_of_student_id', 'like', '%' . $request->level_of_student_id . '%');
          }
        if(!empty($request->price_id)) {
            $getprice = PriceModel::find($request->price_id);
            $getrecord = $getrecord->where('request.rate_per_hour','>=', $getprice->min_price);
            $getrecord = $getrecord->where('request.rate_per_hour','<=', $getprice->max_price);
         }
   
        //Search Box End
        $getrecord = $getrecord->where('is_delete', '=', 0);
        $getrecord = $getrecord->paginate(45);
        $data['getrecord'] = $getrecord;

        $data['getlevel']         = LevelOfStudentModel::getLevelOfStudent();
        $data['getcategory']      = CategoryModel::getCategory();
        $data['getlanguge']       = LanguageModel::getLanguge();
        $data['getrequesttype']   = RequestTypeModel::getRequestType();

        $data['getprice']         = PriceModel::getPrice();
        
        $data['body'] = 'loggedin student request course';
        return view('backend.student.request_page.list', $data);
    }



    public function request_add()
    {
        $data['getrequesttype'] = RequestTypeModel::getRequestType();
        $data['getlevelofstudent'] = LevelOfStudentModel::getLevelOfStudent();
        $data['getcategory'] = CategoryModel::getCategory();
        $data['getlanguage'] = LanguageModel::getLanguge();

        $data['body'] = 'booking loggedin student request';
        return view('backend.student.request_page.add', $data);
    }
    
    public function request_insert(Request $request)
    {

        $GMT   = new DateTimeZone("GMT");
        $date  = new DateTime($request->lesson_date.' '.$request->lesson_time, $GMT);
        $date  = $date->format('Y-m-d h:i:s A');
                              
        $lesson_date_database = strtotime($date);
        $lesson_time_database = strtotime($date);

        $record = new RequestModel;
        $record->user_id             = Auth::user()->id;
        $record->request_title       = trim($request->request_title);
        $record->request_type_id     = trim($request->request_type_id);
        $record->level_of_student_id = trim($request->level_of_student_id);
        $record->category_id         = trim($request->category_id);
        $record->language_id         = trim($request->language_id);
        $record->rate_per_hour       = !empty($request->rate_per_hour) ? trim($request->rate_per_hour) : '0';
        $record->duration            = !empty($request->duration) ? $request->duration : '0';
        $record->request_description = trim($request->request_description);
        $record->lesson_date         = $lesson_date_database;
        $record->lesson_time         = $lesson_time_database;
        $record->lesson_start_date   = !empty($request->lesson_date) ? $request->lesson_date : null;
        $record->lesson_start_time   = !empty($request->lesson_time) ? $request->lesson_time : null;
        $record->is_notification     = 2;
        $record->status              = 1;
        $record->save();


// notification work

        $user = UsersModel::getuser(Auth::user()->id);
        $type = 'request';
        $id = $record->id;
        $message = $user->getName(). ' created new request';
        $user->notify(new CommonNotification($type, $id, $message));

// notification work

        return redirect('student/request-page')->with('success', 'Request successfully created');

    }

    public function request_delete($id) {

        $record             = RequestModel::find($id);
        $record->is_delete  = 1;
        $record->save(); 

        return redirect()->back()->with('success', 'Request successfully deleted');
        
    }
     public function request_view($id)
    {
        $record = RequestModel::find($id);
       
        $data['value'] = $record;
        $data['body'] = 'booking loggedin student request';
        return view('backend.student.request_page.view', $data);
    }



    public function request_edit($id)
    {
        $record = RequestModel::find($id);
        
        $data['getrequesttype'] = RequestTypeModel::getRequestType();
        $data['getlevelofstudent'] = LevelOfStudentModel::getLevelOfStudent();
        $data['getcategory'] = CategoryModel::getCategory();
        $data['getlanguage'] = LanguageModel::getLanguge();
        
        $data['record'] = $record;
        $data['body'] = 'booking loggedin student request';
        return view('backend.student.request_page.edit', $data);
    }

    public function request_update($id, Request $request) {

        $record = RequestModel::find($id);

        $GMT   = new DateTimeZone("GMT");
        $date  = new DateTime($request->lesson_date.' '.$request->lesson_time, $GMT);
        $date  = $date->format('Y-m-d h:i:s A');
                              
        $lesson_date_database = strtotime($date);
        $lesson_time_database = strtotime($date);

        $record->request_title       = trim($request->request_title);
        $record->request_type_id     = trim($request->request_type_id);
        $record->level_of_student_id = trim($request->level_of_student_id);
        $record->category_id         = trim($request->category_id);
        $record->language_id         = trim($request->language_id);
        $record->rate_per_hour       = !empty($request->rate_per_hour) ? trim($request->rate_per_hour) : '0';
        $record->duration            = !empty($request->duration) ? $request->duration : '0';
        $record->request_description = trim($request->request_description);
        $record->lesson_date         = $lesson_date_database;
        $record->lesson_time         = $lesson_time_database;
        $record->lesson_start_date   = !empty($request->lesson_date) ? $request->lesson_date : null;
        $record->lesson_start_time   = !empty($request->lesson_time) ? $request->lesson_time : null;
        $record->save();

        return redirect('student/request-page')->with('success', 'Request updated successfully.');
    }

    //Admin side request start
    public function admin_request(Request $request)
    {
        $p_request_page = UserPermissionModel::getPermission('request_page');
         if(empty($p_request_page)) {
            return redirect('admin/dashboard');
         }
        $getrecord = RequestModel::orderBy('id', 'desc');
        //Search Box Start
        // if ($request->request_title){
        //     $getrecord = $getrecord->where('request_title', 'like', '%' . $request->request_title . '%');
        // }
        if(!empty($request->request_type_id)) {
         $getrecord = $getrecord->where('request_type_id', 'like', '%' . $request->request_type_id . '%');
        }
        if(!empty($request->language_id)) {
         $getrecord = $getrecord->where('language_id', 'like', '%' . $request->language_id . '%');
        }

        if(!empty($request->category_id)) {
         $getrecord = $getrecord->where('category_id', 'like', '%' . $request->category_id . '%'); 
        }

        if(!empty($request->level_of_student_id)) {
         $getrecord = $getrecord->where('level_of_student_id', 'like', '%' . $request->level_of_student_id . '%');
        }

        if(!empty($request->price_id)) {
        $getprice = PriceModel::find($request->price_id);
        $getrecord = $getrecord->where('request.rate_per_hour','>=', $getprice->min_price);
        $getrecord = $getrecord->where('request.rate_per_hour','<=', $getprice->max_price);
        }
      
        //Search Box End
        $getrecord = $getrecord->where('is_delete','=',0);
        $getrecord = $getrecord->paginate(45);
        $data['getrecord'] = $getrecord;
        $data['getstatus'] = StatusModel::getStatus();
        $data['getlevel']   = LevelOfStudentModel::getLevelOfStudent();
        $data['getcategory']   = CategoryModel::getCategory();
        $data['getlanguge'] = LanguageModel::getLanguge();
        $data['getrequesttype']   = RequestTypeModel::getRequestType();
        $data['getprice']         = PriceModel::getPrice();
        
        $data['body'] = 'loggedin student request course';
        return view('backend.admin.request_page.list', $data);
    }


    public function admin_request_delete($id) 
    {
        $record            = RequestModel::find($id);
        $record->is_delete = 1;
        $record->save(); 

        return redirect('admin/request')->with('success', 'Request successfully deleted');    
    }

    public function change_request_status(Request $request) {
        $order                  = RequestModel::find($request->id);
        $order->status          = $request->status;
        $order->save();

        $order = RequestModel::find($request->id);


        $student = UsersModel::getuser($order->user_id);
        $message = 'Your request has been '.$order->getstatus->status_name;
        $student->notify(new StudentNotification('request', $order->id, $message));

        $json['success'] = 'Status successfully changed';
        echo json_encode($json);
    }

    public function admin_request_view($id)
    {


        $record        = RequestModel::find($id);


        $data['value'] = $record;
        $data['body']  = 'booking loggedin student request';
        return view('backend.admin.request_page.view', $data);
    }

    //Admin side request end
}
