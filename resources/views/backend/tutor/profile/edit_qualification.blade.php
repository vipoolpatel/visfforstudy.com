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
               <h2 class="hero-title text-capitalize">{{ __('tutor.Edit_new_Qulification') }}</h2>
               <div class="hero-booking-featuers">
                  <ul class="lesson-booking-features reg-form-guide-list">
                     <li class="single-booking-feature">
                     {{ __('tutor.You_will_get_all_Student_reviews') }}
                     </li>
                     <li class="single-feature">
                     {{ __('tutor.You_will_find_your_Student_faster') }}
                     </li>
                     <li class="single-feature">
                     {{ __('tutor.Your_Offer_will_be_seen_by_all_of_Students') }}
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
                        <form action="" method="post" class="booking-form request-form" enctype="multipart/form-data">

                           <div class="form-group title-field">
                               @include('message')
                           </div>

                           {{ csrf_field() }}
                          
                           <div class="form-group title-field">
                              <label for="request-title">{{ __('tutor.University_Name') }} </label>
                              <input type="text" name="university_name" class="request-title form-control" placeholder="{{ __('tutor.University_Name') }} " value="{{ $value->university_name }}" required>
                           </div>

                           <div class="form-group title-field">
                              <label for="request-title">{{ __('tutor.Degree') }} </label>
                              <input type="text" name="degree" value="{{ $value->degree }}" class="request-title form-control" placeholder="{{ __('tutor.Degree') }}" required>
                           </div>

                           <div class="form-group title-field">
                              <label for="request-title">{{ __('tutor.Major') }} </label>
                              <input type="text" name="major" value="{{ $value->major }}" class="request-title form-control" placeholder="{{ __('tutor.Major') }}" required>
                           </div>

                           

                           <div class="form-group title-field">
                              <label for="request-title">{{ __('tutor.Start_Year') }} </label>
                              <input type="date" name="start_year" value="{{ $value->start_year }}" style="padding: 0px;padding-left: 10px;" class="request-title form-control" placeholder="{{ __('tutor.Start_Year') }}" required>
                           </div>

                           <div class="form-group title-field">
                              <label for="request-title">{{ __('tutor.End_Year') }} </label>
                              <input type="date" name="end_year" value="{{ $value->end_year }}" style="padding: 0px;padding-left: 10px;" class="request-title form-control" placeholder="{{ __('tutor.End_Year') }}" required>
                           </div>
   <div class="form-group publish-course-image" style="max-width: 700px !important;">
      <label for="publish-course-image">Upload File</label>
      <div class="upload-file-wrap form-control">
         <input type="file" name="upload_file" class="publish-course-image upload-field">

      </div>
       @if(!empty($value->upload_file))
            <a target="_black" href="{{ url('upload/qualification/'.$value->upload_file) }}">Download File</a>
         @endif
      
   </div>

                           <div class="text-message">
                              <div class="form-group">
                                 <label for="request-message">{{ __('tutor.Description') }}</label>
                                 <textarea name="description" required id="request-message" class="booking-message request-message form-control" placeholder="{{ __('tutor.Type_a_Description') }} " cols="10" rows="5">{{ $value->description }}</textarea>
                              </div>
                           </div>

                  

                           <button type="submit" class="request-submit-btn reg-signup-btn text-capitalize">{{ __('tutor.Update') }}</button>

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