<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\UsersModel;
use App\Models\CategoryModel;
use App\Models\LevelOfStudentModel;
use App\Models\LanguageModel;
use App\Models\TransactionModel;
use App\Models\OrderCourseModel;
use App\Models\OrderCourseHomeWorkModel;

use App\Models\CourseModel;
use App\Models\UserReviewModel;

use App\Models\ChatModel;

use App\Models\SubjectModel;
use App\Models\CourseLessonModel;
use App\Models\UserLanguageModel;
use App\Models\RequestTypeModel;
use App\Models\RequestModel;
use App\Models\UserQualificationModel;

use App\Models\BookingModel;
use App\Models\PriceModel;
use App\Models\OfferModel;
use Stripe\Stripe;


use Hash;
use File;
use Image;
use DateTimeZone;
use DateTime;

class APIAuthController extends Controller
{
    
	public $token;
	public $setApiKey;

	public function __construct(Request $request) {
		$this->token = !empty($request->header('token'))?$request->header('token'):'';
		$user_id = $this->checkToken();
		if(empty($user_id))
		{
			$json['status']  = false;
			$json['message'] = 'Token expire';
			$json['code'] 	 = 400;
			echo json_encode($json);
			die;
		}

		$this->setApiKey = 'sk_test_D5j27FF4gtD8YFOz0PXKNeDM';

		
	}


	public function checkToken()
	{
		$checkToken = UsersModel::where('token','=',$this->token)->first();
		if(!empty($checkToken))
		{
			return $checkToken->id;
		}
		else
		{
			return '';
		}	
	}

	public function find_tutor_filter(Request $request)
	{
		$user_id = $this->checkToken();
		$result = array();

		// category part
	  	$getcategory = CategoryModel::getCategory();
	  	$category = array();
	  	foreach($getcategory as $value_c) {
	  		$data['id'] = $value_c->id;
	  		$data['category_name'] = $value_c->category_name;
			$category[] = $data;  		
	  	}
	  	$result['category'] = $category;
	  	// end category part

  		// level part
	  	$getleval = LevelOfStudentModel::getLevelOfStudent();
	  	$level = array();
	  	foreach($getleval as $value_l) {
	  		$data_l['id'] = $value_l->id;
	  		$data_l['level_name'] = $value_l->level_of_student_name;
			$level[] = $data_l;  		
	  	}
	  	$result['level'] = $level;
	  	// end level part

	  	// languge part
	  	$getlanguge = LanguageModel::getLanguge();
	  	$languge = array();
	  	foreach($getlanguge as $value_la) {
	  		$data_la['id'] = $value_la->id;
	  		$data_la['language_name'] = $value_la->language_name;
			$languge[] = $data_la;  		
	  	}
	  	$result['languge'] = $languge;
	  	// end languge part

	  	// getRequestType part

	  	$getRequestType = RequestTypeModel::getRequestType();
	  	$RequestType = array();
	  	foreach($getRequestType as $value_rt) {
	  		$data_rt['id'] 					= $value_rt->id;
	  		$data_rt['request_type_name']   = $value_rt->request_type_name;
			$RequestType[] = $data_rt;  		
	  	}
	  	$result['request_type'] = $RequestType;

	  	// end RequestType part


	  	$getprice = PriceModel::getprice();
	  	$PriceType = array();
	  	foreach($getprice as $value_pri) {
	  		$data_price['id'] 		  = $value_pri->id;
	  		$data_price['min_price']  = $value_pri->min_price;
	  		$data_price['max_price']  = $value_pri->max_price;
			$PriceType[] = $data_price;  		
	  	}
	  	$result['price'] = $PriceType;

	  	// end priceType part


  	  	$getbooking = BookingModel::getBooking();
	  	$BookingType = array();
	  	foreach($getbooking as $value_booking) {
	  		$data_booking['id'] 		  = $value_booking->id;
	  		$data_booking['booking_name']  = $value_booking->booking_name;
			$BookingType[] = $data_booking;  		
	  	}
	  	$result['booking'] = $BookingType;

  	 	// end BookingType part
	  	

		$json['status'] = true;
		$json['message'] = 'Record found.';
		$json['result']  = $result;
		
		echo json_encode($json);
	}


	public function app_find_tutor(Request $request) {

		$getrecord = UsersModel::select('users.*');
        $getrecord = $getrecord->join('category','users.category_id','=', 'category.id');

        // Search box Start

        if(!empty($request->lesson_date)) {
            $getrecord = $getrecord->join('course','course.user_id','=', 'users.id');
            $getrecord = $getrecord->join('course_lesson','course_lesson.course_id','=', 'course.id');
            $getrecord = $getrecord->where('course_lesson.lesson_start_date', '>=' , date('Y-m-d'));
            $getrecord = $getrecord->where('course_lesson.lesson_start_date', '=' , $request->lesson_date);
        }

        if(!empty($request->languge_id)) {
        	$getrecord = $getrecord->join('user_language','user_language.user_id','=', 'users.id');
            $getrecord = $getrecord->where('user_language.language_id','=', $request->languge_id);
        }

        if(!empty($request->subject)) {
            $getrecord = $getrecord->where('category.category_name', 'like', '%' . $request->subject . '%');
        }

        if(!empty($request->category_id)) {
            $getrecord = $getrecord->where('users.category_id', '=' ,$request->category_id);
        }

        if(!empty($request->level_id)) {
            $getrecord = $getrecord->where('users.level_of_teacher','=', $request->level_id);
        }

        // Search box End

        $getrecord = $getrecord->where('users.is_admin', '=', '2');
        $getrecord = $getrecord->where('users.status', '=', '1');
        $getrecord = $getrecord->orderBy('users.id', 'desc');
        $getrecord = $getrecord->groupBy('users.id');
        $getrecord = $getrecord->paginate(40);

        if(!empty(count($getrecord)))
        {
        	$result = array();

        	foreach($getrecord as $value)
        	{
        		$data = $this->getProfileUser($value->id);
        		$result[] = $data;
        	}

        	$page = 0;
			if(!empty($getrecord->nextPageUrl()))
            {
	              $parse_url =parse_url($getrecord->nextPageUrl()); 
	              if(!empty($parse_url['query']))
	              {
	                   parse_str($parse_url['query'], $get_array);     
	                   $page = !empty($get_array['page']) ? $get_array['page'] : 0;
	              }
     	    }
			
        	$json['status'] = true;
			$json['message'] = 'Record found.';
			$json['result'] = $result;
			$json['page'] = intval($page);
        }
        else
        {
        	$json['status'] = false;
			$json['message'] = 'Record not found.';
        }

        echo json_encode($json);
	}


	public function getProfileUser($id) {

		$user 						= UsersModel::find($id);
		$json['id']    				= $user->id;
		$json['name']    			= !empty($user->name) ? $user->name : '';
		$json['last_name']    		= !empty($user->last_name) ? $user->last_name : '';
		$json['full_name']    		= !empty($user->getName()) ? $user->getName() : '';
		$json['email']    			= !empty($user->email) ? $user->email : '';
		$json['profile_pic']    	= $user->getImage();
		$json['user_type']    		= !empty($user->is_admin) ? $user->is_admin : '';
		$json['token'] 				= !empty($user->token) ? $user->token : '';
		$json['about_us']    		= !empty($user->about_us) ? $user->about_us : '';
		$json['hour_per_rate']  	= !empty($user->hour_per_rate) ? $user->hour_per_rate : '0';
		$json['experience_of_teacher']  = !empty($user->experience_of_teacher) ? intval($user->experience_of_teacher) : 0;
		$json['category']  			= !empty($user->getcategory->category_name) ? $user->getcategory->category_name : '';
		$json['level_of_teacher']  	= !empty($user->getlevelofstudent->level_of_student_name) ? $user->getlevelofstudent->level_of_student_name : '';

		$level_of_teacher_id = !empty($user->level_of_teacher) ? $user->level_of_teacher : 0;
		$category_id = !empty($user->category_id) ? $user->category_id : 0;
		$json['category_id']  	= intval($category_id);
		$json['level_of_teacher_id']  	= intval($level_of_teacher_id);
		
		$get_langauge = '';
		$langauge_id = '';
        foreach($user->get_langauge as $value_l) {
		  	$get_langauge .= $value_l->getuserlanguage->language_name.', ';
		  	$langauge_id  .= $value_l->getuserlanguage->id.',';
        }

		$json['langauge'] 	 = trim($get_langauge,', ');
		$json['langauge_id'] = trim($langauge_id,',');

		$qualification = array();

		foreach($user->get_qulification as $value_q) {

			$data_q['id'] 				= $value_q->id;
			$data_q['university_name']  = !empty($value_q->university_name) ? $value_q->university_name : '';
			$data_q['degree'] 			= !empty($value_q->degree) ? $value_q->degree : '';
			$data_q['major'] 			= !empty($value_q->major) ? $value_q->major : '';
			$data_q['start_year'] 		= !empty($value_q->start_year) ? $value_q->start_year : '';
			$data_q['end_year'] 		= !empty($value_q->end_year) ? $value_q->end_year : '';
			$data_q['description'] 		= !empty($value_q->description) ? $value_q->description : '';
			$qualification[] = $data_q;

		}

		$json['qualification'] = $qualification;

		$getsubject = SubjectModel::getcoursesubject($id);
		$subject = array();
		foreach($getsubject as $value_s)
		{
			$data_s['name'] = !empty($value_s->subject_name) ? $value_s->subject_name : '';
			$subject[] = $data_s;
		}

		$json['subject'] = $subject;
		return $json;
	}

	public function add_qualification(Request $request) {
		$user_id = $this->checkToken();

		if(!empty($request->university_name) &&
			!empty($request->degree) && 
			!empty($request->major) &&
			!empty($request->start_year) &&
			!empty($request->end_year) &&
			!empty($request->description) ) {

			    $save                   = new UserQualificationModel;       
		        $save->user_id          = trim($user_id);
		        $save->university_name  = trim($request->university_name);
		        $save->degree           = trim($request->degree);
		        $save->major            = trim($request->major);
		        $save->start_year       = trim($request->start_year);
		        $save->end_year         = trim($request->end_year);
		        $save->description      = trim($request->description);
		        $save->save();

		        $json['status'] = true;
				$json['message'] = 'Qualification successfully created.';
		}
		else
		{
			$json['status'] = false;
			$json['message'] = 'Due to some error please try again.';
		}

		echo json_encode($json);

	}


