@extends('layouts.app')
@section('style')
<style type="text/css">
	.modal-sm {
	    max-width: 500px !important;
	}
</style>
@endsection 
@section('content')
<!-- start: hero area -->
<section class="hero-area">
   <div class="hero-bg" style="background-image: url({{ url('assets/img/banner-bg/banner-bg-2.jpg')  }});"></div>
   <div class="hero-overlay"></div>
   <div class="container h-100">
      <div class="row justify-content-center align-items-lg-center h-100">
         <!-- user profile summery -->
         <div class="col-12 col-lg-4 profile-summary order-2 order-lg-1">
            <div class="user-profile text-center text-capitalize">
               <div class="profile-image">
                  <img src="{!! $getrecord->getImage() !!}" alt="{{ $getrecord->getName() }}">
                  @if($getrecord->OnlineUser())
                  <span class="online-status d-flex align-items-center" style="color: green;border: 1px solid green;"><i class="fas fa-circle"></i> {{ __('find_tutor.Online') }}</span>
                  @endif
                  <span class="lesson-rate">
                  <span class="price">${{ $getrecord->hour_per_rate}}</span>
                  <span class="text">/{{ __('find_tutor.Lesson') }}</span>
                  </span>
               </div>
               <h3 class="profile-name">{{ $getrecord->getName() }}</h3>
               @if (!empty($getrecord->experience_of_teacher))
               <p class="profile-designation">{{ $getrecord->experience_of_teacher }} {{ __('find_tutor.Years_Experienced') }}</p>
               @endif
               <div class="rating">
                  <span class="stars">
                     {!! $getrecord->getHTMLRating() !!}
                  </span>
                  <span class="point">{!! $getrecord->averageRating() !!}</span>
                  <span class="text">{{ __('find_tutor.Rating') }}</span>
               </div>
               @if (!empty($getrecord->about_us))
               <a href="#bio" class="button scrolls view-bio thin-bg">{{ __('find_tutor.View_my_bio') }}</a>
               @endif
               <div class="short-info">
                  <p class="d-flex justify-content-between">
                     <span class="label">{{ __('find_tutor.Repeat_student') }}</span>
                     <span class="value">15</span>
                  </p>
                  <p class="d-flex justify-content-between">
                     <span class="label">{{ __('find_tutor.Average_Reply_Time') }}</span>
                     <span class="value">1 {{ __('find_tutor.Hour') }}</span>
                  </p>
                  <p class="d-flex justify-content-between">
                     <span class="label">{{ __('find_tutor.Level') }}</span>
                     <span class="value">
                       {{--  {{ !empty($getrecord->getlevelofstudent->level_of_student_name) ? ucfirst($getrecord->getlevelofstudent->level_of_student_name) : '-' }} --}}
{{ !empty($getrecord->getlevelofstudent->getlevelofstudentname())? $getrecord->getlevelofstudent->getlevelofstudentname() : '-' }}

                     </span>
                  </p>
                  <p class="d-flex justify-content-between">
                     <span class="label">{{ __('find_tutor.Lesson_Language') }}</span>
                     <span class="value">
                     @php
                     $get_langauge = '';
                     @endphp
                     @foreach($getrecord->get_langauge as $value_l)
                     @php
                     $get_langauge .= $value_l->getuserlanguage->getlanguagename().', ';
                     @endphp
                     @endforeach
                     {{ trim($get_langauge,', ') }}
                     </span>
                  </p>
                  <p class="d-flex justify-content-between">
                     <span class="label">{{ __('find_tutor.Local_time') }}</span>
                     <span class="value">
                     {{ $getrecord->gettimezonedate() }}
                     </span>
                  </p>
               </div>

               <a href="{!! $getrecord->getbooklessonlink() !!}" class="button book-lesson deep-bg">{{ __('find_tutor.Book_a_Lesson') }}</a>


               <a style="cursor: pointer; margin-top: 10px;"  class="button book-lesson deep-bg ContactMe" id="{{ $getrecord->id }}">Contact Me</a>


            </div>
         </div>
         <!-- hero main content -->
         <div class="col-12 col-lg-8 ml-lg-auto order-1 order-lg-2 h-100">
            <!-- hero main content -->
            <div class="hero-main-content">
               <h1 class="hero-title-name text-capitalize">{{ $getrecord->getName() }}</h1>
               <div class="rating">
                  <span class="stars">
                     {!! $getrecord->getHTMLRating() !!}
                  </span>
                  <span class="point">{!! $getrecord->averageRating() !!}</span>
                  <span class="text">{{ __('find_tutor.Rating') }}</span>
               </div>
               <h3 class="hero-subtitle text-capitalize">
                  {{ !empty($getrecord->getcategory->category_name)? $getrecord->getcategory->category_name : '' }}
               </h3>
            </div>
            <!-- profile hero menu -->
            <nav class="hero-menu-tabs-container">
               @if (!empty($getrecord->about_us))
               <a class="hero-menu-tab" href="#bio">{{ __('find_tutor.Bio') }}</a>
               @endif
               @if(!empty(count($getsubject)))
               <a class="hero-menu-tab" href="#subjects">{{ __('find_tutor.Subjects') }}</a>
               @endif
               @if(!empty(count($getrecord->get_qulification)))
               <a class="hero-menu-tab" href="#qualifications"> {{ __('find_tutor.Qualifications') }}</a>
               @endif
               <a class="hero-menu-tab" href="#availability">{{ __('find_tutor.Availability') }}</a>
               <a class="hero-menu-tab" href="#rating">{{ __('find_tutor.Rating') }}</a>
               <a class="hero-menu-tab" href="#reviews">{{ __('find_tutor.Reviews') }}</a>
               <span class="hero-menu-tab-slider"></span>
               <button type="button" id="mobile-menu-closer">x</button>
            </nav>
            <!-- mobile menu button -->
            <span class="mobile-menu-button sticky-head">
            <button type="button" id="mobile-menu-opener">
            <span class="icon"><i class="fas fa-bars"></i></span>
            <span class="text ml-1">{{ __('find_tutor.Menu') }}</span>
            </button>
            </span>
         </div>
      </div>
   </div>
