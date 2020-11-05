<?php

namespace App\Http\Controllers;
use App\User;
use App\Models\UsersModel;

use App\Models\SubscribeEmailModel;
use App\Models\SeoModel;

use App\Http\Requests\ResetPassword;
use Hash;
use Auth;
use Illuminate\Http\Request;
use App\Mail\ForgotPasswordMail;
use App\Mail\RegisterMail;
use Mail;
use Session;
use App\Models\CountryModel;

class AuthController extends Controller
{
    public function login()
    {
        $getseo = SeoModel::getseo('login');
        $data['meta_title'] = !empty($getseo->title) ? $getseo->title : '';
        $data['meta_description'] = !empty($getseo->description) ? $getseo->description : '';
        $data['meta_keyword'] = !empty($getseo->keyword) ? $getseo->keyword : '';
        

    	$data['body'] = 'registration login';
    	return view('auth.login', $data);
    }

    public function signup()
    {
        $getseo = SeoModel::getseo('signup');
        $data['meta_title'] = !empty($getseo->title) ? $getseo->title : '';
        $data['meta_description'] = !empty($getseo->description) ? $getseo->description : '';
        $data['meta_keyword'] = !empty($getseo->keyword) ? $getseo->keyword : '';

    	$data['body'] = 'registration signup';
    	return view('auth.signup', $data);
    }

    public function become_student()
    {
        $getseo = SeoModel::getseo('become-student');
        $data['meta_title'] = !empty($getseo->title) ? $getseo->title : '';
        $data['meta_description'] = !empty($getseo->description) ? $getseo->description : '';
        $data['meta_keyword'] = !empty($getseo->keyword) ? $getseo->keyword : '';

      $data['getcountry']      = CountryModel::getCountry();
    	$data['body'] = 'registration student';
    	return view('find_student.become_student', $data);
    }
    public function become_tutor()
    {
        $getseo = SeoModel::getseo('become-tutor');
        $data['meta_title'] = !empty($getseo->title) ? $getseo->title : '';
        $data['meta_description'] = !empty($getseo->description) ? $getseo->description : '';
        $data['meta_keyword'] = !empty($getseo->keyword) ? $getseo->keyword : '';

         $data['getcountry']      = CountryModel::getCountry();
     $data['body'] = 'registration tutor';
     return view('become_tutor.become_tutor', $data);
    }
    public function forgot_password()
    {
        $getseo = SeoModel::getseo('forgot-password');
        $data['meta_title'] = !empty($getseo->title) ? $getseo->title : '';
        $data['meta_description'] = !empty($getseo->description) ? $getseo->description : '';
        $data['meta_keyword'] = !empty($getseo->keyword) ? $getseo->keyword : '';

        $data['body'] = 'registration login';
        return view('auth.forgot_password', $data);
    }

    public function become_tutor_add(Request $request)
    {
      $this->validate($request,[
          'name'        => 'required|max:120',
          'email'       => 'required|email|unique:users',
          'password'    => 'required_with:confirm_password|same:confirm_password',
          'CaptchaCode' => 'required_with:current_captcha|same:current_captcha'
      ]);

      $record = new User;
      $record->name     = trim($request->name);
      $record->email    = trim($request->email);
      $record->country_id    = trim($request->country_id);
      $record->password = Hash::make($request->password);
      $record->timezone = UsersModel::timezone();
      $record->remember_token = str_random(50);
      $record->is_admin = 2;
      $record->save();


      $this->send_verification_mail($record);

      return redirect('login')->with('success', 'This email is not verified yet, please check your inbox to activate your account!');
    }
    