	public function edit_qualification(Request $request) {

		$user_id = $this->checkToken();

		if(!empty($request->university_name) &&
			!empty($request->degree) && 
			!empty($request->major) &&
			!empty($request->start_year) &&
			!empty($request->end_year) &&
			!empty($request->id) && 
			!empty($request->description)) {

			    $save = UserQualificationModel::where('user_id','=',$user_id)->where('id','=',$request->id)->first();       
			    if(!empty($save)) {

		    	    $save->university_name  = trim($request->university_name);
			        $save->degree           = trim($request->degree);
			        $save->major            = trim($request->major);
			        $save->start_year       = trim($request->start_year);
			        $save->end_year         = trim($request->end_year);
			        $save->description      = trim($request->description);
			        $save->save();

			        $json['status'] = true;
					$json['message'] = 'Qualification successfully updated.';

			    }
			    else
			    {
			    	$json['status'] = false;
					$json['message'] = 'Due to some error please try again.';
			    }
		}
		else
		{
			$json['status'] = false;
			$json['message'] = 'Due to some error please try again.';
		}

		echo json_encode($json);

	}

	

	public function list_qualification(Request $request) {
		$user_id = $this->checkToken();
		$user = UsersModel::find($user_id);
		if(!empty(count($user->get_qulification))) {
			$result = array();
			foreach($user->get_qulification as $value_q) {
				$data_q['id'] 				= $value_q->id;
				$data_q['university_name']  = !empty($value_q->university_name) ? $value_q->university_name : '';
				$data_q['degree'] 			= !empty($value_q->degree) ? $value_q->degree : '';
				$data_q['major'] 			= !empty($value_q->major) ? $value_q->major : '';
				$data_q['start_year'] 		= !empty($value_q->start_year) ? $value_q->start_year : '';
				$data_q['end_year'] 		= !empty($value_q->end_year) ? $value_q->end_year : '';
				$data_q['description'] 		= !empty($value_q->description) ? $value_q->description : '';
				$result[] = $data_q;
			}	
			$json['status']  = true;
			$json['message'] = 'Record found';
			$json['result']  = $result;
		}
		else
		{
			$json['status'] = false;
			$json['message'] = 'Record not found';
		}
		
		echo json_encode($json);
	}

	public function delete_qualification(Request $request)
	{
		if(!empty($request->id))
		{
			$user_id = $this->checkToken();
			$delete = UserQualificationModel::where('user_id','=',$user_id)->where('id','=',$request->id)->first();	
			if(!empty($delete))
			{
				$delete = $delete->delete();
				$json['status'] = true;
				$json['message'] = 'Qualification successfully deleted';	
			}
			else
			{
				$json['status'] = false;
				$json['message'] = 'Due to some error please try again.';	
			}
		}
		else
		{
			$json['status'] = false;
			$json['message'] = 'Due to some error please try again.';	
		}

		echo json_encode($json);
	}


	public function add_course(Request $request) {
		$user_id = $this->checkToken();

		if(!empty($request->course_title) &&
			!empty($request->category_id) && 
			!empty($request->language_id) &&
			!empty($request->lesson_type_id) &&
			!empty($request->description) &&
			!empty($request->lesson_per_rate) && 
			!empty($request->start_date) && 
			!empty($request->end_date) && 
			!empty($request->lesson_time) && 
			!empty($request->subject_name)) {

		
			 	  $record = new CourseModel;
		          $record->category_id  = trim($request->category_id);
		          $record->language_id  = trim($request->language_id);
		          $record->user_id 		= $user_id;


		          if(!empty($request->file('image'))) {

		              $ext           = 'jpg';
		              $file          = $request->file('image');
		              $randomStr     = date('YmdHis').str_random(30);
		              $filename      = strtolower($randomStr) . '.' . $ext;
		              $file->move('upload/course/', $filename);
		              $record->image = $filename;

		              $thumb_img = Image::make('upload/course/'.$filename)->resize(400, 400);
		              $thumb_img->save('upload/course/' . $filename, 100);

		          }

		          if(!empty($request->file('course_video'))) {

		               $ext           = $request->file('course_video')->extension();
		               $file          = $request->file('course_video');
		               $randomStr     = date('YmdHis').str_random(30);
		               $filename      = strtolower($randomStr) . '.' . $ext;
		               $file->move('upload/course/', $filename);
		               $record->course_video = $filename;

		          }

		          $record->course_title		 = trim($request->course_title);
		          $record->lesson_type_id 	 = trim($request->lesson_type_id);
		          $record->description 		 = trim($request->description);
		          $record->lesson_per_rate   = !empty($request->lesson_per_rate) ? $request->lesson_per_rate : '0';
		          $record->status = 1;
		          $record->is_notification = 2;
		          $record->save();

		          if(!empty($request->subject_name)) {
          		       $subject_name = json_decode($request->subject_name);
          		       if(!empty($subject_name))
          		       {
	          		       	foreach ($subject_name as $subject_na) {
			                    $subject = new SubjectModel;
			                    $subject->course_id = $record->id;
			                    $subject->subject_name = !empty($subject_na) ? trim($subject_na) :null;
			                    $subject->save();
			                }	
          		       }
		          }


		          if(!empty($request->lesson_time)) {

	                    $start_date = $request->start_date;;
	                    $end_date   = $request->end_date;
	                    $lesson_time = json_decode($request->lesson_time);
	                    for ($i = $start_date; $i <= $end_date ; $i++) { 

							foreach ($lesson_time as $value) {
                     		   	 if(!empty($value->start) && !empty($value->duration) && !empty($i)) {

	                                   $GMT   = new DateTimeZone("GMT");
	                                   $date  = new DateTime($i.' '.$value->start, $GMT );
	                                   $date  = $date->format('Y-m-d h:i:s A');
	                              
	                                   $lesson_date_database = strtotime($date);
	                                   $lesson_time_database = strtotime($date);

	                                   $course_lesson = new CourseLessonModel;
	                                   $course_lesson->lesson_date = $lesson_date_database;
	                                   $course_lesson->lesson_time = $lesson_time_database;

	                                   $course_lesson->lesson_start_date = $i;
	                                   $course_lesson->lesson_end_time   = $value->start;

	                                   $course_lesson->duration    = $value->duration;
	                                   $course_lesson->course_id   = $record->id;
	                                   $course_lesson->save();
								}
	                         }          
	                    }     
		               
		          }

	            $json['status'] = true;
				$json['message'] = 'Course created successfully';

        }

        else {
			$json['status'] = false;
			$json['message'] = 'Due to some error please try again.';
		}

		echo json_encode($json);
	}



	public function course_list(Request $request) {

		$user_id = $this->checkToken();

        $getrecord = CourseModel::orderBy('id', 'desc');
        $getrecord = $getrecord->where('user_id', '=', $user_id);
        $getrecord = $getrecord->where('is_delete', '=', 0);
		if(!empty($request->is_all_list)) {

			$getrecord = $getrecord->paginate(1000);	
			
		}
		else
		{
			$getrecord = $getrecord->paginate(20);		
		}
        

        if(!empty(count($getrecord)))
        {
    		$result = array();
        	foreach($getrecord as $value)
        	{
        		$data['id'] = $value->id;
        		$data['course_title'] = $value->course_title;

        		$data['category_id'] = $value->category_id;
        		$data['category_name'] = $value->getcategory->category_name;
        		$data['language_id'] = $value->language_id;
        		$data['language_name'] = $value->getlanguage->language_name;
        		$data['lesson_type_id'] = $value->lesson_type_id;
        		$data['lesson_type_name'] = $value->get_lesson_type->request_type_name;

        		$data['image'] = $value->getImageCourse();
        		$data['course_video'] = $value->getVideoCourse();
        		$data['lesson_per_rate'] = $value->lesson_per_rate;
        		$data['description'] = $value->description;
        		$data['status'] = $value->getstatus->status_name;
        		$data['timestamp'] = strtotime($value->created_at);

        		$subject = array();

        		foreach ($value->get_course_subject as $subject_name) {
    				$data_s['id'] = 	$subject_name->id;
    				$data_s['subject_name'] = 	$subject_name->subject_name;
    				$subject[] = $data_s;
        		}

        		$data['subject'] = $subject;

        		$course_lesson = array();

        		foreach ($value->get_course_lesson as $course_lesson_name) {

    				$data_c['id'] 				 = 	$course_lesson_name->id;
    				$data_c['lesson_date'] 		 = 	$course_lesson_name->lesson_date;
    				$data_c['lesson_time'] 		 = 	$course_lesson_name->lesson_time;
    				$data_c['lesson_start_date'] = 	$course_lesson_name->lesson_start_date;
    				$data_c['lesson_end_time'] 	 = 	$course_lesson_name->lesson_end_time;
    				$data_c['duration'] 		 = 	$course_lesson_name->duration;
    				$course_lesson[] = $data_c;
        		}

        		$data['course_lesson'] = $course_lesson;

        		$result[] = $data;
        	}

    	   	$page = 0;
			if(!empty($getrecord->nextPageUrl()))
            {
	              $parse_url =parse_url($getrecord->nextPageUrl()); 
	              if(!empty($parse_url['query']))
	              {
	                   parse_str($parse_url['query'], $get_array);     
	                   $page = !empty($get_array['page']) ? $get_array['page'] : 0;
	              }
     	    }
			
        	$json['status'] = true;
			$json['message'] = 'Record found.';
			$json['result'] = $result;
			$json['page'] = intval($page);
        }
        else
        {
        	$json['status'] = false;
			$json['message'] = 'Course not found';
        }

        echo json_encode($json);
	}


