<?php

namespace App\Http\Controllers\Backend;

use App\Models\SeoModel;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\ContactUsModel;
use App\Models\UserPermissionModel;
use Validator;

class SeoController extends Controller
{
    public function list(Request $request)
    {

        $p_seo_page = UserPermissionModel::getPermission('seo_page');
        if(empty($p_seo_page)) {
           return redirect('admin/dashboard');
        }


        $getrecord = SeoModel::orderBy('id', 'desc');
        // Search Box start
        if (!empty($request->id)) {
            $getrecord = $getrecord->where('id', '=', $request->id);
        }
        if (!empty($request->title)){
            $getrecord = $getrecord->where('title', 'like', '%' . $request->title . '%');
          }
        // Search Box end
        $getrecord = $getrecord->paginate(45);
        $data['getrecord'] = $getrecord;

        $data['body'] = 'loggedin admin';
        return view('backend.admin.seo.list', $data);
    }
    public function add()
    {
        $p_seo_page = UserPermissionModel::getPermission('seo_page');
        if(empty($p_seo_page)) {
           return redirect('admin/dashboard');
        }

        $data['body'] = 'booking loggedin student request';
        return view('backend.admin.seo.add', $data);
    }
    public function insert(Request $request)
    {

      $record = $request->validate([
        'slug' => 'required|unique:seo|max:255',

      ]);

        $record = new SeoModel;
        $record->slug             = trim($request->slug);
        $record->title            = trim($request->title);
        $record->keyword          = trim($request->keyword);
        $record->description      = trim($request->description);

        $record->save();
        return redirect('admin/seo')->with('success', 'Data Inserted Successfully');

    }
    public function edit($id)
    {
        $p_seo_page = UserPermissionModel::getPermission('seo_page');
        if(empty($p_seo_page)) {
           return redirect('admin/dashboard');
        }
        $record = SeoModel::find($id);
        $data['record'] = $record;
        $data['body'] = 'booking loggedin student request';
        return view('backend.admin.seo.edit', $data);
    }
    public function update($id, Request $request)
    {
        $record = SeoModel::find($id);
        $record->slug             = trim($request->slug);
        $record->title            = trim($request->title);
        $record->keyword          = trim($request->keyword);
        $record->description      = trim($request->description);

        $record->save();
        return redirect('admin/seo')->with('success', 'Data updated Successfully');
    }

    public function delete($id) {
        $record  = SeoModel::find($id);
        $record->delete();
        return redirect('admin/seo')->with('success', 'Record successfully deleted!');
    }


    public function contact_list(Request $request)
    {

        $p_contact_us_page = UserPermissionModel::getPermission('contact_us_page');
        if(empty($p_contact_us_page)) {
           return redirect('admin/dashboard');
        }


         $getrecord = ContactUsModel::orderBy('id', 'desc');
        // Search Box start
        if (!empty($request->id)) {
            $getrecord = $getrecord->where('id', '=', $request->id);
        }
        if (!empty($request->first_name)){
            $getrecord = $getrecord->where('first_name', 'like', '%' . $request->first_name . '%');
        }
        if (!empty($request->email)){
            $getrecord = $getrecord->where('email', 'like', '%' . $request->email . '%');
        }
        // Search Box end
        $getrecord = $getrecord->paginate(45);
        $data['getrecord'] = $getrecord;

        $data['body'] = 'loggedin admin';
        return view('backend.admin.contact_us.list', $data);
    }

    public function contact_us_delete($id) {
        $record  = ContactUsModel::find($id);
        $record->delete();
        return redirect('admin/contact_us')->with('success', 'Record successfully deleted!');
    }


}