    public function become_student_add(Request $request)
    {
      $this->validate($request,[
          'name'        => 'required|max:120',
          'email'       => 'required|email|unique:users',
          'password'    => 'required_with:confirm_password|same:confirm_password',
          'CaptchaCode' => 'required_with:current_captcha|same:current_captcha'

          ]);

      $record = new User;
      $record->name     = trim($request->name);
      $record->email    = trim($request->email);
      $record->country_id    = trim($request->country_id);
      $record->password = Hash::make($request->password);
      $record->timezone = UsersModel::timezone();
      $record->remember_token = str_random(50);
      $record->is_admin = 3;
      $record->save();

      $this->send_verification_mail($record);

      return redirect('login')->with('success', 'This email is not verified yet, please check your inbox to activate your account!');
    }
 // Start Login student teacher tutor admin
    public function auth_login(Request $request)
    {
      if (Auth::attempt(['email' => $request->email, 'password' => $request->password], true)) {
        if(Auth::User()->status == 1)
        {
            $this->updateToken(Auth::User()->id);

            $user = User::find(Auth::user()->id);
            Session::put('auth_token', $user->token); 
             
            if(Auth::User()->is_admin =='1' || Auth::User()->is_admin =='4'){
                return redirect()->intended('admin/dashboard');
            } else if (Auth::User()->is_admin =='2'){
                return redirect()->intended('tutor/dashboard');
            } else if (Auth::User()->is_admin =='3'){
              return redirect()->intended('student/dashboard');
            }  
        }
        else
        {
            $user_id = Auth::user()->id;
            Auth::logout();
            $user = User::find($user_id);
            $this->send_verification_mail($user);
            return redirect()->back()->with('error', 'This email is not verified yet, please check your inbox to activate your account!');
        }
      } else {
        return redirect()->back()->with('error', 'Please enter the correct credentials');
      }


    }


    public function updateToken($user_id) {

      $randomStr       = str_random(40).$user_id;
      $save_token      = UsersModel::find($user_id);
      $save_token->token = $randomStr;
      $save_token->save();

    }
  

    public function send_verification_mail($user) {      
        Mail::to($user->email)->send(new RegisterMail($user));
    }

    public function activate($token)
    {
        $user = User::where('remember_token', '=', $token);
        if ($user->count() == '0') {
          abort(403);
        }

        $user = $user->first();
        $user->status = 1;
        $user->is_delete = 0;
        $user->save();

        return redirect('login')->with('success', 'Thank you. your account is verified.');
    }

  // End Login student teacher tutor admin

  // Auth Logout Start
  public function logout()
  {
    Auth::logout();
    return redirect(url(''));
  }
  // Auth Logout End

  //Subscribe us now Email Start
  public function subscribe_email(Request $request)
  {
      $this->validate($request,[
          'email'  => 'required|email',
      ]);

      $count = SubscribeEmailModel::where('email','=',$request->email)->count();
      if($count == 0)
      {
          $record = new SubscribeEmailModel;
          $record->email    = trim($request->email);
          $record->save();  
          return redirect()->back()->with('success','Email successfully subscribed.');
      }
      else
      {
          return redirect()->back()->with('error','Email address already register.');
      }
  }
  //Subscribe us now Email End


    // Forgot Passoword start
  public function forgot_password_update(Request $request)
  {
      $user = User::where('email','=',$request->email)->first();
      if (empty($user)) {
          return redirect()->back()->with(['error' => 'Email not found in the system.']);
      }

      $user->remember_token = str_random(50);
      $user->save();
      Mail::to($user->email)->send(new ForgotPasswordMail($user));
      return redirect()->back()->with('success', 'Password has been reset. and sent to you mailbox');
  }

  // Forgot Passoword end


    public function reset_password($token,Request $request)
    {

        $getseo = SeoModel::getseo('reset-password');
        $data['meta_title'] = !empty($getseo->title) ? $getseo->title : '';
        $data['meta_description'] = !empty($getseo->description) ? $getseo->description : '';
        $data['meta_keyword'] = !empty($getseo->keyword) ? $getseo->keyword : '';

        $user = User::where('remember_token', '=', $token);
        if ($user->count() == 0) {
          abort(403);
        }
        $user = $user->first();
        
        $data['token'] = $token;
        $data['body'] = 'registration login';
        return view('auth.reset', $data);
   }


   public function reset_password_update($token,ResetPassword $request)
   {

        $user = User::where('remember_token', '=', $token);
        if ($user->count() == 0) {
          abort(403);
        }
        $user = $user->first();
        $user->password = Hash::make($request->password);
        $user->save();
        return redirect('login')->with('success', 'Password has been reset.');
   }


}
