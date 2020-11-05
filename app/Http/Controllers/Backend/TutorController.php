<?php

namespace App\Http\Controllers\Backend;

use App\Models\UsersModel;
use App\Models\LevelOfStudentModel;
use App\Models\CategoryModel;
use App\Models\UserLanguageModel;
use App\Models\LanguageModel;
use App\Models\CountryModel;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\UserPermissionModel;
use Hash;
use File;
use Auth;
use Image;

class TutorController extends Controller
{

    public function tutor(Request $request) {

         $p_tutor_page = UserPermissionModel::getPermission('tutor_page');
         if(empty($p_tutor_page)) {
            return redirect('admin/dashboard');
         }
          $getrecord = UsersModel::orderBy('id', 'desc')->where('is_delete','=',0);

          // Search Box Start
         if (!empty($request->name)) {
            $getrecord = $getrecord->where('name', 'like', '%' . $request->name . '%');
         }
         if (!empty($request->status)) {
            $status = $request->status;
            if($request->status == 2)
            {
                $status = 0;
            }
            $getrecord = $getrecord->where('status', '=', $status);
         }
         if(!empty($request->category_id)) {
            $getrecord = $getrecord->where('category_id', '=', $request->category_id);
         }
         if(!empty($request->id)) {
            $getrecord = $getrecord->where('id', '=', $request->id);
         }
          // Search Box End

          $getrecord = $getrecord->where('is_admin', '=', '2');
          // $getrecord = $getrecord->where('status', '=', '1');
          $getrecord = $getrecord->paginate(45);
          $data['getrecord'] = $getrecord;

          $data['getcategory'] = CategoryModel::getCategory();

          $data['body'] = 'loggedin admin';
          return view('backend.admin.tutor.list',$data);
    }

    public function add() {
       $p_tutor_page = UserPermissionModel::getPermission('tutor_page');
         if(empty($p_tutor_page)) {
            return redirect('admin/dashboard');
         }

        $data['getcountry']        = CountryModel::getCountry();
        $data['getlevelofstudent'] = LevelOfStudentModel::getLevelOfStudent();
        $data['getcategory']       = CategoryModel::getCategory();
        $data['getlanguage']       = LanguageModel::getLanguge();
        $data['body'] = 'booking loggedin student request';
        return view('backend.admin.tutor.add',$data);

    }

    public function insert(Request $request) {

        $this->validate($request,[
            'name'    => 'required|max:120',
            'email'   => 'required|email|unique:users'
        ]);

        $record = new UsersModel;
        $record->name       = trim($request->name);
        $record->last_name  = trim($request->last_name);
        $record->email      = trim($request->email);
        $record->password   = Hash::make('123456');


        $record->country_id       = $request->country_id;
        $record->level_of_teacher = $request->level_of_teacher;
        $record->category_id      = $request->category_id;
        $record->about_us         = $request->about_us;
        $record->experience_of_teacher = $request->experience_of_teacher;
        $record->hour_per_rate  = $request->hour_per_rate;

        if (!empty($request->file('profile_pic'))) {

              $ext = 'jpg';
              $file = $request->file('profile_pic');
              $randomStr = str_random(30);
              $filename = strtolower($randomStr) . '.' . $ext;
              $file->move('upload/profile/', $filename);
              $record->profile_pic = $filename;


              $thumb_img = Image::make('upload/profile/'.$filename)->resize(400, 400);
              $thumb_img->save('upload/profile/' . $filename, 100);

        }
        $record->is_admin =  2;
        $record->status   =  1;
        $record->save();

        if(!empty($request->language)) {
               foreach ($request->language as $language_id) {
                if(!empty($language_id))
                   {
                    $lan = new UserLanguageModel;
                    $lan->user_id = $record->id;

                    $lan->language_id = !empty($language_id) ? trim($language_id) :null;
                    $lan->save();
               }
             }
          }

        return redirect('admin/tutor')->with('success', 'Tutor created successfully');

    }

    public function delete($id) {

        $record  = UsersModel::find($id);
        // if(!empty($record->profile_pic) && file_exists('upload/profile/'. $record->profile_pic)) {
        //         unlink('upload/profile/'. $record->profile_pic);
        // }
        $record->is_delete = 1;
        $record->save();
        return redirect('admin/tutor')->with('success', 'Record successfully deleted');

    }

    public function edit($id) {

       $p_tutor_page = UserPermissionModel::getPermission('tutor_page');
         if(empty($p_tutor_page)) {
            return redirect('admin/dashboard');
         }

        $record = UsersModel::find($id);
        $data['record'] = $record;

        $data['getcountry']        = CountryModel::getCountry();
        $data['getlevelofstudent'] = LevelOfStudentModel::getLevelOfStudent();
        $data['getcategory']       = CategoryModel::getCategory();
        $data['getlanguage']       = LanguageModel::getLanguge();
        $data['body'] = 'booking loggedin student request';
        return view('backend.admin.tutor.edit', $data);

    }

    public function update($id, Request $request) {

        $record = UsersModel::find($id);
        $record->name       = trim($request->name);
        $record->last_name  = trim($request->last_name);
        $record->email      = trim($request->email);

        $record->country_id       = $request->country_id;
        $record->level_of_teacher = $request->level_of_teacher;
        $record->category_id      = $request->category_id;
        $record->about_us         = $request->about_us;
        $record->experience_of_teacher = $request->experience_of_teacher;
        $record->hour_per_rate  = $request->hour_per_rate;

        if (!empty($request->file('profile_pic'))){

            if(!empty($record->profile_pic) && file_exists('upload/profile/'. $record->profile_pic)) {
                unlink('upload/profile/'. $record->profile_pic);
            }

            $ext = 'jpg';
            $file = $request->file('profile_pic');
            $randomStr = str_random(30);
            $filename = strtolower($randomStr) . '.' . $ext;
            $file->move('upload/profile/', $filename);
            $record->profile_pic = $filename;

            $thumb_img = Image::make('upload/profile/'.$filename)->resize(400, 400);
            $thumb_img->save('upload/profile/' . $filename, 100);
        }

        if (!empty($request->password)){
            $record->password = Hash::make($request->password);
        }


        $record->save();

        UserLanguageModel::where('user_id','=',$id)->delete();

        if(!empty($request->language))
        {
            foreach ($request->language as $language_id) {
                $lan = new UserLanguageModel;
                $lan->language_id = $language_id;
                $lan->user_id = $id;
                $lan->save();
            }
        }


        return redirect('admin/tutor')->with('success', 'Tutor updated successfully');
   }

    public function view($id)
    {
     $record = UsersModel::find($id);
        $data['value'] = $record;
        $data['body']  = 'booking loggedin student request';
        return view('backend.admin.tutor.view', $data);
    }

//   Tutor status start

   public function change_tutor_studnet(Request $request)
   {
        $order = UsersModel::find($request->id);
        $order->status = $request->status;
        $order->save();

        $json['success'] = 'Status successfully changed';
        echo json_encode($json);
   }
// Tutor status end

}
