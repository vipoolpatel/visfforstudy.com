<?php

namespace App\Http\Controllers\Backend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\UsersModel;
use App\Models\CategoryModel;
use App\Models\LanguageModel;
use App\Models\LevelOfStudentModel;
use App\Models\OfferModel;
use App\Models\StatusModel;
use App\Models\PriceModel;
use App\Models\RequestTypeModel;
use App\Models\UserPermissionModel;
use App\Notifications\CommonNotification;
use App\Notifications\TeacherNotification;
use App\Notifications\StudentNotification;

use DateTimeZone;
use DateTime;
use Auth;
use Carbon\Carbon;

class OfferController extends Controller
{

    public function offer(Request $request) {
        
        $getrecord = OfferModel::where('user_id', '=', Auth::user()->id)->orderBy('id', 'desc');
        //Search Box Start
        if (!empty($request->title)){
          $getrecord = $getrecord->where('title', 'like', '%' . $request->title . '%');
        }
        if(!empty($request->category_id)) {
            $getrecord = $getrecord->where('category_id', 'like', '%' . $request->category_id . '%'); 
        }
        if(!empty($request->level_id)) {
            $getrecord = $getrecord->where('level_id', 'like', '%' . $request->level_id . '%');
        }
        if(!empty($request->status)) {
            $getrecord = $getrecord->where('status', 'like', '%' . $request->status . '%');
        }
        if(!empty($request->price_id)) {
            $getprice = PriceModel::find($request->price_id);
            $getrecord = $getrecord->where('offers.lesson_per_rate','>=', $getprice->min_price);
            $getrecord = $getrecord->where('offers.lesson_per_rate','<=', $getprice->max_price);
         }
        //Search Box End
        $getrecord = $getrecord->where('is_delete', '=', 0);
        $getrecord = $getrecord->paginate(50);
        $data['getrecord'] = $getrecord;

        $data['getstatus']        = StatusModel::getStatus();
        $data['getlevel']         = LevelOfStudentModel::getLevelOfStudent();
        $data['getcategory']      = CategoryModel::getCategory();
        $data['getlanguge']       = LanguageModel::getLanguge();
        $data['getrequesttype']   = RequestTypeModel::getRequestType();
        $data['getprice']         = PriceModel::getPrice();

        $data['body'] = 'loggedin teacher offer course';
        return view('backend.tutor.offer.list', $data);

    }

    public function add() {

        $data['getCategory'] = CategoryModel::getCategory();
        $data['getLanguage'] = LanguageModel::getLanguge();
        $data['getLevelOfStudent']  = LevelOfStudentModel::getLevelOfStudent();
        $data['getStudent']  = UsersModel::getStudent();
         $data['getrequesttype']   = RequestTypeModel::getRequestType();

        $data['body'] = 'booking loggedin teacher offer';
        return view('backend.tutor.offer.add', $data);

    }

    public function edit($id) {

        $data['getCategory'] = CategoryModel::getCategory();
        $data['getLanguage'] = LanguageModel::getLanguge();
        $data['getLevelOfStudent']  = LevelOfStudentModel::getLevelOfStudent();
        $data['getStudent']  = UsersModel::getStudent();

        $data['getrequesttype']   = RequestTypeModel::getRequestType();

        $data['value']  = OfferModel::find($id);        
        $data['body'] = 'booking loggedin teacher offer';
        return view('backend.tutor.offer.edit', $data);        

    }

    public function view($id) {
        $data['value']  = OfferModel::find($id);

         if ($data['value']->is_notification != '1') {
            $record_update     = OfferModel::find($id);
            $record_update->is_notification  = '0';
            $record_update->save();
        }

        $data['body'] = 'booking loggedin teacher offer';
        return view('backend.common.offer.view', $data);     
        // return view('backend.tutor.offer.view', $data);     
    }



    public function update($id, Request $request) {

        $GMT   = new DateTimeZone("GMT");
        $date  = new DateTime($request->lesson_date.' '.$request->lesson_time, $GMT);
        $date  = $date->format('Y-m-d h:i:s A');

        $lesson_date_database = strtotime($date);

        $save                   = OfferModel::find($id);

        $save->title            = trim($request->title);
        $save->category_id      = trim($request->category_id);
        $save->level_id         = trim($request->level_id);
        $save->language_id      = trim($request->language_id);
        $save->lesson_per_rate  = trim($request->lesson_per_rate);
        $save->lesson_type_id   = trim($request->lesson_type_id);
        $save->start_date       = $request->lesson_date;
        $save->start_time       = $request->lesson_time;
        $save->lesson_date      = $lesson_date_database;
        $save->lesson_time      = $lesson_date_database;
        $save->duration         = trim($request->duration);
        $save->description      = trim($request->description);
        $save->is_notification  = 2;
        $save->save();

       return redirect('tutor/offer')->with('success', 'Offer successfully updated.');
    }



    public function insert(Request $request) {

        $GMT   = new DateTimeZone("GMT");
        $date  = new DateTime($request->lesson_date.' '.$request->lesson_time, $GMT);
        $date  = $date->format('Y-m-d h:i:s A');

        $lesson_date_database   = strtotime($date);
        $save                   = new OfferModel;
        $save->user_id          = Auth::user()->id;
        $save->student_id       = $request->student_id;
        $save->title            = trim($request->title);
        $save->category_id      = trim($request->category_id);
        $save->level_id         = trim($request->level_id);
        $save->language_id      = trim($request->language_id);
        $save->lesson_per_rate  = trim($request->lesson_per_rate);
        $save->lesson_type_id   = trim($request->lesson_type_id);
        $save->start_date       = $request->lesson_date;
        $save->start_time       = $request->lesson_time;
        $save->lesson_date      = $lesson_date_database;
        $save->lesson_time      = $lesson_date_database;
        $save->duration         = trim($request->duration);
        $save->description      = trim($request->description);
        $save->is_notification  = 2;
        $save->save();


// notification work
        $user = UsersModel::getuser(Auth::user()->id);
        $type = 'offer';
        $id = $save->id;
        $message = $user->getName(). ' created new offer';
        $user->notify(new CommonNotification($type, $id, $message));
// notification work


       return redirect('tutor/offer')->with('success', 'Offer successfully created');


    }