</section>
<!-- end: hero area -->
<!-- start: main content -->
<div id="main-content" class="main-content">
   <div class="container">
      <div class="row">
         <div class="col-lg-8 ml-lg-auto pl-lg-0">
            @if(!empty(count($getrecord->get_course)))
            <!-- start: lectures -->
            <section id="lectures" class="lectures">
               <div class="row lectures-content">
                  <!-- current lecture -->
                  <div class="col-lg-7 col-xl-8 mb-5 mb-lg-0">
                     <div class="current-lecture">
                        <div class="current-lecture-player" id="getVideoURL" style="height: auto;"></div>
                        <div class="lecture-info d-flex justify-content-between">
                           <h4 class="lecture-title" id="getCourseTitle"></h4>
                        </div>
                     </div>
                  </div>
                  <!-- other lectures -->
                  <div class="col-lg-5 col-xl-4 pl-lg-0">
                     <div class="other-lectures">
                        <h4 class="other-lectures-heading text-capitalize">{{ __('find_tutor.Courses') }}</h4>
                        <div class="lectures-container">
                           @php
                           $click_i = 0;
                           @endphp
                           @foreach($getrecord->get_course as $value_c)
                           @php
                           $click_i++;
                           @endphp
                           <a style="cursor: pointer;" id="{{ $value_c->id }}" data-type="{{ !empty($value_c->getVideoCourse()) ? '1' : '0' }}" data-url="{{ !empty($value_c->getVideoCourse()) ? $value_c->getVideoCourse() : $value_c->getImageCourse() }}" data-title="{!! $value_c->course_title !!}" class="single-lecture class-course first-click-course{{$click_i}}">
                              <div class="lecture-thumb">
                                 <img src="{!! $value_c->getImageCourse() !!}" alt="lecture">
                              </div>
                              <div class="lecture-info">
                                 <h6 class="lecture-title">{!! $value_c->course_title !!}</h6>
                                 <span class="price">${{ $value_c->lesson_per_rate }} </span>
                              </div>
                           </a>
                           @endforeach
                        </div>
                     </div>
                  </div>
               </div>
            </section>
            <!-- end: lectures -->
            @endif
            @if(!empty($getrecord->about_us))
            <!-- start: bio -->
            <section id="bio" class="bio wow fadeInUp">
               <div class="section-content">
                  <!-- section heading -->
                  <div class="section-heading">
                     <span class="iconic-image">
                     <img src="{!! $getrecord->getImage() !!}" alt="{!! $getrecord->name !!}">
                     </span>
                     <h2 class="section-title">{{ __('find_tutor.Bio') }}</h2>
                  </div>
                  <!-- inner content -->
                  <div class="inner-content">
                     <p>{!! $getrecord->about_us !!}</p>
                  </div>
               </div>
            </section>
            <!-- end: bio -->
            @endif
            @if(!empty(count($getsubject)))
            <!-- start: subjects -->
            <section id="subjects" class="subjects wow fadeInUp">
               <div class="section-content">
                  <!-- section heading -->
                  <div class="section-heading">
                     <span class="iconic-image">
                     <img src="{{ url('assets/img/iconic-book.png') }}" alt="subject">
                     </span>
                     <h2 class="section-title">{{ __('find_tutor.My_Subject') }}</h2>
                  </div>
                  <!-- inner content -->
                  <div class="inner-content">
                     <p style="margin-bottom: 12px;">{{ __('find_tutor.I_teach_Following_Subject') }}</p>
                     @foreach($getsubject as $value)
                     <div class="single-subject-detail d-flex avail-table">
                        <p><span style="margin-right: 10px;" class="checked"><i class="fas fa-check"></i></span> {{ ucwords($value->subject_name) }}</p>
                     </div>
                     @endforeach
                  </div>
               </div>
            </section>
            <!-- end: subjects -->
            @endif
            @if(!empty(count($getrecord->get_qulification)))
            <!-- start: qualifications -->
            <section id="qualifications" class="qualifications wow fadeInUp">
               <div class="section-content">
                  <!-- section heading -->
                  <div class="section-heading">
                     <span class="iconic-image">
                     <img src="{{ url('assets/img/iconic-graduate.png') }}" alt="qualification">
                     </span>
                     <h2 class="section-title">{{ __('find_tutor.My_Qualification') }}</h2>
                  </div>
                  <!-- inner content -->
                  <div class="inner-content">
                     @foreach($getrecord->get_qulification as $value)
                     <div class="single-qualification">
                        <h5 class="qualific-title">{{ ucwords($value->university_name) }}</h5>
                        <div class="qualific-info">
                           <p class="name">{{ ucwords($value->degree) }}</p>
                           <p class="levels">{{ __('find_tutor.Major') }} {{ ucwords($value->major) }}</p>
                           <p class="levels">{{ __('find_tutor.Duration') }} {{ $value->start_year }} - {{ $value->end_year }}</p>
                        </div>
                        {{ __('find_tutor.Description') }} {!! $value->description !!}
                     </div>
                     <hr />
                     @endforeach
                  </div>
               </div>
            </section>
            <!-- end: qualifications -->
            @endif
            <!-- start: availability -->
            <section id="availability" class="availability wow fadeInUp">
               <div class="section-content">
                  <!-- section heading -->
                  <div class="section-heading">
                     <span class="iconic-image">
                     <img src="{{ url('assets/img/iconic-calendar.png') }}" alt="calendar">
                     </span>
                     <h2 class="section-title">{{ __('find_tutor.My_Availability') }}</h2>
                  </div>
                  <!-- inner content -->
                  <div class="inner-content">
                     <p class="avail-desc">{{ __('find_tutor.I_am_available_in_This_time') }}</p>
                     <table class="avail-table">
                        <thead>
                           <th class="day-name"></th>
                              @foreach ($getWeek as $value_week)
                           <th class="day-name">{{ $value_week->week_name }}</th>
                              @endforeach                   
                        </thead>
                        <tbody>
                           @foreach ($getWeekSession as $value_week_session)
                           <tr>
                              <th>
                                 <div class="day-period d-flex align-items-center">
                                    <span>
                                    <img src="{{ url('assets/img/'.$value_week_session->week_session_icon) }}" alt="morning">
                                    </span>
                                    <div class="text-left">
                                       <p>{{ $value_week_session->week_session_name }}</p>
                                       <small>{{ $value_week_session->week_session_time }}</small>
                                    </div>
                                 </div>
                              </th>
                              <td>
                                 @if(!empty($value_week_session->getcount(1,$getrecord->id)))
                                 <span class="checked"><i class="fas fa-check"></i></span>
                                 @endif
                              </td>
                              <td>
                                 @if(!empty($value_week_session->getcount(2,$getrecord->id)))
                                 <span class="checked"><i class="fas fa-check"></i></span>
                                 @endif
                              </td>
                              <td>
                                 @if(!empty($value_week_session->getcount(3,$getrecord->id)))
                                 <span class="checked"><i class="fas fa-check"></i></span>
                                 @endif
                              </td>
                              <td>
                                 @if(!empty($value_week_session->getcount(4,$getrecord->id)))
                                 <span class="checked"><i class="fas fa-check"></i></span>
                                 @endif
                              </td>
                              <td>
                                 @if(!empty($value_week_session->getcount(5,$getrecord->id)))
                                 <span class="checked"><i class="fas fa-check"></i></span>
                                 @endif
                              </td>
                              <td>
                                 @if(!empty($value_week_session->getcount(6,$getrecord->id)))
                                 <span class="checked"><i class="fas fa-check"></i></span>
                                 @endif
                              </td>
                              <td>
                                 @if(!empty($value_week_session->getcount(7,$getrecord->id)))
                                 <span class="checked"><i class="fas fa-check"></i></span>
                                 @endif
                              </td>
                            
                           </tr>
                           @endforeach
                          
                         
                          
                        </tbody>
                     </table>
                  </div>
               </div>
            </section>
            <!-- end: availability -->
            <!-- start: rating -->
            <section id="rating" class="rating-sec wow fadeInUp">
               <div class="section-content">
                  <!-- section heading -->
                  <div class="section-heading">
                     <span class="iconic-image">
                     <img src="{{ url('assets/img/iconic-register.png') }}" alt="rating">
                     </span>
                     <h2 class="section-title">{{ __('find_tutor.Students_Feedback') }}</h2>
                  </div>
                  <!-- inner content -->
                  <div class="inner-content">
                     <div class="rating">
                        <span class="point">{!! $getrecord->averageRating() !!}</span>
                        <span class="stars">
                           {!! $getrecord->getHTMLRating() !!}
                        </span>
                     </div>
                     <div class="rating-bars">
                        <div class="single-rating-bar d-flex align-items-center mb-3">
                           <span class="star-label">5 {{ __('find_tutor.Stars') }}</span>
                           <div class="progress">
                              <div class="progress-bar" role="progressbar" style="width: {!! $getrecord->get_review_percentage(5) !!}%;" aria-valuenow="{!! $getrecord->get_review_percentage(5) !!}" aria-valuemin="0" aria-valuemax="100"></div>
                           </div>
                           <span class="star-count">({!! $getrecord->get_review_count(5) !!})</span>
                        </div>
                        <div class="single-rating-bar d-flex align-items-center mb-3">
                           <span class="star-label">4 {{ __('find_tutor.Stars') }}</span>
                           <div class="progress">
                              <div class="progress-bar" role="progressbar" style="width: {!! $getrecord->get_review_percentage(4) !!}%;" aria-valuenow="{!! $getrecord->get_review_percentage(4) !!}" aria-valuemin="0" aria-valuemax="100"></div>
                           </div>
                           <span class="star-count">({!! $getrecord->get_review_count(4) !!})</span>
                        </div>
                        <div class="single-rating-bar d-flex align-items-center mb-3">
                           <span class="star-label">3 {{ __('find_tutor.Stars') }}</span>
                           <div class="progress">
                              <div class="progress-bar" role="progressbar" style="width: {!! $getrecord->get_review_percentage(3) !!}%;" aria-valuenow="{!! $getrecord->get_review_percentage(3) !!}" aria-valuemin="0" aria-valuemax="100"></div>
                           </div>
                           <span class="star-count">({!! $getrecord->get_review_count(3) !!})</span>
                        </div>
                        <div class="single-rating-bar d-flex align-items-center mb-3">
                           <span class="star-label">2 {{ __('find_tutor.Stars') }}</span>
                           <div class="progress">
                              <div class="progress-bar" role="progressbar" style="width: {!! $getrecord->get_review_percentage(2) !!}%;" aria-valuenow="{!! $getrecord->get_review_percentage(2) !!}" aria-valuemin="0" aria-valuemax="100"></div>
                           </div>
                           <span class="star-count">({!! $getrecord->get_review_count(2) !!})</span>
                        </div>
                        <div class="single-rating-bar d-flex align-items-center mb-3">
                           <span class="star-label">1 {{ __('find_tutor.Stars') }}</span>
                           <div class="progress">
                              <div class="progress-bar" role="progressbar" style="width: {!! $getrecord->get_review_percentage(1) !!}%;" aria-valuenow="{!! $getrecord->get_review_percentage(1) !!}" aria-valuemin="0" aria-valuemax="100"></div>
                           </div>
                           <span class="star-count">({!! $getrecord->get_review_count(1) !!})</span>
                        </div>
                     </div>
                  </div>
               </div>
            </section>
            <!-- end: rating -->
            <!-- start: reviews -->
            <section id="reviews" class="reviews wow fadeInUp">
               <div class="section-content">
                  <!-- section heading -->
                  <div class="section-heading">
                     <span class="iconic-image">
                     <img src="{{ url('assets/img/iconic-review.png') }}" alt="review">
                     </span>
                     <h2 class="section-title">{{ __('find_tutor.Students_Reviews') }}</h2>
                  </div>
                  <!-- inner content -->
                  <div class="inner-content">

                     @forelse($getrecord->get_review as $review)
                     <div class="single-review">
                        <div class="student-img">
                           <img src="{!! $review->getuser->getImage() !!}" alt="student-review">
                        </div>
                        <div class="review-info">
                           <h4 class="student-name" style="text-transform: capitalize;">{!! $review->getuser->name !!} {!! $review->getuser->last_name !!}</h4>
                           <p class="review-text">
                              {!! $review->review !!}
                           </p>
                           <p class="review-meta">
                              <span class="review-date">
                                 {{ Carbon\Carbon::parse($review->created_at)->diffForHumans()}}
                              </span>
                           </p>
                        </div>
                     </div>
                     @empty
                     @endforelse
                  </div>
                  
               </div>
            </section>
            <!-- end: reviews -->
         </div>
      </div>
   </div>
