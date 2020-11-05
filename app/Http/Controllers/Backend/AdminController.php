<?php

namespace App\Http\Controllers\Backend;

use App\Models\UsersModel;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Hash;
use File;
use Image;
use App\Models\PermissionModel;
use App\Models\UserPermissionModel;


class AdminController extends Controller
{
    public function admin(Request $request)
    {

      $p_admin_page = UserPermissionModel::getPermission('admin_page');
      if(empty($p_admin_page)) {
          return redirect('admin/dashboard');
      }

      $getrecord = UsersModel::orderBy('id', 'desc')->where('is_delete','=',0);
      // Search Box Start
      if (!empty($request->name)){
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
      if (!empty($request->id)) {
            $getrecord = $getrecord->where('id', '=', $request->id);
      }
      // Search Box End
      $getrecord = $getrecord->whereIn('is_admin', array('1','4'));

      $getrecord = $getrecord->paginate(45);
      $data['getrecord'] = $getrecord;

      $data['body'] = 'loggedin admin';
      return view('backend.admin.admin.list',$data);
    }

    public function add()
    {
      $p_admin_page = UserPermissionModel::getPermission('admin_page');
      if(empty($p_admin_page)) {
          return redirect('admin/dashboard');
      }

      $data['body'] = 'booking loggedin student request';
      return view('backend.admin.admin.add',$data);
    }
    public function insert(Request $request)
    {

      $this->validate($request,[
          'name'    => 'required|max:120',
          'email'   => 'required|email|unique:users'
      ]);

      $record = new UsersModel;
      $record->name       = trim($request->name);
      $record->last_name  = trim($request->last_name);
      $record->email      = trim($request->email);
      $record->password    = Hash::make('123456');

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
      //$record->is_admin =  1;
      $record->is_admin      = trim($request->is_admin);
      $record->save();
      return redirect('admin/admin')->with('success', 'Data Inserted Successfully');
    }

     public function delete($id) {
        $record  = UsersModel::find($id);
        $record->is_delete = 1;
        $record->save();
        return redirect('admin/admin')->with('success', 'Record successfully deleted!');
    }
    public function edit($id)
    {
        $p_admin_page = UserPermissionModel::getPermission('admin_page');
        if(empty($p_admin_page)) {
            return redirect('admin/dashboard');
        }
        
        $record = UsersModel::find($id);
        $data['record'] = $record;
        $data['body'] = 'booking loggedin student request';
        return view('backend.admin.admin.edit', $data);
    }
    public function update($id, Request $request) {
        $record = UsersModel::find($id);
        $record->name       = trim($request->name);
        $record->last_name  = trim($request->last_name);
        $record->email      = trim($request->email);
        //$record->password    = Hash::make('123456');
        if (!empty($request->file('profile_pic'))){

          if(!empty($record->profile_pic) && file_exists('upload/profile/'. $record->profile_pic))
              {
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
        $record->is_admin      = trim($request->is_admin);
        $record->save();
        return redirect('admin/admin')->with('success', 'Admin updated Successfully!');
  }



        //   Status change start
        public function change_admin_status(Request $request)
        {
            $order          = UsersModel::find($request->id);
            $order->status  = $request->status;
            $order->save();

            $json['success'] = 'Status successfully changed';
            echo json_encode($json);
        }

        //   starus change end


        //permission start

        public function permission($id){
          $p_admin_page = UserPermissionModel::getPermission('admin_page');
          if(empty($p_admin_page)) {
              return redirect('admin/dashboard');
          }
          

            $data['getrecord'] = PermissionModel::get();
            

            $data['body'] = 'booking loggedin student request';
            return view('backend.admin.permission.list', $data);       
        }


        public function get_permission(Request $request){

           $data['getPermission'] = UserPermissionModel::where('user_id','=',$request->user_id)->get();
          echo json_encode($data);
      }


      public function update_permission(Request $request){


        $record  = UserPermissionModel::where('user_id',$request->user_id)->delete();
 

                if(!empty($request->permission))
                {
                    $permission = $request->permission; 
                    for ($i=0; $i < sizeof($permission); $i++) 
                    { 
                        $record_new = new UserPermissionModel;
                        $record_new->permission_id = $permission[$i];
                        $record_new->user_id  = $request->user_id;
                      
                       $record_new->save();
                    }
                }
                 
                
              return redirect()->back()->with('success', 'Permission successfully updated.');
 
            
      }



        //permission end


}
