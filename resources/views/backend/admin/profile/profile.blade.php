@extends('backend.layouts.app')

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
               <h2 class="hero-title text-capitalize">{{ __('admin.Edit_Profile') }}</h2>
               <div class="hero-booking-featuers">
                  <ul class="lesson-booking-features reg-form-guide-list">
                     <li class="single-booking-feature">
{{ __('admin.You_will_get_all_teachers_reviews') }}
                     </li>
                     <li class="single-feature">
{{ __('admin.You_will_find_your_teachers_faster') }}
                     </li>
                     <li class="single-feature">
{{ __('admin.Your_request_will_be_seen_by_all_of_teachers') }}
                     </li>
                  </ul>
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

                     <div class="form-group publish-course-image" style="max-width: 700px !important;">
                               @include('message')
                     </div>
 

                     <div class="find-multi-search-box booking-form-container">
                          
                        <form action="" method="post" class="booking-form request-form" enctype="multipart/form-data">
                           {{ csrf_field() }}
                           <div class="multi-search-form d-flex align-items-end">
                              <div class="input-group">
                                 <div class="form-group">
                                    <label style="font-size: 18px;">{{ __('admin.First_Name') }}</label>
                                    <input type="text" required class="form-control" name="name" value="{{ $value->name }}">
                                 </div>
                                 <div class="form-group">
                                    <label style="font-size: 18px;">{{ __('admin.Last_Name') }}</label>
                                    <input type="text" class="form-control" name="last_name" value="{{ $value->last_name }}">
                                 </div>
                                 <div class="form-group">
                                    <label style="font-size: 18px;">{{ __('admin.Email_ID') }}</label>
                                    <input type="email" class="form-control" readonly name="email" value="{{ $value->email }}" >
                                 </div>
                              
                              </div>
                           </div>


                            <div class="form-group publish-course-image" style="max-width: 700px !important;">
                              <label for="publish-course-image">{{ __('admin.Profile_Pic') }}</label>
                              <div class="upload-file-wrap form-control">
                                 <input type="file" name="profile_pic"  accept="image/*" class="publish-course-image upload-field">
                              </div>
                              @if(!empty($value->profile_pic) && file_exists('upload/profile/'.$value->profile_pic))
                                 <img style="height: 100px;margin-top: 10px;" src="{!! url('upload/profile/'.$value->profile_pic) !!}">
                              @endif
                           </div>

                           <button type="submit" class="request-submit-btn reg-signup-btn text-capitalize">{{ __('admin.Update_Profile') }}</button>
                        </form>
                     </div>
                  </div>
               </div>
            </section>
            <!-- end: request section -->
         </div>
      </div>
   </div>
</div>

@endsection

