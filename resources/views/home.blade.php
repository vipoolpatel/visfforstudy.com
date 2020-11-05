@extends('layouts.app')
{{-- @section('stylesheet')
<style type="text/css">
</style>
@endsection  --}}
@section('content')
<!-- start: hero area -->
<section class="hero-area">

   <div class="hero-bg" style="background-image: url({{ url('assets/img/banner-bg/banner-bg-1.jpg') }});"></div>
   <div class="hero-overlay"></div>
   <div class="container h-100">
      <div class="row align-items-center h-100">
         <!-- hero main content -->
         <div class="col-12 col-lg-7">
            <div class="hero-main-content">
               <h1 class="hero-title">
                  {{ __('home.Education_is_Power') }}<br/>
                 {{ __('home.It_Brings_Prosperity') }}
                 
               </h1>
               <div class="hero-action-btn-box">
                  <a href="{{ url('become-tutor') }}" class="hero-action-btn join-btn">       {{ __('home.Join_us_now') }}</a>
               </div>
            </div>
         </div>
      </div>
   </div>
</section>
<!-- end: hero area -->
<!-- start: main content -->
<div id="main-content" class="main-content">
   <!-- start: subject section -->
   <section class="subject-section pb-0">
      <div class="container">
         <div class="section-heading">
            <p class="section-subtitle">{{ __('home.What') }}</p>
            <h2 class="section-title"> {{ __('home.Do_you_want_to_learn') }}</h2>
         </div>
         <div class="section-content">
            <div class="container">
               <div class="row">
                    @foreach($getcategory as $value)
                     <div class="col-6 col-sm-4 col-lg-3 col-xl-2">
                        <div class="single-subject-box text-center">
                           <div class="subject-image">
                              <img src="{!! $value->getImage() !!}" alt="{!! $value->getcategoryname() !!}">
                           </div>
                           <a href="{{ url('find-tutor?category_id='. $value->id) }}" class="subject-name">{!! $value->getcategoryname() !!}</a>
                        </div>
                     </div>
                  @endforeach
               </div>
            </div>
         </div>
      </div>
   </section>
   <!-- end: subject section -->
   <!-- start: student request section -->
   <section class="student-request-section">
      <!-- child section -->
      <div class="child-section">
         <div class="container">
            <div class="section-content img-text-box">
               <div class="row align-items-lg-center">
                  <div class="col-12 col-lg-6">
                     <div class="section-img-cont">
                        <div class="section-img-inner">
                           <img src="{{ url('assets/img/woman-on-laptop-small.jpg') }}" alt="request-image">
                        </div>
                     </div>
                  </div>
                  <div class="col-12 col-lg-6">
                     <div class="section-text-cont pl-0">
                        <div class="section-heading">
                           <h2 class="section-title">
                              <span class="colored-text">{{ __('home.Student') }}</span>{{ __('home.Requests') }}
                              
                           </h2>
                        </div>
                        <p class="text">
                           {{ __('home.Students_will_create') }}
                         
                        </p>
                     </div>
                  </div>
               </div>
            </div>
         </div>
      </div>
      <!-- child section: latest student requests -->
      <div class="child-section latest-requests featured-profiles">
         <div class="container">
            <div class="section-heading text-center">
               <h2 class="section-title">
                  
                    {{ __('home.Latest_student') }}
                  <span class="colored-text"> {{ __('home.Requests') }}</span>
               </h2>
            </div>
            <div class="section-content">
               <div class="row justify-content-center">
                  {{-- Start --}}
               @foreach ($getrecordrequest as $value_request)
   

                  <div class="col-12 col-sm-6 col-md-4 col-lg-3 col-xl-2dot4">
                     <div class="profile-summary">
                        <div class="user-profile text-center text-capitalize">
                           <div class="profile-image">
                              <img src="{!! $value_request->getusers->getImage() !!}" alt="profile-picture">
                              <span class="lesson-rate">
                              <span class="price">${{ $value_request->rate_per_hour }}</span>
                              <span class="text">/{{ __('home.Lesson') }}</span>
                              </span>
                           </div>
                           <h3 class="profile-name">
                              {{ ucfirst(!empty($value_request->getusers->name)?$value_request->getusers->name: '') }} {{ ucfirst(!empty($value_request->getusers->last_name)?$value_request->getusers->last_name: '') }}

                           </h3>
                           <p class="local-time thin-colored-text text-left">
                              <span class="flag"><img src="{!! $value_request->getusers->getcountry->getImage() !!}" alt="flag-china"></span>
                              <span class="date-time">
                              <span class="time">{!! $value_request->getusers->gettimezonedate() !!}</span>
                              <span class="date"></span>
                              </span>
                           </p>
                           <div class="rating">
                              <span class="stars">
                              <span><i class="fas fa-star"></i></span>
                              <span><i class="fas fa-star"></i></span>
                              <span><i class="fas fa-star"></i></span>
                              <span><i class="fas fa-star"></i></span>
                              <span><i class="fas fa-star"></i></span>
                              </span>
                              <span class="point">4.00</span>
                              <span class="text">{{ __('home.Rating') }}</span>
                           </div>
                           <div class="lesson-history-items-box">
                              <p class="lesson-history-item">
                                 <span class="history-label text-capitalize d-flex align-items-center">
                                 <i class="fas fa-user"></i>{{ __('home.Request_Type') }}
                                 </span>
                                 <span class="history-info">{{ !empty($value_request->getrequesttype->getrequesttypename())?$value_request->getrequesttype->getrequesttypename(): '' }}</span>
                              </p>
                              <p class="lesson-history-item">
                                 <span class="history-label text-capitalize d-flex align-items-center">
                                 <i class="fas fa-signal"></i>{{ __('home.Level_of_Student') }}
                                 </span>
                                 <span class="history-info">
                                    {{ !empty($value_request->getlevelofstudent->getlevelofstudentname())?$value_request->getlevelofstudent->getlevelofstudentname(): '' }}
                                 </span>
                              </p>
                              <p class="lesson-history-item">
                                 <span class="history-label text-capitalize d-flex align-items-center">
                                 <i class="fas fa-list"></i>{{ __('home.Category') }}
                                 </span>
                                 <span class="history-info">{{ !empty($value_request->getcategory->getcategoryname())?$value_request->getcategory->getcategoryname(): '' }}</span>
                              </p>
                              <p class="lesson-history-item">
                                 <span class="history-label text-capitalize d-flex align-items-center">
                                 <i class="fas fa-clipboard-list"></i>{{ __('home.Lesson_Date') }}
                                 </span>
                                 <span class="history-info">{{ date('Y-m-d', strtotime($value_request->lesson_start_date)) }}</span>
                              </p>
                              <p class="lesson-history-item">
                                 <span class="history-label text-capitalize d-flex align-items-center">
                                 <i class="far fa-calendar-alt"></i>
                                 {{ __('home.Lesson_Start_Time') }}

                                 </span>
                                 <span class="history-info">{{ date('h:i:A', strtotime($value_request->start_time)) }}</span>
                              </p>
                              <p class="lesson-history-item">
                                 <span class="history-label text-capitalize d-flex align-items-center">
                                 <i class="far fa-calendar-minus"></i>
                                  {{ __('home.Lesson_Duration') }}
                                 </span>
                                 <span class="history-info">{{ $value_request->duration }} {{ __('home.munites') }}</span>
                              </p>
                              <p class="lesson-history-item">
                                 <span class="history-label text-capitalize d-flex align-items-center">
                                 <i class="fas fa-calendar-alt"></i>
                                 {{ __('home.Published_Date') }}

                                 </span>
                                 <span class="history-info">{{ date('Y-m-d h:i A', strtotime($value_request->created_at)) }}</span>
                              </p>
                           </div>
                           <a href="{{ url('student-profile/'.$value_request->id) }}" class="button view-request thin-bg mb-2">
                        {{ __('home.View_Request') }}
                           </a>
                        </div>
                      
                     </div>
                  </div>
               @endforeach
                  {{-- End --}}
                  
                  
                  
                
               </div>
               <div class="all-profile-link-box text-right">
                  <a href="{{ url('find-student') }}" class="button all-profile-link">
                    {{ __('home.More_students') }}
                  <i class="fas fa-angle-double-right"></i>
                  </a>
               </div>
            </div>
         </div>
      </div>
   </section>
   <!-- end: student request section -->
   <!-- start: online teachers section -->
   <section class="online-teachers-section">
      <!-- child section -->
      <div class="child-section">
         <div class="container">
            <div class="section-content img-text-box">
               <div class="row align-items-lg-center">
                  <div class="col-12 col-lg-6 order-2 order-lg-1">
                     <div class="section-text-cont pr-0">
                        <div class="section-heading">
                           <h2 class="section-title">
                              <span class="colored-text">{{ __('home.Online') }}</span>
                              {{ __('home.Teachers') }}
                           </h2>
                        </div>
                        <p class="text">
                             {{ __('home.Teachers_are_online_now') }}
                          
                        </p>
                     </div>
                  </div>
                  <div class="col-12 col-lg-6 order-1 order-lg-2">
                     <div class="section-img-cont text-right">
                        <div class="section-img-inner">
                           <img src="{{ url('assets/img/man-holding-notes.jpg') }}" alt="online-teacher-image">
                        </div>
                     </div>
                  </div>
               </div>
            </div>
         </div>
      </div>
      <!-- child section: featured profiles -->
      <div class="child-section featured-profiles">
         <div class="container">
            <div class="section-content">
               <div class="row justify-content-center">
                  {{-- Start --}}
                  @foreach ($getrecord as $value_user)
                     
                  
                  <div class="col-12 col-sm-6 col-md-4 col-lg-3 col-xl-2dot4">
                     <div class="profile-summary">
                        <div class="user-profile text-center text-capitalize">
                           <div class="profile-image">
                              <img src="{!! $value_user->getImage() !!}" alt="profile-picture">
                               @if(!empty($value_user->hour_per_rate))
                                <span class="lesson-rate">
                                  <span class="price">${{ $value_user->hour_per_rate }}</span>
                                  <span class="text">/{{ __('home.Lesson') }}</span>
                                </span>
                             @endif
                           </div>
                           <h3 class="profile-name">
                              {{ ucfirst(!empty($value_user->name)?$value_user->name: '') }} {{ ucfirst(!empty($value_user->last_name)?$value_user->last_name: '') }}

                           </h3>
                           @if (!empty($value_user->experience_of_teacher))
                           <p class="profile-designation">{{ $value_user->experience_of_teacher }} {{ __('home.Years_Experienced') }}</p>
                           @else
                           <p class="profile-designation">-</p>
                           @endif
                           <p class="local-time thin-colored-text text-left">
                              <span class="flag"><img src="{!! $value_user->getcountry->getImage() !!}" alt="flag-china"></span>
                              <span class="date-time">
                              <span class="time">{!! $value_user->gettimezonedate() !!}</span>
                              </span>
                           </p>
                           <div class="rating">
                              <span class="stars">
                              <span><i class="fas fa-star"></i></span>
                              <span><i class="fas fa-star"></i></span>
                              <span><i class="fas fa-star"></i></span>
                              <span><i class="fas fa-star"></i></span>
                              <span><i class="fas fa-star"></i></span>
                              </span>
                              <span class="point">4.00</span>
                              <span class="text">{{ __('home.Rating') }}</span>
                           </div>
                           <div class="lesson-history-items-box">
                              <p class="lesson-history-item">
                                 <span class="history-label text-capitalize d-flex align-items-center">
                                 <i class="fas fa-envelope"></i>
                                 
                                 {{ __('home.Average_Reply_Time') }}
                                 </span>
                                 <span class="history-info">1  {{ __('home.Hour') }}</span>
                              </p>
                              <p class="lesson-history-item">
                                 <span class="history-label text-capitalize d-flex align-items-center">
                                 <i class="fas fa-sync-alt"></i>
                                  {{ __('home.Repeat_tudent') }}
                                 </span>
                                 <span class="history-info">15</span>
                              </p>
                              <p class="lesson-history-item">
                                 <span class="history-label text-capitalize d-flex align-items-center">
                                 <i class="fas fa-signal"></i>
                                
                                  {{ __('home.Level_of_Teacher') }}
                                 </span>
                                 <span class="history-info">
{{-- {{ !empty($value_user->getlevelofstudent->level_of_student_name) ? ucfirst($value_user->getlevelofstudent->level_of_student_name) : '-' }}
 --}}
{{ !empty($value_user->getlevelofstudent->getlevelofstudentname())? $value_user->getlevelofstudent->getlevelofstudentname() : '' }}
                                 </span>
                              </p>
                              <p class="lesson-history-item">
                                 <span class="history-label text-capitalize d-flex align-items-center">
                                 <i class="fas fa-list"></i>
                                   {{ __('home.Category') }}
                                 </span>
                                 <span class="history-info">{{ !empty($value_user->getcategory->getcategoryname())? $value_user->getcategory->getcategoryname() : '' }}</span>
                              </p>
                              <p class="lesson-history-item">
                                 <span class="history-label text-capitalize d-flex align-items-center">
                                 <i class="far fa-edit"></i>
                           {{ __('home.Lesson_Language') }}
                                                                  </span>
                                 <span class="history-info">

                                 @php
                                 $get_langauge = '';
                                 @endphp
                                 @foreach($value_user->get_langauge as $key => $value_l)
                                     @php
                                       $get_langauge .= $value_l->getuserlanguage->getlanguagename().', ';
                                     @endphp
                                 @endforeach
                                 {{ trim($get_langauge,', ') }}
                                 
                                 </span>
                                 
                              </p>
                           </div>
                           <a href="{{ url('tutor-profile/'. $value_user->id) }}" class="button view-bio thin-bg mb-2">{{ __('home.View_my_bio') }}</a>
                           <a href="{{ url('book-lesson') }}" class="button book-lesson deep-bg">{{ __('home.Book_a_Lesson') }}</a>
                        </div>
                     </div>
                  </div>
                  @endforeach
                  {{-- end --}}
               </div>
               <div class="all-profile-link-box text-right">
                  <a href="{{ url('find-tutor') }}" class="button all-profile-link">
                  {{ __('home.More_teachers') }}
                  <i class="fas fa-angle-double-right"></i>
                  </a>
               </div>
            </div>
         </div>
      </div>
   </section>
   <!-- end: online teachers section -->
   <!-- start: head teacher section -->
   <section class="head-teacher-section">
      <div class="container">
         <div class="section-content img-text-box">
            <div class="row">
               <div class="col-12 col-lg-6 order-2 order-lg-1">
                  <div class="section-text-cont">
                     <div class="section-heading">
                        <p class="section-subtitle"> {{ __('home.Isabella') }}</p>
                        <h2 class="section-title">
                            {{ __('home.Head_Teacher') }}
                        </h2>
                     </div>
                     <p class="text">
                         {{ __('home.Lorem_ipsum_dolor_sit_amet') }}
                        
                     </p>
                  </div>
               </div>
               <div class="col-12 col-lg-6 order-1 order-lg-2">
                  <div class="section-img-cont">
                     <div class="section-img-inner">
                        <img src="{{ url('assets/img/woman-with-books.jpg') }}" alt="head-teacher-image">
                     </div>
                  </div>
               </div>
            </div>
         </div>
      </div>
   </section>
   <!-- end: head teacher section -->
   <!-- start: how to teacher section -->
   <section class="howto-teacher-section">
      <div class="container">
         <div class="section-content img-text-box">
            <div class="row align-items-lg-center">
               <div class="col-12 col-lg-6">
                  <div class="section-img-cont">
                     <div class="section-img-inner">
                        <img src="{{ url('assets/img/female-male-studying-with-overlay.png') }}" alt="online-teacher-image">
                     </div>
                  </div>
               </div>
               <div class="col-12 col-lg-6">
                  <div class="section-text-cont">
                     <div class="section-heading">
                        <p class="section-subtitle">{{ __('home.How_to') }}</p>
                        <h2 class="section-title">
                         
                           {{ __('home.Become_an_online_teacher') }}
                        </h2>
                     </div>
                     <ul class="howto-teacher-instructions text">
                        <li>{{ __('home.Upload_your_resume') }}</li>
                        <li>{{ __('home.Join_Holly') }}
                        </li>
                        <li>{{ __('home.Join_a_mock_lesson') }}</li>
                        <li>{{ __('home.Registration_successfully') }}</li>
                     </ul>
                  </div>
               </div>
            </div>
         </div>
      </div>
   </section>
   <!-- end: how to teacher -->
   <!-- start: online features section -->
   <section class="online-features-section">
      <div class="container">
         <div class="section-content">
            <div class="row align-items-lg-center">
               <div class="col-12 col-lg-6 order-2 order-lg-1">
                  <div class="section-text-cont">
                     <div class="online-features">
                        <p class="single-item">
                           <span class="icon"><i class="fas fa-comments"></i></span>
                           <span class="item-text">
                           <span class="label text-uppercase">{{ __('home.Chat') }}</span>
                           <span class="desc">{{ __('home.Send_public_and_private_chat') }}</span>
                           </span>
                        </p>
                        <p class="single-item">
                           <span class="icon"><img src="{{ url('assets/img/iconic-webcam.png') }}" alt="webcam-icon"></span>
                           <span class="item-text">
                           <span class="label text-uppercase">{{ __('home.Webcams') }}</span>
                           <span class="desc">{{ __('home.Hold_Virtual_meetings') }}</span>
                           </span>
                        </p>
                        <p class="single-item">
                           <span class="icon"><i class="fas fa-microphone"></i></span>
                           <span class="item-text">
                           <span class="label text-uppercase">{{ __('home.Audio') }}</span>
                           <span class="desc">{{ __('home.Communicate_using_high_quality_audio') }}</span>
                           </span>
                        </p>
                        <p class="single-item">
                           <span class="icon"><i class="far fa-smile-beam"></i></span>
                           <span class="item-text">
                           <span class="label text-uppercase">
                           {{ __('home.Emojis') }}</span>
                           <span class="desc">{{ __('home.Express_yourself') }}</span>
                           </span>
                        </p>
                        <p class="single-item">
                           <span class="icon"><i class="far fa-edit"></i></span>
                           <span class="item-text">
                           <span class="label text-uppercase">
                           {{ __('home.Multi_user_whiteboard') }}
                           </span>
                           <span class="desc">{{ __('home.Draw_together') }}</span>
                           </span>
                        </p>
                        <p class="single-item">
                           <span class="icon"><img src="{{ url('assets/img/iconic-screenshare.png') }}" alt="screen-share-icon"></span>
                           <span class="item-text">
                           <span class="label text-uppercase">{{ __('home.Screen_sharing') }}</span>
                           <span class="desc">{{ __('home.Share_your_Screen') }}</span>
                           </span>
                        </p>
                        <p class="single-item">
                           <span class="icon"><img src="{{ url('assets/img/iconic-polling.png') }}" alt="polling-icon"></span>
                           <span class="item-text">
                           <span class="label text-uppercase">{{ __('home.Polling') }}</span>
                           <span class="desc">
                        {{ __('home.Poll_your_user_anytime') }}
                           </span>
                           </span>
                        </p>
                        <p class="single-item">
                           <span class="icon"><i class="fas fa-users"></i></span>
                           <span class="item-text">
                           <span class="label text-uppercase">
{{ __('home.Breakout_rooms') }}
                           </span>
                           <span class="desc">
{{ __('home.Group_Users_into_breakout') }}
                          </span>
                           </span>
                        </p>
                     </div>
                  </div>
               </div>
               <div class="col-12 col-lg-6 order-1 order-lg-2">
                  <div class="section-img-cont">
                     <div class="section-img-inner">
                        <img src="{{ url('assets/img/visffor-live.jpg') }}" alt="live-image">
                     </div>
                  </div>
               </div>
            </div>
         </div>
      </div>
   </section>
   <!-- end: online features section -->
   <!-- start: about us section -->
   <section class="about-us-section">
      <div class="container">
         <div class="section-content img-text-box">
            <div class="row align-items-lg-center">
               <div class="col-12 col-lg-6">
                  <div class="section-img-cont">
                     <div class="section-img-inner">
                        <img src="{{ url('assets/img/online-live-chat_with-overlay.png') }}" alt="live-chat-image">
                     </div>
                  </div>
               </div>
               <div class="col-12 col-lg-6">
                  <div class="section-text-cont">
                     <div class="section-heading">
                        <p class="section-subtitle">{{ __('home.About_us') }}</p>
                        <h2 class="section-title">
                           
                           {{ __('home.Learn_on_your_Schedule') }}
                        </h2>
                     </div>
                     <p class="text">
                        {{ __('home.Visitor_Education_is_an_online') }}
                        
                     </p>
                  </div>
               </div>
            </div>
         </div>
      </div>
   </section>
   <!-- end: about us section -->
   <!-- start: why us section -->
   <section class="why-us-section">
      <div class="why-us-sec-bg"></div>
      <div class="why-us-bg-overlay"></div>
      <div class="container">
         <div class="section-heading text-center mb-2">
            <h2 class="section-title">
              
                {{ __('home.Five_Reason_To_Choose_Us') }}
            </h2>
            <p class="section-desc">
               {{ __('home.We_Serve_you_the_best_online_education_service') }}
               <br/>
             
                  {{ __('home.You_can_learn_and_Teach_here') }}
            </p>
         </div>
         <div class="section-content whys-us-reasons text-center">
            <div class="row justify-content-center">
               <div class="col-10 col-sm-6 col-md-4 col-lg-2dot4">
                  <div class="single-reason">
                     <div class="reason-icon">
                        <i class="far fa-gem"></i>
                     </div>
                     <p class="reason-name">
 {{ __('home.Career_advancement_and_hobbies') }}
                     </p>
                  </div>
               </div>
               <div class="col-10 col-sm-6 col-md-4 col-lg-2dot4">
                  <div class="single-reason">
                     <div class="reason-icon">
                        <i class="far fa-paper-plane"></i>
                     </div>
                     <p class="reason-name">
{{ __('home.More_choice_of_course_topics') }}
                     </p>
                  </div>
               </div>
               <div class="col-10 col-sm-6 col-md-4 col-lg-2dot4">
                  <div class="single-reason">
                     <div class="reason-icon">
                        <i class="fas fa-book-reader"></i>
                     </div>
                     <p class="reason-name">
{{ __('home.Large_Group_of_Students') }}
                     </p>
                  </div>
               </div>
               <div class="col-10 col-sm-6 col-md-4 col-lg-2dot4">
                  <div class="single-reason">
                     <div class="reason-icon">
                        <img src="{{ url('assets/img/iconic-calendar-white.png') }}" alt="calendar-icon">
                     </div>
                     <p class="reason-name">
{{ __('home.Flexible_schedule_and_environment') }}
                    </p>
                  </div>
               </div>
               <div class="col-10 col-sm-6 col-md-4 col-lg-2dot4">
                  <div class="single-reason">
                     <div class="reason-icon">
                        <i class="far fa-user"></i>
                     </div>
                     <p class="reason-name">{{ __('home.Qualified_Teachers') }}</p>
                  </div>
               </div>
            </div>
         </div>
      </div>
   </section>
   <!-- end: why us section -->
   <!-- start: location section -->
   <section class="location-section">
      <div class="container">
         <div class="section-heading">
            <p class="section-subtitle">{{ __('home.Our') }}</p>
            <h2 class="section-title">
                {{ __('home.Location') }}
            </h2>
         </div>
         <div class="section-content">
            <div class="row justify-content-center">
               <div class="col-12 col-lg-10 col-xl-8">
                  <div class="location-map">
                     <div class="section-img-inner">
                        <img src="{{ url('assets/img/custom-map.png') }}" alt="location-map-image">
                     </div>
                     <div class="location-text loc-china">
                        <h6 class="map-loc-name">{{ __('home.China') }}</h6>
                        <p class="map-loc-address">
                          {{ __('home.Yuetan_South_Street') }} 
                        </p>
                        <p class="map-loc-phone">{{ __('home.Landline') }}:(+86)-010-57173657</p>
                     </div>
                     <div class="location-text loc-uk">
                        <h6 class="map-loc-name">{{ __('home.United_Kingdom') }}</h6>
                        <p class="map-loc-address">
                          {{ __('home.City_Point') }}
                        </p>
                        <p class="map-loc-phone">{{ __('home.TEL') }}:(+44)07455962168</p>
                     </div>
                  </div>
               </div>
            </div>
         </div>
      </div>
   </section>
   <!-- end: location section -->
</div>
<!-- end: main content -->
@endsection

