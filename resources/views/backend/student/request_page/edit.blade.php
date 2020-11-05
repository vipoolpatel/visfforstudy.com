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
               <h2 class="hero-title text-capitalize">
{{ __('student.Edit_your_request') }}
               </h2>
               <div class="hero-booking-featuers">
                  <ul class="lesson-booking-features reg-form-guide-list">
                     <li class="single-booking-feature">
                       
                        {{ __('student.You_will_get_all_teachers_reviews') }}
                     </li>
                     <li class="single-feature">
                         {{ __('student.You_will_find_your_teachers_faster') }}
                       
                     </li>
                     <li class="single-feature">
                         {{ __('student.Your_request_will_be_seen_by_all_of_teachers') }}
                       
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
                        <form action="{{ url('student/request-page/edit/'. $record->id) }}" method="post" class="booking-form request-form" enctype="multipart/form-data">
                           {{ csrf_field() }}
                           <div class="form-group title-field">
                              <label for="request-title">{{ __('student.Request_title') }}</label>
                              <input type="text" name="request_title" value="{{ old('request_title',$record->request_title) }}" class="request-title form-control" placeholder="{{ __('student.Enter_your_request_title') }}">
                           </div>
                           <div class="multi-search-form d-flex align-items-end">
                              <div class="input-group">
                                
                                 <div class="form-group">
                                    <label style="font-size: 18px;">
{{ __('student.Level_of_Student') }}
                                     </label>
                                    <select name="level_of_student_id" class="request-aim-multi form-control">
                                       <option value="">
{{ __('student.Select_Level_of_Student') }}
                                        </option>
                                       @foreach($getlevelofstudent as $value_level)
                                       <option {{ ( $value_level->id == $record->level_of_student_id) ? 'selected' : '' }} value="{{ $value_level->id }}">{{ $value_level->getlevelofstudentname() }}</option>
                                       @endforeach
                                    </select>
                                 </div>
                                 <div class="form-group">
                                    <label style="font-size: 18px;">
{{ __('student.Category_Name') }}
                                    </label>
                                    <select name="category_id" class="level-multi form-control">
                                       <option value="">{{ __('student.Select_Category_Name') }}</option>
                                       @foreach($getcategory as $value_c)
                                       <option {{ ( $value_c->id == $record->category_id) ? 'selected' : '' }} value="{{ $value_c->id }}">{{ $value_c->getcategoryname() }}</option>
                                       @endforeach
                                    </select>
                                 </div>
                                 <div class="form-group">
                                    <label style="font-size: 18px;" for="request-lang-multi">{{ __('student.Lesson_language') }}</label>
                                    <select name="language_id" class="request-lang-multi form-control">
                                       <option value="">{{ __('student.Select_Lesson_language') }}</option>
                                       @foreach($getlanguage as $value_l)
                                       <option {{ ( $value_l->id == $record->language_id) ? 'selected' : '' }} value="{{ $value_l->id }}">{{ $value_l->getlanguagename() }}</option>
                                       @endforeach
                                    </select>
                                 </div>
                              </div>
                           </div>
                           <div class="form-group title-field">
                              <label for="request-title">
{{ __('student.Price_For_Each_Lesson') }}
                              </label>
                              <input type="text" value="{{ old('rate_per_hour',$record->rate_per_hour) }}" name="rate_per_hour" class="request-title form-control" placeholder="{{ __('student.Enter_Your_Price_For_Each_Lesson') }}" required>
                           </div>


                           <div class="book-form-check custom">
                              <h5 class="label">{{ __('student.What_type_of_lesson_do_you_need') }}</h5>
                                 @foreach($getrequesttype as $type)

                                 <div class="form-group d-inline-flex align-items-center mb-0 mr-4">
                                    <input type="radio" {{ ($record->request_type_id == $type->id)?'checked':'' }} name="request_type_id"  required id="getRequestType{{ $type->id }}" class="reg-check form-check-input" value="{{ $type->id }}">
                                    <label for="getRequestType{{ $type->id }}" class="form-check-label">{{ $type->request_type_name }}</label>
                                 </div>

                                 @endforeach
                           </div>

         
                           <div class="time-picker">
                              <div class="form-group">
                                 <label for="request-time-from">{{ __('student.Request_Time') }}</label>
                                 <p class="time-picker-desc">
                                    {{ __('student.Time_zone_changed_automatically') }}
                                   
                                 </p>
                                 <div class="form-check-inline">
                                 	<input type="date" name="lesson_date" value="{{ $record->lesson_start_date }}" required class="book-time form-control">
                                 	<span class="time-picker-separator">&amp;</span>

                                    <input type="time" name="lesson_time" value="{{ $record->lesson_start_time }}" required id="request-time-from" style="padding: 0px;" class="book-time form-control">

                                    <span class="time-picker-separator">&amp;</span>
                                    <input type="text" name="duration" value="{{ $record->duration }}" required placeholder="Duration(60 Minutes)" id="request-time-to" class="book-time form-control">
                                 </div>
                              </div>
                           </div>
                           <div class="text-message">
                              <div class="form-group">
                                 <label for="request-message">{{ __('student.What_do_you_want_to_learn') }}</label>
                                 <textarea name="request_description" id="request-message" class="booking-message request-message form-control" placeholder="{{ __('student.Type_a_Description') }}" cols="10" rows="5">{{ old('request_description',trim($record->request_description)) }}</textarea>
                              </div>
                           </div>
                           <button type="submit" class="request-submit-btn reg-signup-btn text-capitalize">{{ __('student.Update_Request') }}</button>
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
<!-- end: main content -->

@endsection