	public function edit_course(Request $request) {
		$user_id = $this->checkToken();

		if(!empty($request->course_title) &&
			!empty($request->category_id) && 
			!empty($request->language_id) &&
			!empty($request->lesson_type_id) &&
			!empty($request->description) &&
			!empty($request->lesson_per_rate) && 
			!empty($request->id)) 

			{

			    $record = CourseModel::where('id','=',$request->id)->where('user_id','=',$user_id)->first();
				if(!empty($record))
				{
					$record->category_id  = trim($request->category_id);
			        $record->language_id  = trim($request->language_id);
			        $record->user_id 		= $user_id;


			        if(!empty($request->file('image'))) {

			        	  if(!empty($record->image) && file_exists('upload/course/'. $record->image)) {
			                  unlink('upload/course/'. $record->image);
			              }


			              $ext           = 'jpg';
			              $file          = $request->file('image');
			              $randomStr     = date('YmdHis').str_random(30);
			              $filename      = strtolower($randomStr) . '.' . $ext;
			              $file->move('upload/course/', $filename);
			              $record->image = $filename;

			              $thumb_img = Image::make('upload/course/'.$filename)->resize(400, 400);
			              $thumb_img->save('upload/course/' . $filename, 100);

			          }

			          if(!empty($request->file('course_video'))) {
			          	   if(!empty($record->course_video) && file_exists('upload/course/'. $record->course_video)) {
			                  unlink('upload/course/'. $record->course_video);
			              }

			               $ext           = $request->file('course_video')->extension();
			               $file          = $request->file('course_video');
			               $randomStr     = date('YmdHis').str_random(30);
			               $filename      = strtolower($randomStr) . '.' . $ext;
			               $file->move('upload/course/', $filename);
			               $record->course_video = $filename;

			          }

			          $record->course_title		 = trim($request->course_title);
			          $record->lesson_type_id 	 = trim($request->lesson_type_id);
			          $record->description 		 = trim($request->description);
			          $record->lesson_per_rate   = !empty($request->lesson_per_rate) ? $request->lesson_per_rate : '0';
			          $record->status = 1;
			          $record->is_notification = 2;
			          $record->save();

			          if(!empty($request->subject_name)) {
	          		       $subject_name = json_decode($request->subject_name);
	          		       if(!empty($subject_name))
	          		       {
		          		       	foreach ($subject_name as $subject_na) {
				                    $subject = new SubjectModel;
				                    $subject->course_id = $record->id;
				                    $subject->subject_name = !empty($subject_na) ? trim($subject_na) :null;
				                    $subject->save();
				                }	
	          		       }
			          }


			          if(!empty($request->lesson_time)) {

		                    $start_date = $request->start_date;;
		                    $end_date   = $request->end_date;
		                    $lesson_time = json_decode($request->lesson_time);
		                    for ($i = $start_date; $i <= $end_date ; $i++) { 

								foreach ($lesson_time as $value) {
	                     		   	 if(!empty($value->start) && !empty($value->duration) && !empty($i)) {

		                                   $GMT   = new DateTimeZone("GMT");
		                                   $date  = new DateTime($i.' '.$value->start, $GMT );
		                                   $date  = $date->format('Y-m-d h:i:s A');
		                              
		                                   $lesson_date_database = strtotime($date);
		                                   $lesson_time_database = strtotime($date);

		                                   $course_lesson = new CourseLessonModel;
		                                   $course_lesson->lesson_date = $lesson_date_database;
		                                   $course_lesson->lesson_time = $lesson_time_database;

		                                   $course_lesson->lesson_start_date = $i;
		                                   $course_lesson->lesson_end_time   = $value->start;

		                                   $course_lesson->duration    = $value->duration;
		                                   $course_lesson->course_id   = $record->id;
		                                   $course_lesson->save();
									}
		                         }          
		                    }     
			               
			          }

		            $json['status'] = true;
					$json['message'] = 'Course updated successfully';
				}
				else
				{
					$json['status'] = false;
					$json['message'] = 'Due to some error please try again.';
				}
        }

        else {
			$json['status'] = false;
			$json['message'] = 'Due to some error please try again.';
		}

		echo json_encode($json);

	}


	public function delete_course(Request $request)
	{	
		$user_id = $this->checkToken();
		if(!empty($request->id))
		{
			$record = CourseModel::where('id','=',$request->id)->where('user_id','=',$user_id)->first();
			if(!empty($record))
			{
				$record->is_delete = 1;
				$record->save();

				$subject = SubjectModel::where('course_id', '=', $record->id)->get();
		        foreach ($subject as $value) {
		            $save = SubjectModel::find($value->id);
		            $save->is_delete = 1;
		            $save->save();  
		        }

		        $Lesson = CourseLessonModel::where('course_id', '=', $record->id)->get();
		        foreach ($Lesson as $value_l) {
		            $save_l = CourseLessonModel::find($value_l->id);
		            $save_l->is_delete = 1;
		            $save_l->save();  
		        }      

				$json['status'] = true;
				$json['message'] = 'Course successfully deleted.';
			}
			else
			{
				$json['status'] = false;
				$json['message'] = 'Due to some error please try again.';
			}
		}
		else
		{
			$json['status'] = false;
			$json['message'] = 'Due to some error please try again.';
		}
		echo json_encode($json);
	}

	public function delete_course_date(Request $request) {
		$user_id = $this->checkToken();
	    if(!empty($request->id) && !empty($request->course_id)) {

	     	$record = CourseLessonModel::where('course_id', '=', $request->course_id)->where('id', '=', $request->id)->first();
    	 	if(!empty($record))
    	 	{
    	 		$save_l = CourseLessonModel::find($request->id);
	            $save_l->is_delete = 1;
		        $save_l->save();  

    	 		$json['status'] = true;
				$json['message'] = 'Date successfully deleted.';
    	 	}
    	 	else
    	 	{
    	 		$json['status'] = false;
				$json['message'] = 'Due to some error please try again.';
    	 	}

	    }
		else
		{
			$json['status'] = false;
			$json['message'] = 'Due to some error please try again.';
		}

		echo json_encode($json);
	}

	public function delete_course_subject(Request $request) {
		$user_id = $this->checkToken();
	    if(!empty($request->id) && !empty($request->course_id))  {

    	 	$record = SubjectModel::where('course_id', '=', $request->course_id)->where('id', '=', $request->id)->first();
    	 	if(!empty($record))
    	 	{
    	 		$save_l = SubjectModel::find($request->id);
	            $save_l->is_delete = 1;
		        $save_l->save();  

    	 		$json['status'] = true;
				$json['message'] = 'Subject successfully deleted.';
    	 	}
    	 	else
    	 	{
    	 		$json['status'] = false;
				$json['message'] = 'Due to some error please try again.';
    	 	}
	    }
		else
		{
			$json['status'] = false;
			$json['message'] = 'Due to some error please try again.';
		}

		echo json_encode($json);
		
	}





	public function updatepassword(Request $request) {
		if (!empty($request->new_password) && !empty($request->old_password)) {

			$user_id = $this->checkToken();

			$user = UsersModel::find($user_id);

			if (!empty($user) && !empty($user_id)) {

				$check = Hash::check($request->old_password, $user->password);
				if (!empty($check)) {

					$user->password = Hash::make($request->new_password);
					$user->save();

					$json['status'] = true;
					$json['message'] = 'Password successfully updated.';

				} else {
					$json['status'] = false;
					$json['message'] = 'Current password wrong.';
				}

			} 
			else {
				$json['status'] = false;
				$json['message'] = 'Due to some error please try again!';
			}

		} else {
			$json['status'] = false;
			$json['message'] = 'Due to some error please try again.';
		}

		echo json_encode($json);
	}

	public function update_profile_student(Request $request)
	{

		$user_id = $this->checkToken();

		if(!empty($request->name) && !empty($user_id) && !empty($request->last_name) && !empty($request->about_us))
		{
			$user = UsersModel::find($user_id);

		    $user->name             = trim($request->name);
	        $user->last_name        = trim($request->last_name);
	        $user->level_of_teacher = $request->level_of_teacher;
	        $user->category_id      = $request->category_id;
	        $user->about_us         = trim($request->about_us);
	        
	        $user->save();

	        UserLanguageModel::where('user_id','=',$user_id)->delete();

	        if(!empty($request->language))
	        {
	        	$languge = explode(',', $request->language);
	            foreach ($languge as $language_id) {

	                $lan = new UserLanguageModel;
	                $lan->language_id = $language_id;
	                $lan->user_id = $user_id;
	                $lan->save();
	            }
	        }

	        $json['status'] = true;
			$json['message'] = 'Profile successfully updated.';
			$json['result'] = $this->getProfileUser($user_id);

		}
		else
		{
			$json['status'] = false;
			$json['message'] = 'Due to some error please try again.';
		}

		echo json_encode($json);

	}


	public function update_profile_teacher(Request $request) {

		$user_id = $this->checkToken();

		if(!empty($request->name) && !empty($user_id) && !empty($request->last_name) && !empty($request->about_us))
		{
			$user = UsersModel::find($user_id);

	        $user->name 			= trim($request->name);
	    	$user->last_name 		= trim($request->last_name);
	    	$user->category_id 		= $request->category_id;
	    	$user->level_of_teacher = $request->level_of_teacher;
	    	$user->experience_of_teacher = $request->experience_of_teacher;
	    	$user->hour_per_rate 	= trim($request->hour_per_rate);
	    	$user->about_us 		= trim($request->about_us);
	    	$user->save();

	    	UserLanguageModel::where('user_id','=',$user_id)->delete();

	        if(!empty($request->language))
	        {
	        	$languge = explode(',', $request->language);
	            foreach ($languge as $language_id) {

	                $lan = new UserLanguageModel;
	                $lan->language_id = $language_id;
	                $lan->user_id = $user_id;
	                $lan->save();
	            }
	        }

	        $json['status'] = true;
			$json['message'] = 'Profile successfully updated.';
			$json['result'] = $this->getProfileUser($user_id);

		}
		else
		{
			$json['status'] = false;
			$json['message'] = 'Due to some error please try again.';
		}

		echo json_encode($json);

	}

	public function update_profile_image(Request $request)
	{
		$user_id = $this->checkToken();

	    $user = UsersModel::find($user_id);

        if (!empty($request->file('profile_pic'))) {

            if(!empty($user->profile_pic) && file_exists('upload/profile/'. $user->profile_pic)) {
                unlink('upload/profile/'. $user->profile_pic);
            }

            $ext        = 'jpg';
            $file       = $request->file('profile_pic');
            $randomStr  = str_random(30);
            $filename   = strtolower($randomStr) . '.' . $ext;
            $file->move('upload/profile/', $filename);
            $user->profile_pic = $filename;
            $user->save();

            $thumb_img = Image::make('upload/profile/'.$filename)->resize(400, 400);
            $thumb_img->save('upload/profile/' . $filename, 100);


            $json['status'] = true;
			$json['message'] = 'Profile image successfully updated.';
			$json['result'] = $this->getProfileUser($user_id);
        }
        else
        {
        	$json['status'] = false;
			$json['message'] = 'Due to some error please try again.';
        }

        echo json_encode($json);


	}


	// request part

	public function add_request(Request $request) {

		$user_id = $this->checkToken();
		if(!empty($request->request_title) && 
		  !empty($request->request_type_id) && 
		  !empty($request->level_of_student_id) && 
		  !empty($request->category_id) && 
		  !empty($request->language_id) && 
		  !empty($request->rate_per_hour) && 
		  !empty($request->duration) && 
		  !empty($request->request_description) && 
		  !empty($request->lesson_date) && 
		  !empty($request->lesson_time) 
		) {

			$GMT   = new DateTimeZone("GMT");
	        $date  = new DateTime($request->lesson_date.' '.$request->lesson_time, $GMT);
	        $date  = $date->format('Y-m-d h:i:s A');
	                              
	        $lesson_date_database = strtotime($date);
	        $lesson_time_database = strtotime($date);

	        $record = new RequestModel;
	        $record->user_id             = $user_id;
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

            $json['status'] = true;
			$json['message'] = 'Request successfully created.';		
		}
		else
		{
			$json['status'] = false;
			$json['message'] = 'Due to some error please try again.';
		}

		echo json_encode($json);
	}

