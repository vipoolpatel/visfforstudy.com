@extends('backend.layouts.app')
@section('content')

<section class="hero-area loggedin-hero-area">
   <div class="hero-bg" style="background-image: url({{ url('assets/img/banner-bg/banner-bg-8.jpg')  }});"></div>
   <div class="hero-overlay"></div>
   <div class="container h-100">
      <div class="row align-items-lg-center h-100">
         <!-- hero main content -->
         <div class="col-12 col-lg-11 offset-lg-1 h-100">
            <!-- hero main content -->
            <div class="hero-main-content">
               <h2 class="hero-title text-capitalize">{{ __('tutor.Create_your_offer') }}</h2>
               
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
   
<div class="main-content">
   <div class="container">
      <div class="row">
         <div class="col-lg-12">
            <!-- start: offer section -->
            <section class="create-offer-section booking-section">
               <div class="row">
                  <div class="col-lg-11 offset-lg-1">
                     <div class="find-multi-search-box booking-form-container">
                        <form action="" method="post" class="booking-form offer-form">
                           {{ csrf_field() }}  
                           <div class="form-group title-field">
                              <label for="offer-title">{{ __('tutor.Student_Name') }}</label>
                              <select  style="max-width: 700px !important;" required name="student_id" class="form-control">
                                 <option value="">{{ __('tutor.Select_Student') }}</option>
                                 @foreach($getStudent as $value)
                                    <option value="{{ $value->id }}">{{ $value->name }} {{ $value->last_name }}</option>
                                 @endforeach
                              </select>
                           </div>

                           <div class="form-group title-field">
                              <label for="offer-title">{{ __('tutor.Offer_title') }}</label>
                              <input type="text" name="title" required class="offer-title form-control" placeholder="{{ __('tutor.Enter_your_offer_title') }}">
                           </div>

                           <div class="multi-search-form d-flex align-items-end">
                              <div class="input-group">
                                  
                                 <div class="form-group">
                                    <label for="offer-subject-multi" style="font-size: 18px;">
{{ __('tutor.What_Subject_You_Want_to_teach') }}
</label>
                                    <select name="category_id" id="offer-subject-multi" required class="subject-multi form-control">
                                       <option value="">
{{ __('tutor.Select_What_Subject_You_Want_to_teach') }}
                                       </option>
                                       @foreach($getCategory as $value_c) 
                                          <option value="{{ $value_c->id }}">{{ $value_c->getcategoryname() }}</option>
                                       @endforeach
                                    </select>
                                 </div>
                                 <div class="form-group">
                                    <label for="offer-level-multi" style="font-size: 18px;">{{ __('tutor.Whats_Your_Level') }}</label>
                                    <select name="level_id" id="offer-level-multi" required class="level-multi form-control">
                                       <option value="">{{ __('tutor.Select_Whats_Your_Level') }}</option>
                                       @foreach($getLevelOfStudent as $value_c) 
                                          <option value="{{ $value_c->id }}">{{ $value_c->getlevelofstudentname() }}</option>
                                       @endforeach
                                    </select>
                                 </div>
                                 <div class="form-group">
                                    <label for="offer-lang-multi" style="font-size: 18px;">{{ __('tutor.Lesson_language') }}</label>
                                    <select name="language_id" id="offer-lang-multi" required class="offer-lang-multi form-control">
                                       <option value="">{{ __('tutor.Select_Lesson_Language') }}</option>
                                       @foreach($getLanguage as $value_l) 
                                          <option value="{{ $value_l->id }}">{{ $value_l->getlanguagename() }}</option>
                                       @endforeach
                                    </select>
                                 </div>
                           
                              </div>
                           </div>


                           <div class="form-group title-field">
                                 <label>{{ __('tutor.Price_For_Each_Lesson') }}</label>
                                 <input type="text" name="lesson_per_rate" required class="publish-course-title form-control" placeholder="{{ __('tutor.Price_For_Each_Lesson') }}">
                           </div>


                           <div class="book-form-check custom">
                              <h5 class="label">{{ __('tutor.What_type_of_lesson_do_you_Provide') }}</h5>

                                 @foreach($getrequesttype as $type)
                                 <div class="form-group d-inline-flex align-items-center mb-0 mr-4">
                                    <input type="radio" name="lesson_type_id"  required id="getRequestType{{ $type->id }}" class="reg-check form-check-input" value="{{ $type->id }}">
                                    <label for="getRequestType{{ $type->id }}" class="form-check-label">{{ $type->request_type_name }}</label>
                                 </div>
                                  @endforeach

                           </div>


                           <div class="time-picker">
                              <div class="form-group">
                                 <label for="offer-time-from">{{ __('tutor.Lesson_Date_Time') }}</label>
                                 <p class="time-picker-desc">
                              {{ __('tutor.Time_zone_changed_automatically') }}
                                    
                                 </p>
                                 <div class="form-check-inline">
                                    <input type="date" required name="lesson_date" class="form-control">

                                    <span class="time-picker-separator">&amp;</span>
                                    
                                    <input type="time" required style="padding: 0px;padding-left: 10px;" name="lesson_time" class="form-control">

                                    <span class="time-picker-separator">&amp;</span>

                                    <input type="text" required name="duration" class="form-control" placeholder="{{ __('tutor.Duration_Minutes') }}">

                                 </div>
                              </div>
                           </div>

                           <div class="text-message">
                              <div class="form-group">
                                 <label for="offer-message">{{ __('tutor.What_do_you_want_to_Teach') }}</label>
                                 <textarea name="description" id="offer-message" class="booking-message offer-message form-control" placeholder="{{ __('tutor.Type_a_Description') }}" cols="10" rows="5"></textarea>
                              </div>
                           </div>

                           <div class="offer-submit-btn-cont">
                              <button type="submit" class="offer-submit-btn reg-signup-btn text-capitalize">{{ __('tutor.Send_offer') }}</button>
                           </div>
                        </form>                          
                     </div>
                  </div>
               </div>
            </section>
            <!-- end: offer section -->
         </div>
      </div>
   </div>
</div>

@endsection