</div>

@if(Auth::check())
<div class="modal fade" id="ContactMeModal" role="dialog">
<div class="modal-dialog modal-sm">
  <div class="modal-content">
    <div class="modal-header">
       <h4 style="font-size: 20px;" class="modal-title">Contact Me</h4>
       <button type="button" class="close" data-dismiss="modal">&times;</button>
    </div>
    <form action="{{ url('student/contact') }}" id="student_contact" method="post">
      
        <input type="hidden" value="{{ Auth::user()->token }}" name="token">
        <input type="hidden" value="{{ Auth::user()->id }}" name="sender_id">

        <input type="hidden" value="{{ Auth::user()->getImage() }}" name="profile_pic">
        <input type="hidden" value="{{ Auth::user()->getName() }}" name="name">


        <div class="modal-body ">
           <input type="hidden" value="{{ $getrecord->id }}" name="receiver_id">
           <label>Message</label>
           <textarea class="form-control clear-message" onkeyup="fnCheckForRestrictedWords(this.value)" rows="4" required name="message"></textarea>
           <div id="getRestrictedMessage" style="color: red;display: none;">Reminder: Never accept or ask for direct payments. Doing so may get your account restricted.</div>
        </div>
        <div class="modal-footer">
         	<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            <button type="submit" class="btn btn-danger" id="SendMessageButton">Submit</button>	
        </div>
	</form>
  </div>