	public function request_list(Request $request)
	{
		$user_id = $this->checkToken();
		$getrecord = RequestModel::where('is_delete','=','0')->where('user_id','=',$user_id)->orderBy('id','desc')->paginate(20);
		if(!empty(count($getrecord)))
		{
			$result = array();

			foreach ($getrecord as $value) {

				$data['id'] 					= $value->id;
				$data['request_title'] 			= $value->request_title;

				$data['request_type_id'] 		= intval($value->request_type_id);
				$data['level_of_student_id'] 	= intval($value->level_of_student_id);
				$data['category_id'] 			= intval($value->category_id);
				$data['language_id'] 			= intval($value->language_id);

				$data['request_type_id_name'] 	  =  ucfirst(!empty($value->getrequesttype->request_type_name)?$value->getrequesttype->request_type_name: '');

				$data['level_of_student_id_name'] = ucfirst(!empty($value->getlevelofstudent->level_of_student_name)?$value->getlevelofstudent->level_of_student_name: '');

				$data['category_id_name'] 		= ucfirst(!empty($value->getcategory->category_name)?$value->getcategory->category_name: '');

				$data['language_id_name'] 		= ucfirst(!empty($value->getlanguage->language_name)?$value->getlanguage->language_name: '');


				$data['rate_per_hour'] 			= intval($value->rate_per_hour);
				$data['duration'] 				= intval($value->duration);
				$data['request_description'] 	= $value->request_description;
				$data['lesson_date'] 			= $value->lesson_date;
				$data['lesson_time'] 			= $value->lesson_time;
				$data['lesson_date'] 			= $value->lesson_date;
				$data['lesson_time'] 			= $value->lesson_time;
				$data['lesson_start_date'] 		= $value->lesson_start_date;
				$data['lesson_start_time'] 		= $value->lesson_start_time;
				$result[] = $data;

			}

			$page = 0;
			if(!empty($getrecord->nextPageUrl()))
            {
	              $parse_url =parse_url($getrecord->nextPageUrl()); 
	              if(!empty($parse_url['query']))
	              {
	                   parse_str($parse_url['query'], $get_array);     
	                   $page = !empty($get_array['page']) ? $get_array['page'] : 0;
	              }
     	    }
			
        	$json['status'] = true;
			$json['message'] = 'Record found.';
			$json['result'] = $result;
			$json['page'] = intval($page);
		}
		else
		{
			$json['status'] = false;
			$json['message'] = 'Record not found';
		}
		echo json_encode($json);

	}


	public function edit_request(Request $request) {

		$user_id = $this->checkToken();
	    if(!empty($request->request_title) && 
		  !empty($request->request_type_id) && 
		  !empty($request->level_of_student_id) && 
		  !empty($request->category_id) && 
		  !empty($request->language_id) && 
		  !empty($request->rate_per_hour) && 
		  !empty($request->duration) && 
		  !empty($request->request_description) && 
		  !empty($request->lesson_date) && 
		  !empty($request->lesson_time) &&
		  !empty($request->id) 
		) {

			$GMT   = new DateTimeZone("GMT");
	        $date  = new DateTime($request->lesson_date.' '.$request->lesson_time, $GMT);
	        $date  = $date->format('Y-m-d h:i:s A');
	                              
	        $lesson_date_database = strtotime($date);
	        $lesson_time_database = strtotime($date);

	        $record = RequestModel::where('user_id', '=', $user_id)->where('id', '=', $request->id)->first();
        	if(!empty($record))
        	{
    		    $record->user_id             = $user_id;
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
		        $record->save();

	            $json['status'] = true;
				$json['message'] = 'Request successfully updated.';		
        	}
        	else
        	{
        		$json['status'] = false;
				$json['message'] = 'Due to some error please try again.';
        	}
	      
		}
		else
		{
			$json['status'] = false;
			$json['message'] = 'Due to some error please try again.';
		}

		echo json_encode($json);
	}


	public function delete_request(Request $request) {
		$user_id = $this->checkToken();
	    if(!empty($request->id)) 
	    {
    	 	$record = RequestModel::where('user_id', '=', $user_id)->where('id', '=', $request->id)->first();
    	 	if(!empty($record))
    	 	{
    	 		$record->is_delete = 1;
				$record->save();

    	 		$json['status'] = true;
				$json['message'] = 'Request successfully deleted.';
    	 	}
    	 	else
    	 	{
    	 		$json['status'] = false;
				$json['message'] = 'Due to some error please try again.';
    	 	}
	    }
		else
		{
			$json['status'] = false;
			$json['message'] = 'Due to some error please try again.';
		}

		echo json_encode($json);
	}



	public function app_find_student(Request $request) {

	    $getrecord = RequestModel::select('request.*');
        $getrecord = $getrecord->join('users','users.id','=', 'request.user_id');
        $getrecord = $getrecord->join('category','users.category_id','=', 'category.id');

       //  Search Box Start

        if(!empty($request->subject)) {
            $getrecord = $getrecord->where('category.category_name', 'like', '%' . $request->subject . '%');
        }

        if(!empty($request->find_by_date)) {
            $getrecord = $getrecord->where('request.lesson_start_date', '=' , $request->find_by_date);
        }

        if(!empty($request->language_id)) {
           $getrecord = $getrecord->where('request.language_id', '=', $request->language_id);
        }

        if(!empty($request->category_id)) {
           $getrecord = $getrecord->where('request.level_of_student_id', '=', $request->level_of_student_id);
        }

        if(!empty($request->category_id)) {
           $getrecord = $getrecord->where('request.category_id', '=', $request->category_id); 
        }

        if(!empty($request->price_id)) {
          	$getprice = PriceModel::find($request->price_id);
	        $getrecord = $getrecord->where('request.rate_per_hour','>=', $getprice->min_price);
	        $getrecord = $getrecord->where('request.rate_per_hour','<=', $getprice->max_price);
        }

        //  Search Box End
        $getrecord = $getrecord->where('request.lesson_start_date', '>=', date('Y-m-d'));
        $getrecord = $getrecord->where('request.status', '=', '2');
        $getrecord = $getrecord->where('users.status', '=', '1');
      
        $getrecord = $getrecord->orderBy('request.id', 'desc');
        $getrecord = $getrecord->groupBy('request.id');
        $getrecord = $getrecord->paginate(50);

        $user_id = $this->checkToken();

        if(!empty(count($getrecord)))
        {
        	$result = array();

        	foreach($getrecord as $value)
        	{
        		$getUser = $this->getProfileUser($value->user_id);


        		$data['id'] 		 = $value->id;
        		$data['name'] 		 = $getUser['name'];
        		$data['last_name']   = $getUser['last_name'];
        		$data['profile_pic'] = $getUser['profile_pic'];

        		$data['request_title'] 		 = $value->request_title;
        		$data['request_description'] = $value->request_description;
        		$data['rate_per_hour'] 		 = $value->rate_per_hour;
        		
        		$data['lesson_date'] 		 = $value->lesson_date;
        		$data['lesson_time'] 		 = $value->lesson_time;
        		$data['lesson_start_date'] 	 = $value->lesson_start_date;
        		$data['lesson_start_time'] 	 = $value->lesson_start_time;
        		$data['duration'] 			 = $value->duration;

        		$data['is_offer'] 			 = $value->checkAlreadySent($user_id);
        		$data['language_name'] 	 	 = !empty($value->getlanguage->language_name)?$value->getlanguage->language_name: '';
        		$data['request_type_name'] 	 = !empty($value->getrequesttype->request_type_name)?$value->getrequesttype->request_type_name: '';

        		$data['level_of_student_name'] 	 = !empty($value->getlevelofstudent->level_of_student_name)?$value->getlevelofstudent->level_of_student_name: '';
        		$data['category_name'] 	 = !empty($value->getcategory->category_name)?$value->getcategory->category_name: '';
        		$data['timestamp'] 			 = strtotime($value->created_at);
        		$result[] = $data;
        	}

        	$page = 0;
			if(!empty($getrecord->nextPageUrl()))
            {
	              $parse_url =parse_url($getrecord->nextPageUrl()); 
	              if(!empty($parse_url['query']))
	              {
	                   parse_str($parse_url['query'], $get_array);     
	                   $page = !empty($get_array['page']) ? $get_array['page'] : 0;
	              }
     	    }
			
        	$json['status'] = true;
			$json['message'] = 'Record found.';
			$json['result'] = $result;
			$json['page'] = intval($page);
        }
        else
        {
        	$json['status'] = false;
			$json['message'] = 'Record not found.';
        }

        echo json_encode($json);

	}


	public function app_submit_offer(Request $request) {

		$user_id = $this->checkToken();

		if(!empty($request->course_id) && !empty($request->description) && !empty($request->request_id))  {

		 	$getrecord = RequestModel::find($request->request_id);
		 	if(!empty($getrecord))
		 	{
		 		$offer                   = new OfferModel;
		        $offer->user_id     	= $user_id;
		        $offer->course_id   	= $request->course_id;
		        $offer->category_id 	= $getrecord->category_id;
		        $offer->language_id 	= $getrecord->language_id;
		        $offer->level_id    	= $getrecord->level_of_student_id;
		        $offer->lesson_type_id  = $getrecord->request_type_id;
		        $offer->student_id  	= $getrecord->category_id;
		        $offer->request_id  	= $getrecord->id;
		        $offer->title       	= $getrecord->request_title;
		        $offer->start_date      = $getrecord->lesson_start_date;
		        $offer->start_time      = $getrecord->lesson_start_time;
		        $offer->lesson_date     = $getrecord->lesson_date;
		        $offer->lesson_time     = $getrecord->lesson_time;
		        $offer->duration        = $getrecord->duration;
		        $offer->lesson_per_rate = !empty($request->lesson_per_rate) ? $request->lesson_per_rate : 0;
		        $offer->description     = !empty($request->description) ? $request->description : '';
		        $offer->status          = 2;

		        if(!empty($request->file('course_video'))) {
		             $ext           = $request->file('course_video')->extension();
		             $file          = $request->file('course_video');
		             $randomStr     = date('YmdHis').str_random(30);
		             $filename      = strtolower($randomStr) . '.' . $ext;
		             $file->move('upload/course/', $filename);
		             $offer->course_video_new = $filename;
		        }

		        $offer->save();

		    	$json['status'] = true;
				$json['message'] = 'Offer successfully sent.';
		 	}
		 	else
		 	{
		 		$json['status'] = false;
				$json['message'] = 'Due to some error please try again.';	
		 	}	      
		}
		else
		{
			$json['status'] = false;
			$json['message'] = 'Due to some error please try again.';	
		}
		echo json_encode($json);        

	}


	// app_get_student

	public function app_get_student(Request $request) {
		$user_id = $this->checkToken();

		$user = UsersModel::getUsersIndividual(3);
		$result = array();

		foreach ($user as $value) {
			$data['id']	= !empty($value->id) ? $value->id : '';
			$data['name']	= !empty($value->name) ? $value->name : '';
			$data['last_name']	= !empty($value->last_name) ? $value->last_name : '';
			$result[] = $data;
		}

		$json['status'] = true;
		$json['message'] = 'Record found';
		$json['result'] = $result;

		echo json_encode($json);

	}


