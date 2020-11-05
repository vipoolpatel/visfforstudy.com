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
               <h2 class="hero-title text-capitalize">{{ __('tutor.Edit_Profile') }}</h2>
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

                         

                           {{ csrf_field() }}

                           <div class="multi-search-form d-flex align-items-end">
                              <div class="input-group">
                                 <div class="form-group">
                                    <label style="font-size: 18px;">{{ __('tutor.First_Name') }}</label>
                                    <input type="text" class="form-control" name="name" value="{{ $value->name }}">
                                 </div>
                                 <div class="form-group">
                                    <label style="font-size: 18px;">{{ __('tutor.Last_Name') }}</label>
                                    <input type="text" class="form-control" name="last_name" value="{{ $value->last_name }}">
                                 </div>
                                 <div class="form-group">
                                    <label style="font-size: 18px;">{{ __('tutor.Email_ID') }}</label>
                                    <input type="email" class="form-control" readonly value="{{ $value->email }}" >
                                 </div>

                              </div>
                           </div>

                           <div class="multi-search-form d-flex align-items-end">
                              <div class="input-group">

                                <div class="form-group">
                                    <label style="font-size: 18px;">{{ __('tutor.Category_Name') }}</label>
                                    <select name="category_id" required class="level-multi form-control">
                                       <option value="">{{ __('tutor.Select_Category_Name') }}</option>
                                       @foreach($getcategory as $value_c)
                                       <option {{ ($value->category_id == $value_c->id) ? 'selected' : '' }}  value="{{ $value_c->id }}">{{ $value_c->category_name }}</option>
                                       @endforeach
                                    </select>
                                 </div>


                                 <div class="form-group">
                                    <label style="font-size: 18px;">
                                      {{ __('tutor.Level_of_Teacher') }}
                                     </label>
                                    <select name="level_of_teacher" required class="request-aim-multi form-control">
                                       <option value="">
                                         {{ __('tutor.Select_Level_of_Teacher') }}
                                        </option>
                                       @foreach($getlevelofstudent as $value_level)
                                       <option {{ ($value->level_of_teacher == $value_level->id) ? 'selected' : '' }} value="{{ $value_level->id }}">{{ $value_level->level_of_student_name }}</option>
                                       @endforeach
                                    </select>
                                 </div>

                                 <div class="form-group">
                                    <label style="font-size: 18px;" for="request-lang-multi">{{ __('tutor.Experience') }}</label>
                                    <select name="experience_of_teacher" required class="request-lang-multi form-control">
                                       <option value="">{{ __('tutor.Select_Experience') }}</option>
                                       @for($i=1; $i<=50; $i++)
                                          <option {{ ($value->experience_of_teacher == $i) ? 'selected' : '' }} value="{{ $i }}">{{ $i }} {{ __('tutor.Years') }}</option>
                                       @endfor
                                    </select>
                                 </div>
                              </div>
                           </div>


                            <div class="form-group title-field">
                              <label for="request-title">{{ __('tutor.Price_For_Each_Lesson') }}</label>
                              <input type="text" name="hour_per_rate" class="request-title form-control" placeholder="{{ __('tutor.Price_For_Each_Lesson') }}" value="{{ $value->hour_per_rate }}" required>
                           </div>

<div class="form-group publish-course-image" style="max-width: 700px !important;">
<label for="publish-course-image">{{ __('tutor.Profile_Pic') }}</label>
<div class="upload-file-wrap form-control">
   <input type="file" name="profile_pic"  accept="image/*" class="publish-course-image upload-field">
</div>
@if(!empty($value->profile_pic) && file_exists('upload/profile/'.$value->profile_pic))
   <img style="height: 100px;margin-top: 10px;" src="{!! url('upload/profile/'.$value->profile_pic) !!}">
@endif
</div>


                           <div class="custom">
                              <h5 class="label">{{ __('tutor.Language') }}</h5>

                              <div class="form-group ">


                                 @foreach($getlanguage as $value_l)
                                    @php
                                       $checkbox = '';
                                    @endphp
                                    @foreach($value->get_langauge as $lan)
                                       @if($lan->language_id == $value_l->id)
                                          @php
                                             $checkbox = 'checked';
                                          @endphp
                                       @endif
                                    @endforeach

                                    <label style="font-weight: normal;margin-right: 20px;">
                                       <input {{ $checkbox }} type="checkbox" name="language[]"  value="{{ $value_l->id }}"> {{ $value_l->language_name }}
                                    </label>
                                    <br />
                                 @endforeach
                              </div>
                           </div>


                           <div class="text-message">
                              <div class="form-group">
                                 <label for="request-message">{{ __('tutor.Bio') }}</label>
                                 <textarea name="about_us" required id="request-message" class="booking-message request-message form-control" placeholder="{{ __('tutor.Introduce_yourself') }}" cols="10" rows="5">{{ $value->about_us }}</textarea>
                              </div>
                           </div>

                           <button type="submit" class="request-submit-btn reg-signup-btn text-capitalize">{{ __('tutor.Update_Profile') }}</button>

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