    public function delete($id)
    {
        $this->delete_common($id);
        return redirect('tutor/offer')->with('success', 'Record successfully deleted.');
    }


     // Admin side Menu Start

    public function admin_offer_list(Request $request)
    {


         $p_offer_page = UserPermissionModel::getPermission('offer_page');
         if(empty($p_offer_page)) {
            return redirect('admin/dashboard');
         }

        $getrecord = OfferModel::orderBy('id', 'desc');
        // Search Box Start
        if(!empty($request->title)){
          $getrecord = $getrecord->where('title', 'like', '%' . $request->title . '%');
        }
        if(!empty($request->language_id)) {
            $getrecord = $getrecord->where('language_id', 'like', '%' . $request->language_id . '%');
        }
        if(!empty($request->category_id)) {
            $getrecord = $getrecord->where('category_id', 'like', '%' . $request->category_id . '%'); 
        }

        if(!empty($request->level_id)) {
            $getrecord = $getrecord->where('level_id', 'like', '%' . $request->level_id . '%');
        }
        if(!empty($request->status)) {
            $getrecord = $getrecord->where('status', 'like', '%' . $request->status . '%');
        }
        if(!empty($request->price_id)) {
            $getprice = PriceModel::find($request->price_id);
            $getrecord = $getrecord->where('offers.lesson_per_rate','>=', $getprice->min_price);
            $getrecord = $getrecord->where('offers.lesson_per_rate','<=', $getprice->max_price);
         }
        // Search Box End
        $getrecord = $getrecord->where('is_delete', '=', 0);
        $getrecord = $getrecord->paginate(50);
        $data['getrecord'] = $getrecord;
        $data['getstatus']        = StatusModel::getStatus();
        $data['getlevel']         = LevelOfStudentModel::getLevelOfStudent();
        $data['getcategory']      = CategoryModel::getCategory();
        $data['getlanguge']       = LanguageModel::getLanguge();
        $data['getrequesttype']   = RequestTypeModel::getRequestType();
        $data['getprice']         = PriceModel::getPrice();


        return view('backend.admin.offer.list', $data);
    }
   
    public function admin_offer_delete($id)
    {
        $this->delete_common($id);
        return redirect('admin/offer')->with('success', 'Record successfully deleted.');
    }


    public function change_offer_status(Request $request) {
        $order                   = OfferModel::find($request->id);

        $order->status           = $request->status;
        $order->is_notification  = '1';
        $order->save();

        $order = OfferModel::find($request->id);


// notification work 
    $user    = UsersModel::getuser($order->user_id);
    $message = 'Your offer has been '.$order->getstatus->status_name;
    $user->notify(new TeacherNotification('offer', $order->id, $message));

    if($request->status == 2) {
        $student = UsersModel::getuser($order->student_id);
        $student->notify(new StudentNotification('offer', $order->id, 'You have reiceved new offer'));
    }

// notification work

        $json['success'] = 'Status successfully changed';
        echo json_encode($json);
    }
    // Admin side Menu End


    public function delete_common($id) {
        $record  = OfferModel::find($id);
        $record->is_delete = 1;
        $record->save();
    }

    // Student side Menu Start

    public function offer_page(Request $request)
    {
        $getrecord = OfferModel::where('student_id', '=', Auth::user()->id)->where('is_delete', '=', '0')->where('status', '=', 2);

         // Search Box Start
        if(!empty($request->title)){
            $getrecord = $getrecord->where('title', 'like', '%' . $request->title . '%');
           }
        if(!empty($request->language_id)) {
              $getrecord = $getrecord->where('language_id', 'like', '%' . $request->language_id . '%');
           }
        if(!empty($request->category_id)) {
              $getrecord = $getrecord->where('category_id', 'like', '%' . $request->category_id . '%'); 
           }
  
        if(!empty($request->level_id)) {
              $getrecord = $getrecord->where('level_id', 'like', '%' . $request->level_id . '%');
           }
        
        if(!empty($request->price_id)) {
              $getprice = PriceModel::find($request->price_id);
              $getrecord = $getrecord->where('offers.lesson_per_rate','>=', $getprice->min_price);
              $getrecord = $getrecord->where('offers.lesson_per_rate','<=', $getprice->max_price);
           }
          // Search Box End

        $getrecord = $getrecord->orderBy('offers.id','desc');
        $getrecord = $getrecord->paginate(50);
        $data['getrecord'] = $getrecord;

        
        $data['getlevel']         = LevelOfStudentModel::getLevelOfStudent();
        $data['getcategory']      = CategoryModel::getCategory();
        $data['getlanguge']       = LanguageModel::getLanguge();
        $data['getrequesttype']   = RequestTypeModel::getRequestType();
        $data['getprice']         = PriceModel::getPrice();

        
        $data['body'] = 'loggedin student offer course';
        return view('backend.student.offer.list', $data);
    }

    // Stude side Menu End



}
