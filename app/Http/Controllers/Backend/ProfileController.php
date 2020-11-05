<?php

namespace App\Http\Controllers\Backend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Models\RequestTypeModel;
use App\Models\LevelOfStudentModel;
use App\Models\CategoryModel;
use App\Models\LanguageModel;
use App\Models\RequestModel;
use App\Models\UsersModel;
use App\Models\UserLanguageModel;
use App\Models\UserQualificationModel;
use Hash;
use Auth;
use File;
use Image;


class ProfileController extends Controller
{
    public function profile()
    {
    	$data['value'] = UsersModel::find(Auth::user()->id);

        if(Auth::user()->is_admin == 1 || Auth::user()->is_admin == 4)
        {
             $data['body'] = 'booking loggedin student request';
            return view('backend.admin.profile.profile', $data);
        }
        elseif(Auth::user()->is_admin == 2)
        {
    	    $data['getrequesttype'] = RequestTypeModel::getRequestType();
	        $data['getlevelofstudent'] = LevelOfStudentModel::getLevelOfStudent();
	        $data['getcategory'] = CategoryModel::getCategory();
	        $data['getlanguage'] = LanguageModel::getLanguge();

	        $data['body'] = 'booking loggedin student request';
	        return view('backend.tutor.profile.profile', $data);
        }
        elseif(Auth::user()->is_admin == 3)
        {
    	    $data['getrequesttype'] = RequestTypeModel::getRequestType();
	        $data['getlevelofstudent'] = LevelOfStudentModel::getLevelOfStudent();
	        $data['getcategory'] = CategoryModel::getCategory();
	        $data['getlanguage'] = LanguageModel::getLanguge();

	        $data['body'] = 'booking loggedin student request';
	        return view('backend.student.profile.profile', $data);
        }
    }

    public function update_tutor_profile(Request $request) {

    	$user = UsersModel::find(Auth::user()->id);

	    if (!empty($request->file('profile_pic'))) {

            if(!empty($user->profile_pic) && file_exists('upload/profile/'. $user->profile_pic)) {
                unlink('upload/profile/'. $user->profile_pic);
            }

            $ext 		= 'jpg';
            $file 		= $request->file('profile_pic');
            $randomStr 	= str_random(30);
            $filename 	= strtolower($randomStr) . '.' . $ext;
            $file->move('upload/profile/', $filename);
            $user->profile_pic = $filename;

            $thumb_img = Image::make('upload/profile/'.$filename)->resize(400, 400);
            $thumb_img->save('upload/profile/' . $filename, 100);
        }


    	$user->name 			= trim($request->name);
    	$user->last_name 		= trim($request->last_name);
    	$user->category_id 		= $request->category_id;
    	$user->level_of_teacher = $request->level_of_teacher;
    	$user->experience_of_teacher = $request->experience_of_teacher;
    	$user->hour_per_rate 	= $request->hour_per_rate;
    	$user->about_us 		= $request->about_us;
    	$user->save();

    	UserLanguageModel::where('user_id','=',Auth::user()->id)->delete();

    	if(!empty($request->language))
    	{
    		foreach ($request->language as $language_id) {
    			$lan = new UserLanguageModel;
    			$lan->language_id = $language_id;
    			$lan->user_id = Auth::user()->id;
    			$lan->save();
    		}
    	}

    	return redirect()->back()->with('success','Profile successfully updated.');

    }


    public function qualification() {
        $data['value'] = UsersModel::find(Auth::user()->id);
        $data['body'] = 'loggedin student course';
        return view('backend.tutor.profile.qualification', $data);
    }

    public function add_qualification() {
        $data['body'] = 'booking loggedin student request';
        return view('backend.tutor.profile.add_qualification', $data);
    }

    public function insert_qualification(Request $request) {

        $save                   = new UserQualificationModel;
        $save->user_id          = trim(Auth::user()->id);
        $save->university_name  = trim($request->university_name);
        $save->degree           = trim($request->degree);
        $save->major            = trim($request->major);
        $save->start_year       = trim($request->start_year);
        $save->end_year         = trim($request->end_year);
        $save->description      = trim($request->description);
        if (!empty($request->file('upload_file'))) {
            // $ext = 'jpg';
            $file = $request->file('upload_file');
            $randomStr = str_random(30);
            //$filename = strtolower($randomStr) . '.' . $ext;
            $filename = strtolower($randomStr) . '.' . $request->file('upload_file')->extension();
            $file->move('upload/qualification/', $filename);
            $save->upload_file = $filename;
        }

        $save->save();

        return redirect('tutor/qualification')->with('success','Qualification successfully created.');

    }