	// start offer teacher side

	public function app_get_offer_teacher(Request $request) {

		$user_id = $this->checkToken();

	    $getrecord = OfferModel::where('user_id', '=', $user_id)->orderBy('id', 'desc');
        $getrecord = $getrecord->where('is_delete', '=', 0);
        $getrecord = $getrecord->paginate(50);

		$result = array();

		foreach ($getrecord as $value) {
			$data['id']	= $value->id;
			$data['name']	= ucfirst(!empty($value->getstudent->name)?$value->getstudent->name: '');
			$data['last_name']	= ucfirst(!empty($value->getstudent->last_name)?$value->getstudent->last_name: '');
			$data['profile_pic']	= $value->getstudent->getImage();
			
			$data['category_id']	= $value->category_id;
			$data['category_name']	= ucfirst(!empty($value->getcategory->category_name)?$value->getcategory->category_name: '');

			$data['language_id']	= $value->language_id;
			$data['language_name']	= ucfirst(!empty($value->getlanguage->language_name)?$value->getlanguage->language_name: '');

			$data['level_id']	= $value->level_id;
			$data['level_name']	= ucfirst(!empty($value->getlevel->level_of_student_name)?$value->getlevel->level_of_student_name: '');
			
			$data['lesson_type_id']	= $value->lesson_type_id;
			$data['lesson_type_name']	= !empty($value->get_lesson_type->request_type_name) ? $value->get_lesson_type->request_type_name : '';
			$data['title']	= $value->title;
			$data['start_date']	= $value->start_date;
			$data['start_time']	= $value->start_time;
			$data['lesson_date']	= $value->lesson_date;
			$data['lesson_time']	= $value->lesson_time;

			$data['duration']	= $value->duration;
			$data['lesson_per_rate']	= !empty($value->lesson_per_rate) ? $value->lesson_per_rate : '0';
			$data['description']	= $value->description;
			$data['is_payment']	= !empty($value->is_payment) ? intval($value->is_payment) : 0;	
			$data['payment_type']	= !empty($value->is_payment) ? 'Booked' : '';	
			$data['status']	= $value->status;
			$data['status_name']	= $value->getstatus->status_name;
			$data['course_video_new']	= $value->getVideoCourse();	
			
			 
			$data['timestamp']	= strtotime($value->created_at);
			$result[] = $data;
		}

	  	$page = 0;
		if(!empty($getrecord->nextPageUrl()))
        {
              $parse_url =parse_url($getrecord->nextPageUrl()); 
              if(!empty($parse_url['query']))
              {
                   parse_str($parse_url['query'], $get_array);     
                   $page = !empty($get_array['page']) ? $get_array['page'] : 0;
              }
 	    }

		$json['status'] = true;
		$json['message'] = 'Record found';
		$json['result'] = $result;
		$json['page'] = intval($page);

		echo json_encode($json);

	}


	public function app_add_offer_teacher(Request $request) {


		$user_id = $this->checkToken();

		if(!empty($request->student_id) &&
			!empty($request->title) &&
			!empty($request->category_id) &&
			!empty($request->level_id) &&
			!empty($request->language_id) &&
			!empty($request->lesson_per_rate) &&
			!empty($request->lesson_type_id) &&
			!empty($request->lesson_date) &&
			!empty($request->lesson_time) &&
			!empty($request->duration) &&
			!empty($request->description)
		)
		{
			$GMT   = new DateTimeZone("GMT");
	        $date  = new DateTime($request->lesson_date.' '.$request->lesson_time, $GMT);
	        $date  = $date->format('Y-m-d h:i:s A');

	        $lesson_date_database   = strtotime($date);

	        $save                   = new OfferModel;
	        $save->user_id          = $user_id;
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

	        $json['status'] = true;
			$json['message'] = 'Offer successfully created';	

		}
		else
		{
			$json['status'] = false;
			$json['message'] = 'Due to some error please try again.';	
		}

		echo json_encode($json); 

	}

	public function edit_add_offer_teacher(Request $request) {
		$user_id = $this->checkToken();

		if( !empty($request->title) &&
			!empty($request->category_id) &&
			!empty($request->level_id) &&
			!empty($request->language_id) &&
			!empty($request->lesson_per_rate) &&
			!empty($request->lesson_type_id) &&
			!empty($request->lesson_date) &&
			!empty($request->lesson_time) &&
			!empty($request->duration) &&
			!empty($request->description)
		)
		{
			$GMT   = new DateTimeZone("GMT");
	        $date  = new DateTime($request->lesson_date.' '.$request->lesson_time, $GMT);
	        $date  = $date->format('Y-m-d h:i:s A');

	        $lesson_date_database   = strtotime($date);

	        $save                   = OfferModel::where('user_id', '=', $user_id)->where('id', '=', $request->id)->first();
	        if(!empty($save)) {

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

		        $json['status'] = true;
				$json['message'] = 'Offer successfully updated';
	        }
	        else
	        {
	        	$json['status'] = false;
				$json['message'] = 'Due to some error please try again.';	
	        }
		}
		else
		{
			$json['status'] = false;
			$json['message'] = 'Due to some error please try again.';	
		}

		echo json_encode($json); 

	}


	public function app_delete_offer_teacher(Request $request) {
		$user_id = $this->checkToken();
	    if(!empty($request->id)) 
	    {
    	 	$record = OfferModel::where('user_id', '=', $user_id)->where('id', '=', $request->id)->first();
    	 	if(!empty($record))
    	 	{
    	 		$record->is_delete = 1;
				$record->save();

    	 		$json['status'] = true;
				$json['message'] = 'Offer successfully deleted.';
    	 	}
    	 	else
    	 	{
    	 		$json['status'] = false;
				$json['message'] = 'Due to some error please try again.';
    	 	}
	    }
		else
		{
			$json['status'] = false;
			$json['message'] = 'Due to some error please try again.';
		}

		echo json_encode($json);

	}

	// end offer teacher side

	public function app_get_offer_student(Request $request) {

		$user_id = $this->checkToken();

	    $getrecord = OfferModel::where('student_id', '=', $user_id)->orderBy('id', 'desc');
	    $getrecord = $getrecord->where('status', '=', 2);
        $getrecord = $getrecord->where('is_delete', '=', 0);
        $getrecord = $getrecord->paginate(50);

		$result = array();

		foreach ($getrecord as $value) {
			$data['id']	= $value->id;
			$data['name']	= ucfirst(!empty($value->getusers->name)?$value->getusers->name: '');
			$data['last_name']	= ucfirst(!empty($value->getusers->last_name)?$value->getusers->last_name: '');
			$data['profile_pic']	= $value->getusers->getImage();
			
			$data['category_id']	= $value->category_id;
			$data['category_name']	= ucfirst(!empty($value->getcategory->category_name)?$value->getcategory->category_name: '');

			$data['language_id']	= $value->language_id;
			$data['language_name']	= ucfirst(!empty($value->getlanguage->language_name)?$value->getlanguage->language_name: '');

			$data['level_id']	= $value->level_id;
			$data['level_name']	= ucfirst(!empty($value->getlevel->level_of_student_name)?$value->getlevel->level_of_student_name: '');
			
			$data['lesson_type_id']	= $value->lesson_type_id;
			$data['lesson_type_name']	= !empty($value->get_lesson_type->request_type_name) ? $value->get_lesson_type->request_type_name : '';
			$data['title']	= $value->title;
			$data['start_date']	= $value->start_date;
			$data['start_time']	= $value->start_time;
			$data['lesson_date']	= $value->lesson_date;
			$data['lesson_time']	= $value->lesson_time;

			$data['duration']	= $value->duration;
			$data['lesson_per_rate']	= !empty($value->lesson_per_rate) ? $value->lesson_per_rate : '0';
			$data['description']	= $value->description;
			$data['is_payment']	= !empty($value->is_payment) ? intval($value->is_payment) : 0;	
			$data['payment_type']	= !empty($value->is_payment) ? 'Booked' : '';	
			$data['status']	= $value->status;
			$data['status_name']	= $value->getstatus->status_name;
			$data['course_video_new']	= $value->getVideoCourse();	
			
			 
			$data['timestamp']	= strtotime($value->created_at);
			$result[] = $data;
		}

	  	$page = 0;
		if(!empty($getrecord->nextPageUrl()))
        {
              $parse_url =parse_url($getrecord->nextPageUrl()); 
              if(!empty($parse_url['query']))
              {
                   parse_str($parse_url['query'], $get_array);     
                   $page = !empty($get_array['page']) ? $get_array['page'] : 0;
              }
 	    }

		$json['status'] = true;
		$json['message'] = 'Record found';
		$json['result'] = $result;
		$json['page'] = intval($page);

		echo json_encode($json);

	}


	// lession book work

	public function app_lesson_category(Request $request) {
		$user_id = $this->checkToken();
		if(!empty($request->teacher_id))
		{
		 	$getcategory  = CourseModel::getCourseCategory($request->teacher_id);	
		 	$category = array();
		 	foreach($getcategory as $value)
		 	{
		 		$data['id'] = $value->id;
		 		$data['category_name'] = $value->category_name;
		 		$category[] = $data;
		 	}

	 		$result['category'] = $category;

			// level part
		  	$getleval = LevelOfStudentModel::getLevelOfStudent();
		  	$level = array();
		  	foreach($getleval as $value_l) {
		  		$data_l['id'] = $value_l->id;
		  		$data_l['level_name'] = $value_l->level_of_student_name;
				$level[] = $data_l;  		
		  	}
		  	$result['level'] = $level;
		  	// end level part

		  	// getRequestType part

		  	$getRequestType = RequestTypeModel::getRequestType();
		  	$RequestType = array();
		  	foreach($getRequestType as $value_rt) {
		  		$data_rt['id'] 					= $value_rt->id;
		  		$data_rt['request_type_name']   = $value_rt->request_type_name;
				$RequestType[] = $data_rt;  		
		  	}
		  	$result['request_type'] = $RequestType;

		  	// end RequestType part


	  	  	$getbooking = BookingModel::getBooking();
		  	$BookingType = array();
		  	foreach($getbooking as $value_booking) {
		  		$data_booking['id'] 		  = $value_booking->id;
		  		$data_booking['booking_name']  = $value_booking->booking_name;
				$BookingType[] = $data_booking;  		
		  	}
		  	$result['booking'] = $BookingType;



		 	$json['status'] = true;
			$json['message'] = 'Record found';
			$json['result'] = $result;
		}
		else
		{
		    $json['status'] = false;
			$json['message'] = 'Due to some error please try again.';
		}

	  	echo json_encode($json);
	 	 
	}

