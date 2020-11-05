<?php

namespace App\Http\Controllers\Backend;

use App\Models\CategoryModel;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\UserPermissionModel;
use Image;

class CategoryController extends Controller
{
    public function category(Request $request)
    {

         $p_category_page = UserPermissionModel::getPermission('category_page');
         if(empty($p_category_page)) {
            return redirect('admin/dashboard');
         }  
        $getrecord = CategoryModel::orderBy('id', 'desc')->where('is_delete','=',0);
        // Search Box Start
        if (!empty($request->category_name)){
          $getrecord = $getrecord->where('category_name', 'like', '%' . $request->category_name . '%');
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

        $getrecord = $getrecord->paginate(50);


        $data['getrecord'] = $getrecord;
        return view('backend.admin.category.list', $data);
    }
    public function add()
    {
         $p_category_page = UserPermissionModel::getPermission('category_page');
         if(empty($p_category_page)) {
            return redirect('admin/dashboard');
         }  

        $data['getcategory'] = CategoryModel::getCategory();
        return view('backend.admin.category.add', $data);
    } 
    public function insert(Request $request)
    {
        $record = new CategoryModel;
        $record->parent_id     = 0;
        $record->category_name = !empty($request->category_name) ? trim($request->category_name) : '';
        $record->ch_category_name = !empty($request->ch_category_name) ? trim($request->ch_category_name) : '';
        
        if (!empty($request->file('category_pic'))) {
            $ext = 'jpg';
            $file = $request->file('category_pic');
            $randomStr = str_random(30);
            $filename = strtolower($randomStr) . '.' . $ext;
            $file->move('upload/category/', $filename);
            $record->category_pic = $filename;

            $thumb_img = Image::make('upload/category/'.$filename)->resize(314, 314);
            $thumb_img->save('upload/category/' . $filename, 100);

        }

        $record->status = !empty($request->status) ? $request->status : '1';
        $record->save();

        return redirect('admin/category')->with('success', 'Category created successfully');
    }

    
    public function change_review_status(Request $request) {
        $order = CategoryModel::find($request->id);
        $order->status = $request->status;
        $order->save();

        $json['success'] = 'Status successfully changed';
        echo json_encode($json);
    }

    public function delete($id) {
        $record = CategoryModel::find($id);
        // if(!empty($record->category_pic) && file_exists('upload/category/'. $record->category_pic)) {
        //     unlink('upload/category/'. $record->category_pic);
        // }
        $record->is_delete = 1;
          $record->save();
       // $record->delete();
        return redirect('admin/category')->with('success', 'Record successfully deleted');
    }

    public function edit($id) {
         $p_category_page = UserPermissionModel::getPermission('category_page');
         if(empty($p_category_page)) {
            return redirect('admin/dashboard');
         }  
         
        $record = CategoryModel::find($id);
        $data['getcategory'] = CategoryModel::getCategory();
        $data['record'] = $record;
        return view('backend.admin.category.edit', $data);
    }

    public function update($id, Request $request) {

      $record = CategoryModel::find($id);
      $record->parent_id = 0;
      $record->category_name = !empty($request->category_name) ? trim($request->category_name) : '';
      $record->ch_category_name = !empty($request->ch_category_name) ? trim($request->ch_category_name) : '';
      if (!empty($request->file('category_pic'))){

          if(!empty($record->category_pic) && file_exists('upload/category/'. $record->category_pic)) {
                  unlink('upload/category/'. $record->category_pic);
          }
          $ext = 'jpg';
          $file = $request->file('category_pic');
          $randomStr = str_random(30);
          $filename = strtolower($randomStr) . '.' . $ext;
          $file->move('upload/category/', $filename);
          $record->category_pic = $filename;

          $thumb_img = Image::make('upload/category/'.$filename)->resize(314, 314);
          $thumb_img->save('upload/category/' . $filename, 100);
      }

      $record->status = !empty($request->status) ? $request->status : '1';
      $record->save();
      return redirect('admin/category')->with('success', 'Category updated successfully');
    }

}
