@extends('layouts.app')
@section('content')
<!-- start: hero area -->
<section class="hero-area loggedin-hero-area">
   <div class="hero-bg" style="background-image: url({{ url('assets/img/banner-bg/banner-bg-5.jpg') }});"></div>
   <div class="hero-overlay"></div>
   <div class="container h-100">
      <div class="row align-items-lg-center h-100">
         <!-- hero main content -->
         <div class="col-12 col-lg-11 offset-lg-1 h-100">
            <!-- hero main content -->
            <div class="hero-main-content">
               <h2 class="hero-title text-capitalize"> Contact Us</h2>
               <div class="hero-booking-featuers">
                  
               </div>
            </div>
         </div>
      </div>
   </div>
</section>
<!-- end: hero area -->
<!-- start: main content -->
<div class="main-content">
   <div class="container">
      <div class="row">
         <div class="col-lg-12">
            <!-- start: request section -->
            <section class="booking-section">
               <div class="row">
                   
                  <div class="col-lg-11 offset-lg-1">
                   
                     <div class="find-multi-search-box booking-form-container">
                        <form action="{{ url('contact_us/add') }}" method="post" class="booking-form request-form" enctype="multipart/form-data">

                          {{--  <div class="form-group title-field">
                               @include('message')
                           </div>
 --}}
                           {{ csrf_field() }}
                          
                           <div class="multi-search-form d-flex align-items-end">
                              <div class="input-group">
                                 <div class="form-group">
                                    <label style="font-size: 18px;">{{ __('admin.First_Name') }}</label>
                                    <input type="text" required class="form-control" name="first_name" value="{{ old('first_name') }}">
                                 </div>
                                 <div class="form-group">
                                    <label style="font-size: 18px;">{{ __('admin.Last_Name') }}</label>
                                    <input type="text" class="form-control" name="last_name" value="{{ old('last_name') }}">
                                 </div>
                                 <div class="form-group">
                                    <label style="font-size: 18px;">{{ __('admin.Email_ID') }}</label>
                                    <input required type="email" class="form-control" name="email" value="{{ old('email') }}" >
                                    <span style="color:red">{{  $errors->first('email') }}</span>
                                 </div>
                              
                              </div>
                           </div>

                            <div class="multi-search-form d-flex align-items-end">
                              <div class="input-group">
                                 <div class="form-group">
                                    <label style="font-size: 18px;">Mobile No</label>
                                    <input type="text" required class="form-control" name="mobile_no" value="{{ old('mobile_no') }}">
                                 </div>
                                 <div class="form-group">
                                    <label style="font-size: 18px;">City Name</label>
                                    <input type="text" class="form-control" name="city_name" value="{{ old('city_name') }}">
                                 </div>
                                 <div class="form-group">
                                    <label style="font-size: 18px;">Zip Code</label>
                                    <input required type="text" class="form-control" name="zip_code" value="{{ old('zip_code') }}" >
                                 </div>
                              </div>
                           </div>

                           <div class="text-message">
                              <div class="form-group">
                                 <label for="request-message">Message</label>
                                 <textarea name="about_us" required="" id="request-message" class="booking-message request-message form-control" placeholder="Write your message..." cols="10" rows="5">{{ old('about_us') }}</textarea>
                              </div>
                           </div>

                           <div class="form-group">
          <label>
@php
   $firstNumber_acc = mt_rand(0, 9);
   $secondNumber_acc = mt_rand(0, 9);

   echo $firstNumber_acc . '+' . $secondNumber_acc .' = ?';

   @endphp
          </label>
          <input type="hidden" name="current_captcha" value="{{ $firstNumber_acc + $secondNumber_acc }}"/>
          <input type="text" name="CaptchaCode" placeholder="{{ $firstNumber_acc . '+' . $secondNumber_acc .' = ?' }}" class="form-control">
<span style="color: red;">{{ $errors->first('CaptchaCode') }}</span>
          
    </div>


                           <button type="submit" class="request-submit-btn reg-signup-btn text-capitalize">{{ __('admin.Submit') }}</button>

                        </form>

                     </div>
                  </div>
               </div>

            </section>

         </div>
      </div>
   </div>
</div>

@endsection