	public function app_lesson_category_subject(Request $request)
	{
		$user_id = $this->checkToken();

		if(!empty($request->teacher_id) && !empty($request->category_id)) {
            $category_id = $request->category_id;
            $user_id     = $request->teacher_id;

            $getcategory  = CourseModel::getCourseCategorySingle($category_id, $user_id);
            $course_id = array();
            foreach($getcategory as $value)
            {   
                $course_id[] = $value->id;
            }

            $getsubject  = SubjectModel::getCourseCategorySubject($course_id);

            $result = array();

            foreach($getsubject as $subject) {
		  		$data['id'] 		  = $subject->id;
		  		$data['subject_name'] = $subject->subject_name;
				$result[] = $data;  		
		  	}

        	$json['status'] = true;
			$json['message'] = 'Record found';
			$json['result'] = $result;
		}
		else
		{
		    $json['status'] = false;
			$json['message'] = 'Due to some error please try again.';
		}

		echo json_encode($json);

	}

	public function app_get_course_date(Request $request){
		$user_id = $this->checkToken();
		if(!empty($request->teacher_id) && !empty($request->subject_id)) {
		    $user_id    = $request->teacher_id;
	        $getSubject = SubjectModel::find($request->subject_id);
	        $course_id  = !empty($getSubject->course_id)?$getSubject->course_id:'';
	        $getcourse  = CourseModel::find($course_id);
	        $lesson_per_rate = !empty($getcourse->lesson_per_rate) ? $getcourse->lesson_per_rate : '0.00';

	        $result = array();
	        foreach($getcourse->get_course_lesson_date as $value){
        		$data['id'] 		 = $value->id;
        		$data['lesson_time'] = $value->lesson_time;
        		$result[] = $data;
	        }
	        $json['status'] = true;
			$json['message'] = 'Record found';
			$json['result'] = $result;
		}
		else
		{
  			$json['status'] = false;
			$json['message'] = 'Due to some error please try again.';
		}

		echo json_encode($json);
	}


  public function app_get_course_time(Request $request)
    {
    	if(!empty($request->lesson_date_id))
    	{
    		$lesson_date_id   = $request->lesson_date_id;
	        $getdate          = CourseLessonModel::find($lesson_date_id);
	        $getdate          = CourseLessonModel::getCourseTime($getdate->lesson_start_date,$getdate->course_id);

            $result = array();
	        foreach($getdate as $value){
        		$data['id'] 		 = $value->id;
        		$data['lesson_time'] = $value->lesson_time;
        		$data['duration'] = $value->duration;
        		$result[] = $data;
	        }

            $json['status'] = true;
			$json['message'] = 'Record found';
			$json['result'] = $result;
    	}
    	else
    	{
    		$json['status'] = false;
			$json['message'] = 'Due to some error please try again.';
    	}

    	echo json_encode($json);
    }


  	public function app_payment_intent_offer(Request $request) {

  		$user_id = $this->checkToken();

  		if(!empty($request->offer_id))
  		{
  			try {
  				$offer = OfferModel::where('id','=',$request->offer_id)->where('student_id','=',$user_id)->first();
  				if(!empty($offer))
  				{
  					if(!empty($offer->lesson_per_rate))
  					{
						$finalprice = $offer->lesson_per_rate * 100;

						Stripe::setApiKey($this->setApiKey);

			  			$intent = \Stripe\PaymentIntent::create([
			  				"amount" => intval($finalprice),
							"currency" => 'usd',
							'payment_method_types' => ['card'],
						]);

			  			if(!empty($intent->client_secret)) {
							$data['client_secret'] = $intent->client_secret;
							$data['offer_id'] = $request->offer_id;
							$data['amount'] = $offer->lesson_per_rate;
							$json['status'] = true;
							$json['message'] = 'Record found';
							$json['result'] = $data;
			  			}
			  			else
			  			{
			  				$json['status'] = false;
							$json['message'] = 'Due to some error please try again.';
			  			}
  					}
  					else
  					{
  						$offer->is_payment = '1';
						$offer->save();

						$trans 				= new TransactionModel;
						$trans->user_id 	= $offer->user_id;
						$trans->student_id 	= $user_id;
						$trans->offer_id 	= $offer->id;
						$trans->total_amount = '0';
						$trans->trans_id 	= '';
						$trans->amount 		= '0';
						$trans->fee_amount 	= '0';
						$trans->total_amount = '0';
						$trans->type 		= 'offer';
						$trans->save();


						$offerupdate = OfferModel::find($request->offer_id);
						$offerupdate->transaction_id = $trans->id;
						$offerupdate->save();


						$json['status'] = true;
						$json['message'] = 'Offer successfully accepted.';

  					}
  				}
  				else
  				{
					$json['status'] = false;
					$json['message'] = 'Due to some error please try again.';
  				}
	  		} catch (\Exception $e) {
				$json['status'] = false;
				$json['message'] = 'Due to some error please try again.';
	  		}
  		}
  		else
  		{
  			$json['status'] = false;
		    $json['message'] = 'Due to some error please try again.';
  		}

  		echo json_encode($json); 

  	}

  	public function app_offer_payment_status(Request $request) {

  		$user_id = $this->checkToken();

  		if(!empty($request->offer_id) && !empty($request->transaction_id)) {
  			try {
				$transaction = OfferModel::where('id','=',$request->offer_id)->where('student_id','=',$user_id)->first();
				
				if(!empty($transaction))
				{
					\Stripe\Stripe::setApiKey($this->setApiKey);
					$payment_intent = \Stripe\PaymentIntent::retrieve(
				 		$request->transaction_id
					);

					if($payment_intent->status == 'succeeded')
					{
							
						$transaction->is_payment = '1';
						$transaction->trans_id = $request->transaction_id;
						$transaction->save();

						$fee_amount = ($transaction->lesson_per_rate * 15) / 100; 

						$trans 				= new TransactionModel;
						$trans->user_id 	= $transaction->user_id;
						$trans->student_id 	= $user_id;
						$trans->offer_id 	= $transaction->id;
						$trans->total_amount = $transaction->id;
						$trans->trans_id 	= $request->transaction_id;
						$trans->amount 		= $transaction->lesson_per_rate - $fee_amount;
						$trans->fee_amount 	= $fee_amount;
						$trans->total_amount = $transaction->lesson_per_rate;
						$trans->type 		= 'offer';
						$trans->save();


						$OfferModel = OfferModel::find($request->offer_id);
						$OfferModel->transaction_id = $trans->id;
						$OfferModel->save();

						$this->updatewallet($transaction->user_id,$transaction->lesson_per_rate,$fee_amount);


						$json['status'] = true;
						$json['message'] = 'Offer successfully accepted.';
							
					}
					else
					{
						$json['status'] = false;
			    		$json['message'] = "Due to some error please try again.";	
					}
				}
				else
				{
					$json['status'] = false;
					$json['message'] = 'Due to some error please try again.';	
				}
			} catch (\Exception $e) {
				$json['status'] = false;
				$json['message'] = 'Due to some error please try again.';
	  		}
  		}
  		else
  		{
  			$json['status'] = false;
		    $json['message'] = 'Due to some error please try again.';
  		}

  		echo json_encode($json); 

  	}	



  	public function app_payment_intent_course(Request $request) {

  		$user_id = $this->checkToken();

  		if(!empty($request->lesson_id) && 
  			!empty($request->user_id) && 
  			!empty($request->subject_id) && 
  			!empty($request->booking_id) && 
  			!empty($request->level_of_student_id) && 
  			!empty($request->lesson_type_id) && 
  			!empty($request->description) 
  		){
  			try {
	  				$getLesson = CourseLessonModel::find($request->lesson_id);
					if(!empty($getLesson))
	  				{
	  					$getCourse = CourseModel::find($getLesson->course_id);

	  					$order = new OrderCourseModel;
						$order->lesson_id 		= $request->lesson_id;
						$order->course_id 		= $getCourse->id;
						$order->student_id 		= $user_id;
						$order->user_id 		= $request->user_id;
						$order->subject_id 		= $request->subject_id;
						$order->booking_id 		= $request->booking_id;
						$order->level_of_student_id = $request->level_of_student_id;
						$order->lesson_type_id 		= $request->lesson_type_id;
						$order->lesson_per_rate 	= $getCourse->lesson_per_rate;
						$order->description 		= $request->description;
						$order->save();

						$finalprice = $getCourse->lesson_per_rate * 100;

						Stripe::setApiKey($this->setApiKey);

			  			$intent = \Stripe\PaymentIntent::create([
			  				"amount" => intval($finalprice),
							"currency" => 'usd',
							'payment_method_types' => ['card'],
						]);

			  			if(!empty($intent->client_secret)) {
							$data['client_secret'] = $intent->client_secret;
							$data['order_course_id'] = $order->id;
							$data['amount'] = $getCourse->lesson_per_rate;
							$json['status'] = true;
							$json['message'] = 'Record found';
							$json['result'] = $data;
			  			}
			  			else
			  			{
			  				$json['status'] = false;
							$json['message'] = 'Due to some error please try again.';
			  			}
	  				}
	  				else
	  				{
						$json['status'] = false;
						$json['message'] = 'Due to some error please try again.';
	  				}

	  		} 
	  		catch (\Exception $e) 
	  		{
				$json['status'] = false;
				$json['message'] = 'Due to some error please try again.';
	  		}
  		}
  		else
  		{
  			$json['status'] = false;
		    $json['message'] = 'Due to some error please try again.';
  		}

  		echo json_encode($json); 
  	}


  	public function app_course_payment_status(Request $request)
  	{

  		$user_id = $this->checkToken();

  		if(!empty($request->order_course_id) && !empty($request->transaction_id)) {
  			try {
				$transaction = OrderCourseModel::where('id','=',$request->order_course_id)->where('student_id','=',$user_id)->first();
				
				if(!empty($transaction))
				{
					\Stripe\Stripe::setApiKey($this->setApiKey);
					$payment_intent = \Stripe\PaymentIntent::retrieve(
				 		$request->transaction_id
					);

					if($payment_intent->status == 'succeeded')
					{

						$transaction->is_payment = '1';
						$transaction->trans_id = $request->transaction_id;
						$transaction->save();

						$fee_amount = ($transaction->lesson_per_rate * 15) / 100; 

						$trans 				= new TransactionModel;
						$trans->user_id 	= $transaction->user_id;
						$trans->student_id 	= $user_id;
						$trans->order_course_id = $transaction->id;
						$trans->trans_id 	= $request->transaction_id;
						$trans->amount 		= $transaction->lesson_per_rate - $fee_amount;
						$trans->fee_amount 	= $fee_amount;
						$trans->total_amount = $transaction->lesson_per_rate;
						$trans->type 		= 'course';
						$trans->save();

						$OrderCourseModel 				  = OrderCourseModel::find($request->order_course_id);
						$OrderCourseModel->transaction_id = $trans->id;
						$OrderCourseModel->save();


						$this->updatewallet($transaction->user_id,$transaction->lesson_per_rate,$fee_amount);

						$json['status'] = true;
						$json['message'] = 'Thank you! Course successfully booked.';

					}
					else
					{
						$json['status'] = false;
			    		$json['message'] = "Due to some error please try again.";	
					}
				}
				else
				{
					$json['status'] = false;
					$json['message'] = 'Due to some error please try again.';	
				}
			} catch (\Exception $e) {
				$json['status'] = false;
				$json['message'] = 'Due to some error please try again.';
	  		}
  		}
  		else
  		{
  			$json['status'] = false;
		    $json['message'] = 'Due to some error please try again.';
  		}

  		echo json_encode($json); 
  	}




