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
               <h2 class="hero-title text-capitalize">{{ __('admin.Edit_Tutor') }}</h2>
               <div class="hero-booking-featuers">
                  <ul class="lesson-booking-features reg-form-guide-list">
                     <li class="single-booking-feature">
                     {{ __('admin.You_will_get_all_teachers_reviews') }}</li>
                     <li class="single-feature">
                     {{ __('admin.You_will_find_your_teachers_faster') }}</li>
                     <li class="single-feature">
                     {{ __('admin.Your_request_will_be_seen_by_all_of_teachers') }}</li>
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
                        <form action="{{ url('admin/tutor/edit/'. $record->id) }}" method="post" class="booking-form request-form" enctype="multipart/form-data">

                           {{-- <div class="form-group title-field">
                               @include('message')
                           </div> --}}

                           {{ csrf_field() }}

                           <div class="multi-search-form d-flex align-items-end">
                              <div class="input-group">
                                 <div class="form-group">
                                    <label style="font-size: 18px;">
{{ __('admin.First_Name') }}
                                    </label>
                                    <input type="text" class="form-control" name="name" value="{{ old('name',$record->name) }}">
                                 </div>
                                 <div class="form-group">
                                    <label style="font-size: 18px;">{{ __('admin.Last_Name') }}</label>
                                    <input type="text" class="form-control" name="last_name" value="{{ old('last_name',$record->last_name) }}">
                                 </div>
                                 <div class="form-group">
                                    <label style="font-size: 18px;">{{ __('admin.Email_ID') }}</label>
                                    <input readonly name="email" type="email" class="form-control" value="{{ old('email',$record->email) }}" >

                                 </div>

                              </div>
                           </div>

                           <div class="multi-search-form d-flex align-items-end">
                              <div class="input-group">

                                <div class="form-group">
                                 <label style="font-size: 18px;">
{{ __('admin.Category_Name') }}
                                 </label>
                                    <select name="category_id" required class="level-multi form-control">
                                       <option value="">{{ __('admin.Select_Category_Name') }}</option>
                                       @foreach($getcategory as $value_c)
                                          <option {{ ($record->category_id == $value_c->id) ? 'selected' : '' }} value="{{ $value_c->id }}">{{ $value_c->getcategoryname() }}</option>
                                       @endforeach
                                    </select>
                                 </div>


                                 <div class="form-group">
                                    <label style="font-size: 18px;">
{{ __('admin.Level_of_Teacher') }}
                                    </label>
                                    <select name="level_of_teacher" required class="request-aim-multi form-control">
                                       <option value="">{{ __('admin.Select_Level_of_Teacher') }} </option>
                                          @foreach($getlevelofstudent as $value_level)
                                              <option {{ ($record->level_of_teacher == $value_level->id) ? 'selected' : '' }} value="{{ $value_level->id }}">{{ $value_level->getlevelofstudentname() }}</option>
                                          @endforeach
                                    </select>
                                 </div>

                                  <div class="form-group">
                                    <label style="font-size: 18px;" for="request-lang-multi">{{ __('admin.Experience') }}</label>
                                    <select name="experience_of_teacher" required class="request-lang-multi form-control">
                                       <option value="">{{ __('admin.Select_Experience') }}</option>
                                       @for($i=1; $i<=50; $i++)
                                          <option {{ ($record->experience_of_teacher == $i) ? 'selected' : '' }} value="{{ $i }}">{{ $i }} {{ __('admin.Years') }}</option>
                                       @endfor
                                    </select>
                                 </div>


                                 <div class="form-group">
                                    <label style="font-size: 18px;">
                                 Country Name
                                    </label>
                                    <select name="country_id" required class="request-aim-multi form-control">
                                       <option value="">
                                 Select Country Name
                                        </option>
                                          @foreach($getcountry as $value_cou)
                                   <option {{ ($record->country_id == $value_cou->id) ? 'selected' : '' }} value="{{ $value_cou->id }}">{{ $value_cou->getnicename() }}</option>
                                   @endforeach
                                    </select>
                                 </div>


                              </div>
                           </div>

         <div class="form-group title-field">
            <label for="request-title">{{ __('admin.Price_For_Each_Lesson') }}</label>
            <input type="text" name="hour_per_rate" class="request-title form-control" placeholder="{{ __('admin.Price_For_Each_Lesson') }}" value="{{ $record->hour_per_rate }}">
         </div>

          <div class="text-message">
         <div class="form-group">
            <label for="request-message">{{ __('admin.Password') }}</label>
            <input type="text"  name="password" class="form-control"/>
            <span style="color: red">{{ $errors->first('password') }}</span>
            {{ __('admin.Leave_blank') }}
         </div>
      </div>

        <div class="form-group publish-course-image" style="max-width: 700px !important;">
         <label for="publish-course-image">{{ __('admin.Profile_Pic') }}</label>
         <div class="upload-file-wrap form-control">
            <input type="file" name="profile_pic"  accept="image/*" class="publish-course-image upload-field">
         </div>
         @if(!empty($record->profile_pic) && file_exists('upload/profile/'.$record->profile_pic))
            <img style="height: 100px;margin-top: 10px;" src="{!! url('upload/profile/'.$record->profile_pic) !!}">
         @endif
      </div>

       <div class="custom">
      <h5 class="label">{{ __('admin.Language') }}</h5>

      <div class="form-group ">


         @foreach($getlanguage as $value_l)
          @php
               $checkbox = '';
            @endphp
            @foreach($record->get_langauge as $lan)
               @if($lan->language_id == $value_l->id)
                  @php
                     $checkbox = 'checked';
                  @endphp
               @endif
           @endforeach

            <label style="font-weight: normal;margin-right: 20px;">
               <input {{ $checkbox }}  type="checkbox" name="language[]"  value="{{ $value_l->id }}"> {{ $value_l->getlanguagename() }}
            </label>
            <br />
         @endforeach
      </div>
   </div>







   <div class="text-message">
      <div class="form-group">
         <label for="request-message">{{ __('admin.Bio') }}</label>
         <textarea name="about_us" required id="request-message" class="booking-message request-message form-control" placeholder="{{ __('admin.Introduce_yourself') }}" cols="10" rows="5">{!! $record->about_us !!}</textarea>
      </div>
   </div>

                           <button type="submit" class="request-submit-btn reg-signup-btn text-capitalize">{{ __('admin.Update') }}</button>

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