    public function edit_qualification($id) {
        $data['body'] = 'booking loggedin student request';
        $data['value'] = UserQualificationModel::where('id','=',$id)->where('user_id','=',Auth::user()->id)->first();
        return view('backend.tutor.profile.edit_qualification', $data);
    }

    public function view_qualification($id) {
        $data['body'] = 'booking loggedin student request';
        $data['value'] = UserQualificationModel::where('id','=',$id)->where('user_id','=',Auth::user()->id)->first();
        return view('backend.tutor.profile.view_qualification', $data);
    }




    public function update_qualification($id, Request $request) {

        $save                   = UserqualificationModel::where('id','=',$id)->where('user_id','=',Auth::user()->id)->first();
        $save->university_name  = trim($request->university_name);
        $save->degree           = trim($request->degree);
        $save->major            = trim($request->major);
        $save->start_year       = trim($request->start_year);
        $save->end_year         = trim($request->end_year);
        $save->description      = trim($request->description);
        if (!empty($request->file('upload_file'))) {

            if(!empty($save->upload_file) && file_exists('upload/qualification/'. $save->upload_file)) {
                unlink('upload/qualification/'. $save->upload_file);
            }

            //  $ext        = 'jpg';
            $file       = $request->file('upload_file');
            $randomStr  = str_random(30);
            //$filename   = strtolower($randomStr) . '.' . $ext;
            $filename = strtolower($randomStr) . '.' . $request->file('upload_file')->extension();
            $file->move('upload/qualification/', $filename);
            $save->upload_file = $filename;

            
        }

        $save->save();

        return redirect('tutor/qualification')->with('success','Qualification successfully updated.');

    }

    public function delete_qualification($id, Request $request) {

        // UserqualificationModel::where('id','=',$id)->where('user_id','=',Auth::user()->id)->delete();
         $record  = UserqualificationModel::where('id','=',$id)->where('user_id','=',Auth::user()->id);

        if(!empty($record->upload_file) && file_exists('upload/qualification/'. $record->upload_file)) {
                unlink('upload/qualification/'. $record->upload_file);
        }
        $record->delete();
        
        return redirect('tutor/qualification')->with('success','Qualification successfully deleted.');

    }


    public function change_password() {

        $data['value'] = UsersModel::find(Auth::user()->id);
        $data['body'] = 'booking loggedin student request';
        return view('backend.common.profile.change_password', $data);

    }

    public function update_change_password(Request $request) {

        $user = UsersModel::find(Auth::user()->id);

        if(trim($request->new_password) == trim($request->confirm_password))
        {
            if (Hash::check($request->old_password, $user->password)) {

                $user->password = Hash::make($request->new_password);
                $user->save();
                return redirect()->back()->with('success','Password successfully change.');

            }
            else
            {
                return redirect()->back()->with('error','Old password does not match.');
            }
        }
        else
        {
            return redirect()->back()->with('error','Confirm password does not updated.');
        }
    }


        // Admin start

    public function update_admin_profile(Request $request){
        $user = UsersModel::find(Auth::user()->id);

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

            $thumb_img = Image::make('upload/profile/'.$filename)->resize(400, 400);
            $thumb_img->save('upload/profile/' . $filename, 100);
        }

        $user->name             = trim($request->name);
        $user->last_name        = trim($request->last_name);
        $user->save();
        return redirect()->back()->with('success','Profile successfully updated.');

    }

    // Admin end
    // Student Start
    public function update_student_profile(Request $request) {

        $user = UsersModel::find(Auth::user()->id);

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

            $thumb_img = Image::make('upload/profile/'.$filename)->resize(400, 400);
            $thumb_img->save('upload/profile/' . $filename, 100);
        }


        $user->name             = trim($request->name);
        $user->last_name        = trim($request->last_name);
        $user->level_of_teacher = $request->level_of_teacher;
        $user->category_id      = $request->category_id;
        $user->about_us         = $request->about_us;

        $user->save();

        UserLanguageModel::where('user_id','=',Auth::user()->id)->delete();

        if(!empty($request->language))
        {
            foreach ($request->language as $language_id) {
                $lan = new UserLanguageModel;
                $lan->language_id = $language_id;
                $lan->user_id = Auth::user()->id;
                $lan->save();
            }
        }

        return redirect()->back()->with('success','Profile successfully updated.');

    }

    //Student Start




}
