<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\User;
use App\Models\UsersModel;
use Hash;
use File;
use App\Models\SubjectModel;

use App\Mail\ForgotPasswordMail;
use App\Mail\RegisterMail;
use Mail;

class APIController extends Controller {

	public $token;

	public function __construct(Request $request) {
		$this->token = !empty($request->header('token'))?$request->header('token'):'';
	}


	public function login(Request $request) {
		

		if(!empty($request->email) && !empty($request->password)) {
			if (Auth::attempt(['email' => $request->email, 'password' => $request->password], true)) {
				if(!empty(Auth::user()->status))
				{
					$this->updateToken(Auth::user()->id);
					$json['status'] = true;
					$json['message'] = 'Successfully login';

					$json['result'] = $this->getProfileUser(Auth::user()->id);
				}
				else
				{
					$user = User::find(Auth::user()->id);
					$user->remember_token = str_random(50);
					$user->save();

					$this->send_verification_mail($user);

					$json['status'] = false;
					$json['message'] = 'This email is not verified yet, please check your inbox to activate your account!';
				}
				

		    } else {
		        $json['status'] = false;
				$json['message'] = 'Email and password wrong.';
		    }
		}
		else {
			$json['status'] = false;
			$json['message'] = 'Due to some error please try again.';
		}
		echo json_encode($json);
	}

	public function register(Request $request) {
		
		if (!empty($request->email) && !empty($request->name) && !empty($request->user_type) && !empty($request->password)) {

			if($request->user_type == 2 || $request->user_type == 3) {
				
				$checkemail = UsersModel::where('email', '=', trim($request->email))->count();

				if ($checkemail == '0') {

			      	if (!empty($request->file('profile_pic'))) {

			      		$ext = 'jpg';
		      			$file = $request->file('profile_pic');
		      			$randomStr = str_random(30);
		      			$filename = strtolower($randomStr) . '.' . $ext;
		      			$file->move('upload/profile/', $filename);
		      			$user->profile_pic = $filename;
				  	}

					$user 				= new UsersModel;
					$user->name 		= trim($request->name);
					$user->is_admin 	= trim($request->user_type);
					$user->email 		= trim($request->email);
				    $user->remember_token = str_random(50);
					$user->password 	= Hash::make($request->password);
					$user->save();

					$this->updateToken($user->id);


					$this->send_verification_mail($user);

					$json['status'] = true;
					$json['message'] = 'This email is not verified yet, please check your inbox to activate your account!';
					$json['result'] = $this->getProfileUser($user->id);
				} else {
					$json['status'] = false;
					$json['message'] = 'Email already register please try another.';
				}		
			}
			else
			{
				$json['status'] = false;
				$json['message'] = 'Due to some error please try again.';
			}	
		} else {
			$json['status'] = false;
			$json['message'] = 'Due to some error please try again.';
		}
		echo json_encode($json);
	}



	public function app_forgot_password(Request $request) {
		if(!empty($request->email)) {
			$user =  UsersModel::where('email','=',$request->email)->first();	
			if(!empty($user))
			{
				$user->remember_token = str_random(50);
			    $user->save();
			    Mail::to($user->email)->send(new ForgotPasswordMail($user));

			    $json['status'] = true;
				$json['message'] = 'Password has been reset. and sent to you mailbox';
			}
			else
			{
				$json['status'] = false;
				$json['message'] = 'Email not found in the system.';	
			}
		}
		else {
			$json['status'] = false;
			$json['message'] = 'Due to some error please try again.';
		}
		echo json_encode($json);
	}

   public function send_verification_mail($user) {      
        Mail::to($user->email)->send(new RegisterMail($user));
    }



	public function updateToken($user_id) {

		$randomStr 		   = str_random(40).$user_id;
		$save_token 	   = UsersModel::find($user_id);
		$save_token->token = $randomStr;
		$save_token->save();

	}
	

	public function getProfileUser($id) {

		$user 						= UsersModel::find($id);
		$json['id']    				= $user->id;
		$json['name']    			= !empty($user->name) ? $user->name : '';
		$json['last_name']    		= !empty($user->last_name) ? $user->last_name : '';
		$json['full_name']    		= !empty($user->getName()) ? $user->getName() : '';
		$json['email']    			= !empty($user->email) ? $user->email : '';
		$json['profile_pic']    	= $user->getImage();
		$json['about_us']    		= !empty($user->about_us) ? $user->about_us : '';
		$json['user_type']    		= !empty($user->is_admin) ? $user->is_admin : '';
		$json['token'] 				= !empty($user->token) ? $user->token : '';
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



   	 
}
