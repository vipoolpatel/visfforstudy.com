<?php

namespace App\Http\Controllers\Backend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\RequestTypeModel;
use App\Models\LevelOfStudentModel;
use App\Models\LanguageModel;
use App\Models\UserPermissionModel;
use App\Models\BookingModel;


class SettingController extends Controller
{
    public function setting()
    {
         $p_system_setting = UserPermissionModel::getPermission('system_setting');
         if(empty($p_system_setting)) {
            return redirect('admin/dashboard');
         }

        $data['getrequesttype']   = RequestTypeModel::getRequestType();
        $data['getlevel']         = LevelOfStudentModel::getLevelOfStudent();

        $data['body'] = 'loggedin admin';
        return view('backend.admin.setting', $data);
    }
    // Request Type Full form Add edit update Delete Start
    public function request_insert(Request $request)
    {
        $recoder = new RequestTypeModel;
        $recoder->request_type_name    = $request->input('request_type_name');
        $recoder->ch_request_type_name = $request->input('ch_request_type_name');
        $recoder->save();
        $json['success'] = 'Data created Successfully!';
        echo json_encode($json);
    }
    public function update_request_type(Request $request)
    {
        $recoder = RequestTypeModel::find($request->input('edit_id'));

        $recoder->request_type_name    =  $request->input('edit_request_type_name');
        $recoder->ch_request_type_name =  $request->input('edit_ch_request_type_name');
        $recoder->save();

        $json['success'] = 'Data Update Successfully!';
        echo json_encode($json);

        // return $recoder;
    }

    public function request_type_delete($id)
    {
        $recoder = new RequestTypeModel;
        $recoder = RequestTypeModel::find($id);
        //$recoder->delete($id);
        $recoder->is_delete = 1;
        $recoder->save();

        $json['success'] = 'Record has been deleted successfully!';
        echo json_encode($json);
    }
    // Request Type Full form Add edit update Delete End

    // Level of Student Full form Add edit update Delete Start

    public function level_of_student_insert(Request $request)
    {

            $recoder = new LevelOfStudentModel;
            $recoder->level_of_student_name    = $request->input('level_of_student_name');
            $recoder->ch_level_of_student_name = $request->input('ch_level_of_student_name');
            $recoder->save();

        $json['success'] = 'Data created Successfully!';
        echo json_encode($json);
    }


    public function update_level_student(Request $request)
    {
        $recoder = LevelOfStudentModel::find($request->input('edit_id'));

        $recoder->level_of_student_name    = $request->input('edit_level_of_student_name');
        $recoder->ch_level_of_student_name = $request->input('edit_ch_level_of_student_name');
        $recoder->save();

        $json['success'] = 'Data Update Successfully!';
        echo json_encode($json);

        // return $recoder;
    }
    public function level_student_delete($id)
    {
        $recoder = new LevelOfStudentModel;
        $recoder = LevelOfStudentModel::find($id);
        // $recoder->delete($id);
        $recoder->is_delete = 1;
        $recoder->save();

        $json['success'] = 'Record has been deleted successfully!';
        echo json_encode($json);
    }
    // Level of Student Full form Add edit update Delete End


    public function get_data_request(){

        $getrequesttype  = RequestTypeModel::getRequestType();

        $html = '';

        foreach($getrequesttype as $value){

            $html .= '<option data-c="'.$value->ch_request_type_name.'"  data-val="'.$value->request_type_name.'" value="'.$value->id.'">'.$value->request_type_name.' ('.$value->ch_request_type_name.')</option>';
        }

        echo json_encode($html);

    }

