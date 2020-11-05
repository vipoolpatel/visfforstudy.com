<?php

namespace App\Http\Controllers;

use App\Models\RequestModel;
use App\Models\LanguageModel;
use App\Models\LevelOfStudentModel;
use App\Models\RequestTypeModel;
use Illuminate\Http\Request;
use App\Models\PriceModel;
use App\Models\UsersModel;
use App\Models\OfferModel;
use App\Models\SeoModel;
use App\Notifications\CommonNotification;

use Cache;
use Auth;
use File;

class FindStudentController extends Controller
{
    public function find_student(Request $request)
    {


       $getrecord = RequestModel::select('request.*');
       $getrecord = $getrecord->join('users','users.id','=', 'request.user_id');

       //  Search Box Start

       if(!empty($request->find_by_date)) {
          $getrecord = $getrecord->where('request.lesson_start_date', '=' , $request->find_by_date);
       }

       if(!empty($request->language_id)) {
         $getrecord = $getrecord->where('request.language_id', '=', $request->language_id);
       }

       if(!empty($request->level_of_student_id)) {
         $getrecord = $getrecord->where('request.level_of_student_id', '=', $request->level_of_student_id);
       }

       if(!empty($request->request_type_id)) {
         $getrecord = $getrecord->where('request.request_type_id', '=', $request->request_type_id); 
       }

       if(!empty($request->price_id)) {
          $getprice = PriceModel::find($request->price_id);
          $getrecord = $getrecord->where('request.rate_per_hour','>=', $getprice->min_price);
          $getrecord = $getrecord->where('request.rate_per_hour','<=', $getprice->max_price);
       }

       if(!empty($request->online)) {
          $getrecord = $getrecord->whereIn('users.id',explode(',', Cache::get('AvailabeOnline')));
       }

       //  Search Box End
       $getrecord = $getrecord->where('request.lesson_start_date', '>=', date('Y-m-d'));
       $getrecord = $getrecord->where('request.status', '=', '2');
       $getrecord = $getrecord->where('users.status', '=', '1');
      
       $getrecord = $getrecord->orderBy('request.id', 'desc');
       $getrecord = $getrecord->groupBy('request.id');
       $getrecord = $getrecord->paginate(50);

       $data['getrecord'] = $getrecord;


       $data['getprice'] = PriceModel::getprice();
       $data['getlanguge'] = LanguageModel::getLanguge();
       $data['getlevel']   = LevelOfStudentModel::getLevelOfStudent();
       $data['getrequesttype'] = RequestTypeModel::getRequestType();
       $data['body'] = 'profile archive student';

        $getseo = SeoModel::getseo('find-student');
        $data['meta_title'] = !empty($getseo->title) ? $getseo->title : '';
        $data['meta_description'] = !empty($getseo->description) ? $getseo->description : '';
        $data['meta_keyword'] = !empty($getseo->keyword) ? $getseo->keyword : '';


       return view('find_student.find_student', $data);

    }

    public function student_profile($id)
    {
        $data['getrecord'] = RequestModel::find($id);
        if(!empty($data['getrecord']))
        {

          $data['meta_title'] = $data['getrecord']->getusers->getName().' - VISfForStudy';

          $data['body'] = 'profile single student';
          return view('find_student.student_profile', $data);  
        }
        else
        {
          return redirect(url(''));
        }
      	
    }

    public function sendoffer(Request $request)
    {


        $getrecord = RequestModel::find($request->request_id);

        $offer              = new OfferModel;
        $offer->user_id     = Auth::user()->id;
        $offer->course_id   = $request->course_id;
        $offer->category_id = $getrecord->category_id;
        $offer->language_id = $getrecord->language_id;
        $offer->level_id    = $getrecord->level_of_student_id;
        $offer->lesson_type_id    = $getrecord->request_type_id;
        $offer->student_id  = $getrecord->category_id;
        $offer->request_id  = $getrecord->id;
        $offer->title       = $getrecord->request_title;
        $offer->start_date       = $getrecord->lesson_start_date;
        $offer->start_time       = $getrecord->lesson_start_time;
        $offer->lesson_date      = $getrecord->lesson_date;
        $offer->lesson_time      = $getrecord->lesson_time;
        $offer->duration         = $getrecord->duration;
        $offer->lesson_per_rate  = !empty($request->lesson_per_rate) ? $request->lesson_per_rate : 0;
        $offer->description      = !empty($request->description) ? $request->description : '';
        $offer->status           = 2;

        if(!empty($request->file('course_video'))) {
             $ext           = $request->file('course_video')->extension();
             $file          = $request->file('course_video');
             $randomStr     = date('YmdHis').str_random(30);
             $filename      = strtolower($randomStr) . '.' . $ext;
             $file->move('upload/course/', $filename);
             $offer->course_video_new = $filename;
        }


        $offer->save();


// notification work
        $user = UsersModel::getuser(Auth::user()->id);
        $type = 'offer';
        $id = $offer->id;
        $message = $user->getName(). ' created new offer';
        $user->notify(new CommonNotification($type, $id, $message));
// notification work

        return redirect()->back()->with('success','Offer successfully sent.');

    }

    public function getPopupLoaddata(Request $request)
    {

        $value = RequestModel::find($request->id);
        $user  = UsersModel::find(Auth::user()->id);
        
        return response()->json([
          "status" => true,
          "success" => view("find_student._send_offer", [
            "value" => $value,
            "user"  => $user,
          ])->render(),
        ], 200);

    }
}
