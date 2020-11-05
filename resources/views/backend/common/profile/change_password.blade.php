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
               <h2 class="hero-title text-capitalize">{{ __('admin.Change_Password') }}</h2>
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
                   
                     <div class="find-multi-search-box booking-form-container">
                        <form action="{{ url('common/change-password') }}" method="post" class="booking-form request-form" enctype="multipart/form-data">

                           <div class="form-group title-field">
                               @include('message')
                           </div>

                           {{ csrf_field() }}
                          
                           <div class="form-group title-field">
                              <label for="request-title">{{ __('admin.Old_Password') }} </label>
                              <input type="password" name="old_password" class="request-title form-control" placeholder="{{ __('admin.Old_Password') }}" required>
                           </div>

                           <div class="form-group title-field">
                              <label for="request-title"> {{ __('admin.New_Password') }}</label>
                              <input type="password" name="new_password" class="request-title form-control" placeholder="{{ __('admin.New_Password') }}" required>
                           </div>

                           <div class="form-group title-field">
                              <label for="request-title">{{ __('admin.Confirm_Password') }} </label>
                              <input type="password" name="confirm_password" class="request-title form-control" placeholder="{{ __('admin.Confirm_Password') }}" required>
                           </div>


                           <button type="submit" class="request-submit-btn reg-signup-btn text-capitalize">{{ __('admin.Update_Password') }}</button>

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