	public function updatewallet($user_id, $amount, $fee_amount) {

		$user 		   = UsersModel::find($user_id);
		$net_income    = !empty($user->net_income) ? $user->net_income : 0;

		$teacheramount = $amount - $fee_amount;

		$total_income  = $net_income + $teacheramount;

		$total_amount = $user->total_amount + $amount;
		$fee_amount =  $user->fee_amount + $fee_amount;

		$user->net_income = $total_income;
		$user->fee_amount = $fee_amount;
		$user->total_amount = $user->total_amount + $amount;
		
		$user->save();
		
	}

	// booked teacher course

	public function app_booked_teacher_course(Request $request) {
		$user_id = $this->checkToken();
  	    $getrecord = OrderCourseModel::getAppWebsiteTeacher($user_id);
  	    $result = array();

  	    foreach ($getrecord as $value) {
    		$data['id'] 			= $value->id;
    		$data['name'] 			= $value->getstudent->name;
    		$data['last_name'] 		= $value->getstudent->last_name;
    		$data['profile_pic'] 	= $value->getstudent->getImage();
    		$data['course_title'] 	= $value->getcourse->course_title;
    		$data['lesson_date'] 	= $value->getlesson->lesson_date;
    		$data['lesson_time'] 	= $value->getlesson->lesson_time;
    		$data['duration'] 		= $value->getlesson->duration;
    		$data['lesson_per_rate'] = $value->lesson_per_rate;
    		$result[]   = $data; 
  	    }


  	    $page = 0;
		if(!empty($getrecord->nextPageUrl()))
        {
              $parse_url =parse_url($getrecord->nextPageUrl()); 
              if(!empty($parse_url['query']))
              {
                   parse_str($parse_url['query'], $get_array);     
                   $page = !empty($get_array['page']) ? $get_array['page'] : 0;
              }
 	    }
		
    	$json['status'] = true;
		$json['message'] = 'Record found.';
		$json['result'] = $result;
		$json['page'] = intval($page);

		echo json_encode($json);

	}

	public function app_teacher_dashboard(Request $request) {
		$user_id = $this->checkToken();
	    $getHomework = OrderCourseModel::getSubmitedHomeworkTeacherDashbaord($user_id);     

	    $homework = array();
	    foreach($getHomework as $value_h) {

	    	$data_h['id'] 				= $value_h->id;
    		$data_h['name'] 			= $value_h->getstudent->name;
    		$data_h['last_name'] 		= $value_h->getstudent->last_name;
    		$data_h['profile_pic'] 		= $value_h->getstudent->getImage();
    		$data_h['title'] 			= $value_h->title;
    		$data_h['lesson_time'] 	= $value_h->complete_date;
    		$data_h['lesson_per_rate'] 	= $value_h->lesson_per_rate;
    		$data_h['student_id'] 		= $value_h->student_id;
    		$homework[] = $data_h; 
	    }

	    $result['homework'] = $homework;

	    $getLesson = OrderCourseModel::getTutorOrderDashboard($user_id);
	    $lesson = array();
	    foreach($getLesson as $value) {
    		$data['id'] 			= $value->id;
    		$data['name'] 			= $value->getstudent->name;
    		$data['last_name'] 		= $value->getstudent->last_name;
    		$data['profile_pic'] 	= $value->getstudent->getImage();
    		$data['course_title'] 	= $value->getcourse->course_title;
    		$data['category_name'] 	= !empty($value->getcourse->getcategory->category_name) ? $value->getcourse->getcategory->category_name : '';
    		$data['lesson_date'] 	= $value->getlesson->lesson_date;
    		$data['lesson_time'] 	= $value->getlesson->lesson_time;
    		$data['duration'] 		= $value->getlesson->duration;
    		$data['lesson_per_rate'] = $value->lesson_per_rate;
    		$lesson[]   = $data; 
	    }

	    $result['lesson'] = $lesson;

	  
	    $json['status'] = true;
		$json['message'] = 'Record found.';
		$json['result'] = $result;

		echo json_encode($json);

	}

	

	public function app_booked_student_course() {
		$user_id = $this->checkToken();
  	    $getrecord = OrderCourseModel::getAppWebsiteStudent($user_id);
  	    $result = array();

  	    foreach ($getrecord as $value) {
    		$data['id'] 			= $value->id;
    		$data['name'] 			= $value->getusers->name;
    		$data['last_name'] 		= $value->getusers->last_name;
    		$data['profile_pic'] 	= $value->getusers->getImage();
    		$data['course_title'] 	= $value->getcourse->course_title;
    		$data['lesson_date'] 	= $value->getlesson->lesson_date;
    		$data['lesson_time'] 	= $value->getlesson->lesson_time;
    		$data['duration'] 		= $value->getlesson->duration;
    		$data['lesson_per_rate'] = $value->lesson_per_rate;
    		$result[]   = $data; 
  	    }


  	    $page = 0;
		if(!empty($getrecord->nextPageUrl()))
        {
              $parse_url =parse_url($getrecord->nextPageUrl()); 
              if(!empty($parse_url['query']))
              {
                   parse_str($parse_url['query'], $get_array);     
                   $page = !empty($get_array['page']) ? $get_array['page'] : 0;
              }
 	    }
		
    	$json['status'] = true;
		$json['message'] = 'Record found.';
		$json['result'] = $result;
		$json['page'] = intval($page);

		echo json_encode($json);	
	}


	public function app_student_dashboard(Request $request) {
		$user_id = $this->checkToken();
	    $getHomework = OrderCourseModel::getSubmitedHomeworkStudentDashbaord($user_id);     

	    $homework = array();
	    foreach($getHomework as $value_h) {
	    	$data_h['id'] 				= $value_h->id;
    		$data_h['name'] 			= $value_h->getusers->name;
    		$data_h['last_name'] 		= $value_h->getusers->last_name;
    		$data_h['profile_pic'] 		= $value_h->getusers->getImage();
    		$data_h['title'] 			= $value_h->title;
    		$data_h['lesson_time'] 		= $value_h->lesson_time;
    		$data_h['lesson_per_rate'] 	= $value_h->lesson_per_rate;
    		$data_h['user_id'] 			= $value_h->user_id;
    		$homework[] = $data_h; 
	    }

	    $result['homework'] = $homework;

	    $getLesson = OrderCourseModel::getStudentOrderDashboard($user_id);
	    $lesson = array();
	    foreach($getLesson as $value) {
    		$data['id'] 			= $value->id;
    		$data['name'] 			= $value->getusers->name;
    		$data['last_name'] 		= $value->getusers->last_name;
    		$data['profile_pic'] 	= $value->getusers->getImage();
    		$data['course_title'] 	= $value->getcourse->course_title;
    		$data['category_name'] 	= !empty($value->getcourse->getcategory->category_name) ? $value->getcourse->getcategory->category_name : '';
    		$data['lesson_date'] 	= $value->getlesson->lesson_date;
    		$data['lesson_time'] 	= $value->getlesson->lesson_time;
    		$data['duration'] 		= $value->getlesson->duration;
    		$data['lesson_per_rate'] = $value->lesson_per_rate;
    		$lesson[]   = $data; 
	    }

	    $result['lesson'] = $lesson;

	  
	    $json['status'] = true;
		$json['message'] = 'Record found.';
		$json['result'] = $result;

		echo json_encode($json);

	}


	public function app_booked_course_detail(Request $request)
	{
		if(!empty($request->id))
		{
			$id = $request->id;
		    $value = OrderCourseModel::where('is_payment','=',1)->where('id','=',$id)->first();    
			if(!empty($value))
			{
				$result = array();

				$result['course_title'] = $value->getcourse->course_title;
				$result['category_name'] = !empty($value->getcourse->getcategory->category_name) ? $value->getcourse->getcategory->category_name : '';

				$result['lesson_time'] = $value->getlesson->lesson_time;
				$result['duration'] = $value->getlesson->duration;
				$result['lesson_per_rate'] = $value->lesson_per_rate;
				$result['lesson_type'] = $value->getlessontype->request_type_name;
				$result['level'] = $value->getlevelname->level_of_student_name;
				$result['status'] = $value->status;
				$result['status_name'] = ($value->status == '1') ? 'Incomplete' : 'Complete';
				$result['description'] = !empty($value->description) ? $value->description : '';
				
				

				// student part
				$student['name'] = !empty( $value->getstudent->name) ? $value->getstudent->name : '';
				$student['last_name'] = !empty($value->getstudent->last_name) ? $value->getstudent->last_name : '';
				$student['profile_pic'] = $value->getstudent->getImage();
				$student['level_of_student_name'] = !empty($value->getstudent->getlevelofstudent->level_of_student_name) ? $value->getstudent->getlevelofstudent->level_of_student_name : '';
				$student['total_rating'] = $value->getstudent->totalRating();
				$student['avg_rating'] = $value->getstudent->averageRating();
				$result['student'] = $student;
				// end student part


				// teacher part
				$teacher['name'] = !empty( $value->getusers->name) ? $value->getusers->name : '';
				$teacher['last_name'] = !empty($value->getusers->last_name) ? $value->getusers->last_name : '';
				$teacher['profile_pic'] = $value->getusers->getImage();
				$teacher['total_rating'] = $value->getusers->totalRating();
				$teacher['avg_rating'] 	= $value->getusers->averageRating();
				$result['teacher'] 		= $teacher;
				// end teacher part


				$submited_homework = array();
			

				foreach($value->gethomework as $value_homework){
					$home['id'] 		 = $value_homework->id;
					$home['title'] 		 = $value_homework->title;
					$home['attachment']  = $value_homework->getattchament();
					$home['is_complete'] = $value_homework->is_complete;
					$home['lesson_time'] = $value_homework->lesson_time;
					$home['description'] = $value_homework->description;
					$submited_homework[] = $home;
				}

				
				$result['submited_homework'] = $submited_homework;



				$completed_homework = array();
			

				foreach($value->gethomeworksubmited as $value_completed){
					$home_c['id'] = $value_completed->id;
					$home_c['title'] = $value_completed->title;
					$home_c['attachment_complete'] = $value_completed->getattachment_complete();
					$home_c['is_complete'] = $value_completed->is_complete;
					$home_c['complete_date'] = $value_completed->complete_date;
					$home_c['description'] = $value_completed->description_complete;
					$completed_homework[] = $home_c;
				}

				$result['completed_homework'] = $completed_homework;

				$json['status'] = true;
		    	$json['message'] = 'Success';
		    	$json['result'] = $result;
		    	
			}
			else
			{
				$json['status'] = false;
		    	$json['message'] = 'Due to some error please try again.';
			}
		}
		else
		{
			$json['status'] = false;
		    $json['message'] = 'Due to some error please try again.';
  		}

  		echo json_encode($json);

	}