</div>
</div>
@endif

<!-- end: main content -->
@endsection




@section('script')


<script type="text/javascript">
    function fnCheckForRestrictedWords(txtInput) {
        var restrictedWords = new Array(
         @foreach($getbockchat as $block)
         "{{ trim(strtolower($block->name)) }}",
         @endforeach
          "paypal","snapchat");  
        var error = 0;  
        for (var i = 0; i < restrictedWords.length; i++) {  
            var val = restrictedWords[i];  
            if ((txtInput.toLowerCase()).indexOf(val.toString()) > -1) {  
                error = error + 1;  
            }  
        }  

        if (error > 0) {  
            $('#getRestrictedMessage').show();
            $('#SendMessageButton').hide();
        }  
        else {  
            $('#getRestrictedMessage').hide();
            $('#SendMessageButton').show();
        }  
   }


$(document).ready(function(){

    $('#ContactMeModal').delegate('#student_contact','submit',function(e){
          e.preventDefault();

          $.ajax({
            url: app_base_url+"/api/app_student_contact",
            method: "POST",
            data:$(this).serialize(),
            "headers": {
                "Content-Type": "application/x-www-form-urlencoded"
            },
            dataType:"json",
             success:function(response){
                  if(response.status){
                        $('#ContactMeModal').modal('hide');
                        $('.clear-message').val('');
                        success_message('Message successfully sent.');
                  }
                  else {
                     error_message('Due to some error please try again.');
                  }

             },
           });
    });  

    // $('#login').submit(function(e){
    //     e.preventDefault();
    //     socket.emit('login', '{"engageID":"qwert", "pin":"1234"}');
    // });
    
    // $('#car_detail').submit(function(e){
    //     e.preventDefault();
    //     socket.emit('car_detail');
    // });
    
    // $('#register').submit(function(e){
    //     e.preventDefault();
    //     socket.emit('register', '{"firstname":"nilesh", "lastname":"patel", "email":"nilesh@gmail.com", "mobile":"8141918666", "password":"123456", "user_type":"driver",device_token":"1234", "auth_token":"1231312", "device_source":"ios", "create_date":"2017-03-08 10:12:23"}');
    // });
    
    // $('#getevent').submit(function(e){
    //     e.preventDefault();
    //     socket.emit('getevent', '{"engageID":"qwert", "userid":"1"}');
    // });
    
    // $('#addevent').submit(function(e){
    //     e.preventDefault();
    //     var uploader = new SocketIOFileUpload(socket);
    //     uploader.listenOnInput(document.getElementById("siofu_input"));
    //     socket.emit('addevent', '{"anouncement":"Add Announcement", "event_date" : "12/05/4221", "event_name" :"Test", "facebook" :"https://www.facebook.com/HREperformancewheels","is_public":"1","latitude":"0","location":"Afs","longitude":"0", "pdf":"378,377","video":"381,375","userid": "81"}');
    // });
    //questions = "[{\"question_type\":\"text\",\"question\":\"Rut\",\"answer_type\":\"Text\"},{\"question_type\":\"text\",\"question\":\"I\",\"answer_type\":\"Text\"}]";
    
    
});


</script>


<script type="text/javascript">

	$('.ContactMe').click(function(){
		$('#ContactMeModal').modal('show');
	});


   $('document').ready(function(){
   	$('.first-click-course1').click();
   });
   
   
   $('.class-course').click(function() {
   	var title = $(this).attr('data-title');
   	var url = $(this).attr('data-url');
      var type = $(this).attr('data-type');
   	$('#getCourseTitle').html(title);
   	
      if(type == 0)
      {
          $('#getVideoURL').html('<img src="'+url+'" style="width: 100%;max-height: 450px;border-radius: 6px;" />');          
      }
      else
      {
          $('#getVideoURL').html('<video controls="" width="100%" height="375"><source  src="'+url+'" type="video/mp4"></video>');
      }
      
   	$('.class-course').removeClass('now-playing');
   	$(this).addClass('now-playing');
   	
   });
</script>
@endsection