    public function get_data_level_Student()
    {
        $getlevel   = LevelOfStudentModel::getLevelOfStudent();
        $html = '';

         foreach($getlevel as $value_l){
           $html.= '<option data-c="'.$value_l->ch_level_of_student_name.'" data-val="'.$value_l->level_of_student_name.'" value="'. $value_l->id.'">'.$value_l->level_of_student_name.' ('.$value_l->ch_level_of_student_name.')</option>';
        }
        echo json_encode($html);
    }
// Language Start
    public function get_data_language()
    {
        $getlanguage = LanguageModel::getLanguge();
        $html = '';


         foreach($getlanguage as $value_ln){
           $html.= '<option data-c="'.$value_ln->ch_language_name.'" data-val="'.$value_ln->language_name.'" value="'. $value_ln->id.'">'.$value_ln->language_name.' ('.$value_ln->ch_language_name.')</option>';
        }
        echo json_encode($html);
    }
    public function language_insert(Request $request)
    {
        $record = LanguageModel::where('language_name','=',$request->language_name)->where('ch_language_name','=',$request->ch_language_name)->count();

        if($record == 0)
        {
            $recound_new = new LanguageModel;
            $recound_new->language_name = $request->language_name;
            $recound_new->ch_language_name = $request->ch_language_name;
            $recound_new->save();

            $json['success'] = true;
            $json['message'] = 'Language created successfully.';
         }
         else
         {
            $json['success'] = false;
            $json['message'] = 'Language Duplicate Please choose another.';
         }
         echo json_encode($json);
    }

    public function update_language_name(Request $request)
    {


        $recoder = LanguageModel::find($request->input('edit_id'));
        if($recoder->language_name != $request->input('edit_language_name') || $recoder->ch_language_name != $request->input('edit_ch_language_name'))
        {

            $record = LanguageModel::where('id','!=',$recoder->id)->where('is_delete','=',0)->where('language_name','=', $request->input('edit_language_name'))->count();
            if($record == 0)
            {
                $recoder->language_name    = $request->input('edit_language_name');
                $recoder->ch_language_name    = $request->input('edit_ch_language_name');

                $recoder->save();
                $json['success'] = true;
                $json['message'] = 'Language updated successfully.';
            }
            else
            {
                $json['success'] = false;
                $json['message'] = 'Language Duplicate Please choose another.';
            }
        }
        else
        {
            $json['success'] = false;
            $json['message'] = 'Language Duplicate Please choose another.';
        }



        echo json_encode($json);
    }

    public function language_delete($id)
    {
        $recoder = new LanguageModel;
        $recoder = LanguageModel::find($id);
        $recoder->is_delete = 1;
        $recoder->save();

        $json['success'] = 'Record has been deleted successfully!';
        echo json_encode($json);
    }

    // Language End

    // Booking Start
    public function booking_insert(Request $request)
    {
      $recoder = new BookingModel;
      $recoder->booking_name    = $request->input('booking_name');
      $recoder->ch_booking_name = $request->input('ch_booking_name');
      $recoder->save();
      $json['success'] = 'Data created Successfully!';
      echo json_encode($json);
    }

    public function get_data_booking()
    {
      $getbooking = BookingModel::getBooking();
      $html = '';

       foreach($getbooking as $value_bo){
         $html.= '<option data-c="'.$value_bo->ch_booking_name.'" data-val="'.$value_bo->booking_name.'" value="'. $value_bo->id.'">'.$value_bo->booking_name.' ('.$value_bo->ch_booking_name.')</option>';
      }
      echo json_encode($html);
    }

    public function update_booking_name(Request $request)
    {
      $recoder = BookingModel::find($request->input('edit_id'));

      $recoder->booking_name    = $request->input('edit_booking_name');
      $recoder->ch_booking_name = $request->input('edit_ch_booking_name');
      $recoder->save();

      $json['success'] = 'Data Update Successfully!';
      echo json_encode($json);
    }

    public function booking_delete($id)
    {
        $recoder = new BookingModel;
        $recoder = BookingModel::find($id);
        $recoder->is_delete = 1;
        $recoder->save();

        $json['success'] = 'Record has been deleted successfully!';
        echo json_encode($json);
    }
    // Booking End

}