	// submit homework teacher course

	public function app_submit_homework_teacher(Request $request)
	{
		$user_id = $this->checkToken();

		if(!empty($request->lesson_date) && 
			!empty($request->lesson_time) && 
			!empty($request->title) && 
			!empty($request->order_id) && 
			!empty($request->description)) {	

			$GMT   = new DateTimeZone("GMT");
	        $date  = new DateTime($request->lesson_date.' '.$request->lesson_time, $GMT );
	        $date  = $date->format('Y-m-d h:i:s A');
	        $lesson_date = strtotime($date);


	        $homework = new OrderCourseHomeWorkModel;
	        if(!empty($request->type))
	        {
	            $homework->offer_id = $request->order_id;
	            $homework->type = 'offer';
	        } 
	        else
	        {
	            $homework->order_course_id = $request->order_id;  
	        }
	        
	        $homework->title           = trim($request->title);
	        $homework->description     = trim($request->description);
	        $homework->lesson_start_date  = trim($request->lesson_date);
	        $homework->lesson_time_date   = trim($request->lesson_time);
	        $homework->lesson_date     = $lesson_date;
	        $homework->lesson_time     = $lesson_date;
	        
	        if(!empty($request->file('attachment'))) {

	             $ext           = $request->file('attachment')->extension();
	             $file          = $request->file('attachment');
	             $randomStr     = date('YmdHis').str_random(30);
	             $filename      = strtolower($randomStr) . '.' . $ext;
	             $file->move('upload/homework/', $filename);
	             $homework->attachment = $filename;

	        }

	        $homework->save();

	        $json['status'] = true;
	    	$json['message'] = 'Homework successfully created';
		}
		else
		{
			$json['status'] = false;
		    $json['message'] = 'Due to some error please try again.';
		}

		echo json_encode($json);

	}

    public function app_homework_submit_student(Request $request)
    {
    	if(!empty($request->home_work_id) && !empty($request->description))
    	{
    		$homework =  OrderCourseHomeWorkModel::find($request->home_work_id);
	        if(!empty($homework))
	        {
	        	if(!empty($request->file('attachment'))) {
		            $ext           = $request->file('attachment')->extension();
		            $file          = $request->file('attachment');
		            $randomStr     = date('YmdHis').str_random(30);
		            $filename      = strtolower($randomStr) . '.' . $ext;
		            $file->move('upload/homework/', $filename);
		            $homework->attachment_complete = $filename;
		        }

		        $homework->description_complete = trim($request->description);
		        $homework->complete_date        = time();
		        $homework->is_complete          = 1;
		        $homework->save();

	            $json['status'] = true;
		    	$json['message'] = 'Homework successfully submited';
	        }
	        else
	        {
        		$json['status'] = false;
		    	$json['message'] = 'Due to some error please try again.';
	        }	      
    	}
    	else
    	{
    		$json['status'] = false;
		    $json['message'] = 'Due to some error please try again.';
    	}

    	echo json_encode($json);       
    }

    public function app_lesson_complete_student(Request $request) {

		$user_id = $this->checkToken();

		if(!empty($request->rating) && !empty($request->review) && !empty($request->order_id))
		{
			if(!empty($request->type))
	        {
	            $order = OfferModel::find($request->order_id);
	            $order->is_complete = 2;
	            $order->save();

	            $review 			=  new UserReviewModel;
	            $review->review_by  = $user_id;
	            $review->user_id 	= $order->user_id;
	            $review->offer_id 	= $request->order_id;
	            $review->type 		= 'offer';
	            $review->rating 	= $request->rating;
	            $review->review 	= trim($request->review);
	            $review->save();
	        }
	        else
	        {
	            $order = OrderCourseModel::find($request->order_id);
	            $order->status = 2;
	            $order->save();

	            $review 			=  new UserReviewModel;
	            $review->review_by 	= $user_id;
	            $review->user_id 	= $order->user_id;
	            $review->order_course_id = $request->order_id;
	            $review->type 		= 'course';
	            $review->rating 	= $request->rating;
	            $review->review 	= trim($request->review);
	            $review->save();
	        }
	        
	        $release_date              = date('Y-m-d', strtotime(' + 15 days'));
	        $transaction               = TransactionModel::find($order->transaction_id);
	        $transaction->release_date = $release_date;
	        $transaction->save();


	        $user = UsersModel::find($order->user_id);
	        $ratingavg  = $user->averageRating();
	        $user->ratingavg = $ratingavg;
	        $user->save();

	        $json['status'] = true;
		    $json['message'] = 'Course successfully completed';
		}
		else
		{
			$json['status'] = false;
		    $json['message'] = 'Due to some error please try again.';
		}

        echo json_encode($json);     

    }

     // app_booked_offer_detail

    public function app_booked_offer_detail(Request $request)
    {
        if(!empty($request->id))
		{
			$id = $request->id;
		    $value = OfferModel::find($id);    
			if(!empty($value))
			{
				$result = array();

				$result['course_title']    = $value->title;
				$result['category_name']   = !empty($value->getcategory->category_name)?$value->getcategory->category_name: '';
				$result['lesson_time'] 	   = $value->lesson_time;
				$result['duration'] 	   = $value->duration;
				$result['lesson_per_rate'] 	   = $value->lesson_per_rate;
				$result['level_of_student_name'] = ucfirst(!empty($value->getlevel->level_of_student_name)?$value->getlevel->level_of_student_name: '');				
				$result['language_name'] =  ucfirst(!empty($value->getlanguage->language_name)?$value->getlanguage->language_name: '');
				$result['request_type_name'] =  ucfirst(!empty($value->get_lesson_type->request_type_name)?$value->get_lesson_type->request_type_name: '');
				$result['is_complete'] 	= $value->is_complete;
				$result['complete_name'] 	= ($value->is_complete == '1') ? 'Incomplete' : 'Complete';
				$result['is_payment'] 	= $value->is_payment;
				$result['payment_type'] 	= !empty($value->is_payment) ? 'Booked' : '';
				$result['status'] 		= $value->status;
				$result['status_name'] 		= $value->getstatus->status_name;
				$result['description'] = !empty($value->description) ? $value->description : '';

				
				

				// student part
				$student['name'] = !empty( $value->getstudent->name) ? $value->getstudent->name : '';
				$student['last_name'] = !empty($value->getstudent->last_name) ? $value->getstudent->last_name : '';
				$student['profile_pic'] = $value->getstudent->getImage();
				$student['level_of_student_name'] = !empty($value->getstudent->getlevelofstudent->level_of_student_name) ? $value->getstudent->getlevelofstudent->level_of_student_name : '';
				$student['total_rating'] = $value->getstudent->totalRating();
				$student['avg_rating'] = $value->getstudent->averageRating();
				$result['student'] = $student;
				// end student part


				// teacher part
				$teacher['name'] = !empty( $value->getusers->name) ? $value->getusers->name : '';
				$teacher['last_name'] = !empty($value->getusers->last_name) ? $value->getusers->last_name : '';
				$teacher['profile_pic'] = $value->getusers->getImage();
				$teacher['total_rating'] = $value->getusers->totalRating();
				$teacher['avg_rating'] 	= $value->getusers->averageRating();
				$result['teacher'] 		= $teacher;
				// end teacher part


				$submited_homework = array();
			

				foreach($value->gethomework as $value_homework){
					$home['id'] 		 = $value_homework->id;
					$home['title'] 		 = $value_homework->title;
					$home['attachment']  = $value_homework->getattchament();
					$home['is_complete'] = $value_homework->is_complete;
					$home['lesson_time'] = $value_homework->lesson_time;
					$home['description'] = $value_homework->description;
					$submited_homework[] = $home;
				}

				
				$result['submited_homework'] = $submited_homework;



				$completed_homework = array();
			

				foreach($value->gethomeworksubmited as $value_completed){
					$home_c['id'] = $value_completed->id;
					$home_c['title'] = $value_completed->title;
					$home_c['attachment_complete'] = $value_completed->getattachment_complete();
					$home_c['is_complete'] = $value_completed->is_complete;
					$home_c['complete_date'] = $value_completed->complete_date;
					$home_c['description'] = $value_completed->description_complete;
					$completed_homework[] = $home_c;
				}

				$result['completed_homework'] = $completed_homework;

				$json['status'] = true;
		    	$json['message'] = 'Success';
		    	$json['result'] = $result;
		    	
			}
			else
			{
				$json['status'] = false;
		    	$json['message'] = 'Due to some error please try again.';
			}
		}
		else
		{
			$json['status'] = false;
		    $json['message'] = 'Due to some error please try again.';
  		}

  		echo json_encode($json);


    }

    public function app_get_chat_user(Request $request) {
    	$user_id = $this->checkToken();

    	$getuser = ChatModel::getChatUser($user_id);

    	$result = array();
		foreach ($getuser as $value) {
			
    		$data['message'] = $value->message;
    		$data['user_id'] = $value->connect_user_id;

    		$data['name'] = $value->getconnectuser->getName();
    		$data['profile_pic'] = $value->getconnectuser->getImage();
			$data['messagecount'] = $value->app_countmessage($value->connect_user_id,$user_id);
    		$data['timestamp'] = strtotime($value->created_at);
    		$result[] = $data;

    	}    	

		$json['status'] = true;
    	$json['message'] = 'Success';
    	$json['result'] = $result;
    	echo json_encode($json);
	}

	public function app_get_chat_message(Request $request) {
		$receiver_id = $this->checkToken();
		if(!empty($request->user_id)) {
			$sender_id = $request->user_id;

			ChatModel::where('sender_id','=',$sender_id)->where('receiver_id','=',$receiver_id)->update(['status' => '1']);

			$getchat = ChatModel::getChatApp($receiver_id, $sender_id);
			$result = array();

			foreach ($getchat as $value) {
				$data['id'] = $value->id;
				$data['sender_id'] = $value->sender_id;
				$data['receiver_id'] = $value->receiver_id;
				$data['message'] = $value->message;
				$data['timestamp'] = strtotime($value->created_at);
				$result[] = $data;
			}

			$json['status'] = true;
	    	$json['message'] = 'Success';
	    	$json['result'] = $result;
		}
		else
		{
			$json['status'] = false;
		    $json['message'] = 'Message not found.';
  		}

  		echo json_encode($json);

	}

}
