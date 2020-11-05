<?php

namespace App\Http\Controllers\Backend;

use App\Models\CategoryModel;
use App\Models\LevelOfStudentModel;
use App\Models\LanguageModel;
use App\Models\RequestModel;
use App\Models\PriceModel;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class StudentRequestController extends Controller
{
  public function student_request(Request $request)
  {
      $getrecord = RequestModel::orderBy('id', 'desc');

      // Search Box Start
     
       if(!empty($request->language_id)) {
         $getrecord = $getrecord->where('language_id', 'like', '%' . $request->language_id . '%');
       }

       if(!empty($request->level_of_student_id)) {
         $getrecord = $getrecord->where('level_of_student_id', 'like', '%' . $request->level_of_student_id . '%');
       }

       if(!empty($request->category_id)) {
         $getrecord = $getrecord->where('category_id', 'like', '%' . $request->category_id . '%'); 
       }

       if(!empty($request->price_id)) {
         $getprice   = PriceModel::find($request->price_id);
         $getrecord  = $getrecord->where('request.rate_per_hour','>=', $getprice->min_price);
         $getrecord  = $getrecord->where('request.rate_per_hour','<=', $getprice->max_price); 
       }

      //  Search Box End
     

      $getrecord = $getrecord->where('is_delete','=',0);
      $getrecord = $getrecord->where('status','=',2);
      $getrecord = $getrecord->paginate(50);
      $data['getrecord'] = $getrecord;

      $data['getlanguge']    = LanguageModel::getLanguge();
      $data['getlevel']      = LevelOfStudentModel::getLevelOfStudent();
      $data['getcategory']   = CategoryModel::getCategory();
      $data['getprice']      = PriceModel::getPrice();  

      $data['body'] = 'loggedin teacher request';
      return view('backend.tutor.student_request_list', $data);
  }

}
