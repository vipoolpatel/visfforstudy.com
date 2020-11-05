@php

$SocialRecord     = DB::table('social_icon')->get();
$getFooterCategory  = App\Models\CategoryModel::where('status','=',1)->get();

@endphp
<!-- start: footer area -->
<footer class="footer-area">
   <div class="container">
      <div class="row">
         <div class="col-12 col-sm-6 col-md-4 col-lg-3 col-xl-2">
            <div class="footer-column one">
               <div class="footer-column-items">
                  <h4 class="footer-item-title">{{ __('layouts.Visffor') }}</h4>
                  <ul class="footer-links d-flex flex-wrap">
                     <li><a href="{{ url('about') }}">{{ __('layouts.About_us') }}</a></li>
                     <li><a href="{{ url('contact-us') }}">{{ __('layouts.Contact_us') }}</a></li>
                     <li><a href="{{ url('why-us') }}">{{ __('layouts.Why_us') }}</a></li>
                     <li><a href="{{ url('terms') }}">Terms</a></li>
                  </ul>
               </div>

               <div class="footer-column-items">
                  <h4 class="footer-item-title">{{ __('layouts.Student') }}</h4>
                  <ul class="footer-links d-flex flex-wrap">
                     @if(!Auth::check())
                      <li><a href="{{ url('login') }}">{{ __('layouts.Login') }}</a></li>
                     <li><a href="{{ url('signup') }}">{{ __('layouts.Sign_up') }}</a></li>
                    @endif
                     <li><a href="{{ url('find-tutor') }}">{{ __('layouts.Find_a_Tutor') }}</a></li>
                  </ul>
               </div>
               <div class="footer-column-items">
                  <h4 class="footer-item-title">{{ __('layouts.Tutor') }}</h4>
                  <ul class="footer-links d-flex flex-wrap">
                     <li><a href="{{ url('find-student') }}">{{ __('layouts.Find_Student') }}</a></li>
                     @if(!Auth::check())
                     <li><a href="{{ url('become-tutor') }}">{{ __('layouts.Become_a_tutor') }}</a></li>
                     @endif
                  </ul>
               </div>

            </div>
         </div>
         <div class="col-12 col-sm-6 col-md-4 col-lg-3 col-xl-2">
            <div class="footer-column two">
               <div class="footer-column-items">
                  <h4 class="footer-item-title">{{ __('layouts.Subject') }}</h4>
                  <ul class="footer-links d-flex flex-wrap">
                     @foreach($getFooterCategory as $footer_category)
                     <li><a href="{{ url('find-tutor?category_id='.$footer_category->id) }}">{{ $footer_category->getcategoryname() }}</a></li>
                    @endforeach
                  </ul>
               </div>
            </div>
         </div>
         <div class="col-12 col-sm-6 col-md-4 col-lg-3 col-xl-2">
            <div class="footer-column three">
               <div class="footer-column-items">
                  <h4 class="footer-item-title">{{ __('layouts.Location') }}</h4>
                  <div class="location">
                     <h6 class="footer-item-subtitle">{{ __('layouts.United_Kingdom') }}</h6>
                     <p class="address">
                        {{ __('layouts.City_Point') }}
                        <span class="phone">{{ __('layouts.TEL') }}:(+44)07455962168</span>
                     </p>
                  </div>
                  <div class="location">
                     <h6 class="footer-item-subtitle">{{ __('layouts.China') }}</h6>
                     <p class="address">{{ __('layouts.Yuetan_South_Street') }}
                        <span class="phone">{{ __('layouts.Landline') }}: (+86)-010-57173657</span>
                     </p>
                  </div>
               </div>
            </div>
         </div>
         <div class="col-12 col-sm-6 col-md-6 col-xl-4">
            <div class="footer-column four">
               <div class="footer-column-items">
                  <h4 class="footer-item-title">{{ __('layouts.Subscribe_us_now') }}</h4>
                  <div class="subscription">
                     <p class="subscrip-text text-white">
                        {{ __('layouts.Sign_up_with_your_email_address_to_receive_news_and_updates') }}
                     </p>
                     <form action="{{ url('subscribe_email/add') }}" method="post" class="subscription-form" enctype="multipart/form-data">
                        {{ csrf_field() }}
                        <input type="email" name="email" id="email" value="{{ old('email') }}" placeholder="{{ __('layouts.Enter_your_email_address') }}">
                        <span style="color:red">{{  $errors->first('email') }}</span>
                        <input type="submit" class="submit-btn text-uppercase" value="Subscribe">
                     </form>
                  </div>
               </div>
               <div class="footer-column-items">
                  <h4 class="footer-item-title">
                     {{ __('layouts.Connect_with_us') }}
                  </h4>
                  <ul class="social-links d-flex">
                     @foreach($SocialRecord as $value_s)
                     <li>
                        <a href="{{ $value_s->social_link }}" target="_blank" class="social-link"><i class="{{ $value_s->icon_name }}"></i></a>
                     </li>
                     @endforeach
                  </ul>
               </div>
            </div>
         </div>
         <div class="col-12 col-sm-6 col-md-6 col-xl-2">
            <div class="footer-column five">
               <div class="footer-column-items">
                  <h4 class="footer-item-title">
                     {{ __('layouts.Get_visffor_app') }}
                  </h4>
                  <p class="app-text text-white">
                     {{ __('layouts.Download_our_app_from_ISO_or_Android_free_cost') }}
                  </p>
                  <div class="footer-app-logos">
                     <a href="#">
                     <img src="{{ url('assets/img/iconic-appstore.png') }}" alt="appstore-logo">
                     </a>
                     <a href="#">
                     <img src="{{ url('assets/img/icoinc-playstore.png') }}" alt="playstore-logo">
                     </a>
                  </div>
               </div>
            </div>
         </div>
      </div>
      <!-- start: copyright -->
      <div class="row mt-3 mt-lg-5">
         <div class="col-12">
            <div class="copyright text-capitalize text-white">
               {{ __('layouts.Copyright') }} &#169; {{ __('layouts.EduVisffor') }} <a href="{{ url('privacy') }}" class="policy-link">{{ __('layouts.Privacy_policy') }}</a>
            </div>
         </div>
      </div>
      <!-- end: copyright -->
   </div>
</footer>
<!-- end: footer area -->
