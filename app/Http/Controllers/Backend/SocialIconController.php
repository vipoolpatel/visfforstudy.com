<?php

namespace App\Http\Controllers\Backend;

use App\Models\SocialIconModel;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\UserPermissionModel;
use App\Models\CountryModel;
use File;

class SocialIconController extends Controller
{
    public function list(Request $request)
    {
        $p_social_icon_page = UserPermissionModel::getPermission('social_icon_page');
        if(empty($p_social_icon_page)) {
           return redirect('admin/dashboard');
        }


        $getrecord = SocialIconModel::orderBy('id', 'desc');
        $getrecord = $getrecord->paginate(50);
        $data['getrecord'] = $getrecord;

        return view('backend.admin.social.list', $data);
    }

    public function edit($id)
    {
        $p_social_icon_page = UserPermissionModel::getPermission('social_icon_page');
        if(empty($p_social_icon_page)) {
           return redirect('admin/dashboard');
        }

        $record = SocialIconModel::find($id);
        $data['record'] = $record;
        $data['body'] = 'booking loggedin student request';
        return view('backend.admin.social.edit', $data);
    }

    public function update($id, Request $request)
    {
        $record = SocialIconModel::find($id);
        $record->icon_name       = trim($request->icon_name);
        $record->social_link     = trim($request->social_link);
        $record->save();

        return redirect('admin/social-icon')->with('success', 'Social icon updated successfully');

    }
    public function delete($id)
    {
        $record  = SocialIconModel::find($id);
        $record->delete();
        return redirect('admin/social-icon')->with('success', 'Record successfully deleted');
    }

    // Counrty Start
    public function country_list(Request $request)
    {

        $getrecord = CountryModel::orderBy('id', 'desc');

        if(!empty($request->id)) {
            $getrecord = $getrecord->where('id', '=', $request->id);
        }

        if (!empty($request->name)) {
            $getrecord = $getrecord->where('name', 'like', '%' . $request->name . '%');
        }

        $getrecord = $getrecord->paginate(50);
        $data['getrecord'] = $getrecord;

      return view('backend.admin.country.list', $data);
    }

    public function add_country()
    {
      $data['body'] = 'booking loggedin student request';
      return view('backend.admin.country.add', $data);
    }

  public function insert_country(Request $request)
    {
      $record = new CountryModel;
      // $record->code            = !empty($request->code) ? trim($request->code) : '';
      // $record->name            = !empty($request->name ) ? trim($request->name ) : '';
      $record->nicename        = !empty($request->nicename ) ? trim($request->nicename ) : '';
      $record->ch_nicename     = !empty($request->ch_nicename ) ? trim($request->ch_nicename ) : '';
      // $record->code2           = !empty($request->code2 ) ? trim($request->code2 ) : '';
      // $record->numcode         = !empty($request->numcode ) ? trim($request->numcode ) : '';
      // $record->phonecode       = !empty($request->phonecode ) ? trim($request->phonecode ) : '';

      if (!empty($request->file('image_name'))) {
          $ext = 'svg';
          $file = $request->file('image_name');
          $randomStr = str_random(30);
          $filename = strtolower($randomStr) . '.' . $ext;
          $file->move('upload/country/', $filename);
          $record->image_name = $filename;

          // $thumb_img = Image::make('upload/country/'.$filename)->resize(314, 314);
          // $thumb_img->save('upload/country/' . $filename, 100);
      }
      $record->save();
      return redirect('admin/country')->with('success', 'Country created successfully');
    }
    public function edit_country($id)
    {
        $record = CountryModel::find($id);
        $data['record'] = $record;

        $data['body'] = 'booking loggedin student request';
        return view('backend.admin.country.edit', $data);
    }
    public function update_country($id, Request $request)
    {
      $record = CountryModel::find($id);

      // $record->code            = !empty($request->code) ? trim($request->code) : '';
      // $record->name            = !empty($request->name ) ? trim($request->name ) : '';
      $record->nicename        = !empty($request->nicename ) ? trim($request->nicename ) : '';
      $record->ch_nicename     = !empty($request->ch_nicename ) ? trim($request->ch_nicename ) : '';
      // $record->code2           = !empty($request->code2 ) ? trim($request->code2 ) : '';
      // $record->numcode         = !empty($request->numcode ) ? trim($request->numcode ) : '';
      // $record->phonecode       = !empty($request->phonecode ) ? trim($request->phonecode ) : '';

      if (!empty($request->file('image_name'))){
          if(!empty($record->image_name) && file_exists('upload/country/'. $record->image_name)) {
                  unlink('upload/country/'. $record->image_name);
          }

          $ext = 'svg';
          $file = $request->file('image_name');
          $randomStr = str_random(30);
          $filename = strtolower($randomStr) . '.' . $ext;
          $file->move('upload/country/', $filename);
          $record->image_name = $filename;

        //  $thumb_img = Image::make('upload/country/'.$filename)->resize(400, 400);
        //  $thumb_img->save('upload/country/' . $filename, 100);
      }

      $record->save();
        return redirect('admin/country')->with('success', 'Country updated successfully');
    }
    public function delete_country($id)
    {
        $record  = CountryModel::find($id);
        if(!empty($record->image_name) && file_exists('upload/country/'. $record->image_name)) {
                unlink('upload/country/'. $record->image_name);
        }
        $record->delete();
        return redirect('admin/country')->with('success', 'Record successfully deleted');
    }
    // Counrty End

}
