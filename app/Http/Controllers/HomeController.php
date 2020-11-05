<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use App\Models\CategoryModel;
use App\Models\UsersModel;
use App\Models\RequestModel;
use App\Models\ContactUsModel;
use App\Models\CountryModel;
use App\Models\SeoModel;

class HomeController extends Controller
{
    public function home(Request $request)
    {


/*
        $getcountry = CountryModel::all();
        foreach ($getcountry as $key => $value) {
            try
            {


                $url = 'https://lipis.github.io/flag-icon-css/flags/4x3/'.strtolower($value->code).'.svg';
                $img = 'upload/country/'.$value->code.'.svg';

                

                if(file_put_contents($img, file_get_contents($url)))
                {
                    $value->image_name =   $value->code.'.svg';
                   $value->save();
                }

             

            } catch (\Exception $e) {
             
            }
        }*/




        // $save = file_get_contents("https://lipis.github.io/flag-icon-css/flags/4x3/gb.svg");

        // die;





    	// Teacher Start
    	$getrecord = UsersModel::select('users.*');
    	$getrecord = $getrecord->where('users.is_admin', '=', '2');
        $getrecord = $getrecord->where('users.status', '=', '1');
        $getrecord = $getrecord->orderBy('users.id', 'desc');
        $getrecord = $getrecord->paginate(6);
        $data['getrecord'] = $getrecord;
        // Teacher End
        
        // Student Start
        $getrecordrequest = RequestModel::select('request.*');
        $getrecordrequest = $getrecordrequest->where('request.status', '=', '2');
        $getrecordrequest = $getrecordrequest->orderBy('request.id', 'desc');
        $getrecordrequest = $getrecordrequest->paginate(6);
        $data['getrecordrequest'] = $getrecordrequest;
        //Student End

        $data['getcategory'] = CategoryModel::getCategory();

        $getseo = SeoModel::getseo('home');
        $data['meta_title'] = !empty($getseo->title) ? $getseo->title : '';
        $data['meta_description'] = !empty($getseo->description) ? $getseo->description : '';
        $data['meta_keyword'] = !empty($getseo->keyword) ? $getseo->keyword : '';

        
        $data['body'] = 'home';
        return view('home', $data);
    }

    public function why_us()
    {

        $getseo = SeoModel::getseo('why-us');
        $data['meta_title'] = !empty($getseo->title) ? $getseo->title : '';
        $data['meta_description'] = !empty($getseo->description) ? $getseo->description : '';
        $data['meta_keyword'] = !empty($getseo->keyword) ? $getseo->keyword : '';

        $data['body'] = 'profile archive student';
        return view('page.why_us', $data);
    }
    public function about()
    {
        $getseo = SeoModel::getseo('about');
        $data['meta_title'] = !empty($getseo->title) ? $getseo->title : '';
        $data['meta_description'] = !empty($getseo->description) ? $getseo->description : '';
        $data['meta_keyword'] = !empty($getseo->keyword) ? $getseo->keyword : '';

        $data['body'] = 'profile archive student';
        return view('page.about', $data);
    }
    public function contact_us()
    {
        $getseo = SeoModel::getseo('contact-us');
        $data['meta_title'] = !empty($getseo->title) ? $getseo->title : '';
        $data['meta_description'] = !empty($getseo->description) ? $getseo->description : '';
        $data['meta_keyword'] = !empty($getseo->keyword) ? $getseo->keyword : '';

        $data['body'] = 'booking loggedin student request';
        return view('page.contact', $data);
    }


    public function contact_us_add(Request $request)
    {
        $this->validate($request,[
          'first_name'    => 'required|max:120',
          'email'         => 'required|email',
          'CaptchaCode'   => 'required_with:current_captcha|same:current_captcha'
        ]);

        $record = new ContactUsModel;
        $record->first_name       = trim($request->first_name);
        $record->last_name  = trim($request->last_name);
        $record->email      = trim($request->email);
        $record->mobile_no  = trim($request->mobile_no);
        $record->city_name  = trim($request->city_name);
        $record->zip_code   = trim($request->zip_code);
        $record->about_us   = trim($request->about_us);
        $record->save();
        return redirect('contact-us')->with('success', 'Your message successfully sent.');
    }

    public function terms()
    {

        $getseo = SeoModel::getseo('terms');
        $data['meta_title'] = !empty($getseo->title) ? $getseo->title : '';
        $data['meta_description'] = !empty($getseo->description) ? $getseo->description : '';
        $data['meta_keyword'] = !empty($getseo->keyword) ? $getseo->keyword : '';
        


      $data['body'] = 'profile archive student';
      return view('page.terms', $data);
    }
    public function privacy()
    {
        $getseo = SeoModel::getseo('privacy');
        $data['meta_title'] = !empty($getseo->title) ? $getseo->title : '';
        $data['meta_description'] = !empty($getseo->description) ? $getseo->description : '';
        $data['meta_keyword'] = !empty($getseo->keyword) ? $getseo->keyword : '';
        
      $data['body'] = 'profile archive student';
      return view('page.privacy', $data);
    }


}
