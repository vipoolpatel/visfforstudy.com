@extends('backend.layouts.app')
@section('style')
<style type="text/css">
      .modal-sm {
        max-width: 600px !important;
     }
</style>
@endsection 
@section('content')




    <!-- start: main content -->
    <div class="dashboard-contents teacher-dashboard-contents main-content">
      <div class="container">
        <div class="row">
          <!-- start: user profile summery -->
          <div class="col-12 col-lg-4 col-xl-3 profile">
            <div class="profile-summary">
              <div class="user-profile text-center text-capitalize">
                <div class="profile-image">
                  <img src="{!! $getrecord->getImage() !!}" alt="profile-picture">
                </div>

                <p class="profile-designation">{{ ucfirst(!empty($getrecord->getcategory->category_name)?$getrecord->getcategory->category_name: '') }}</p>
                <h3 class="profile-name">
                  {{ ucfirst(!empty($getrecord->name)?$getrecord->name: '') }}
                  {{ ucfirst(!empty($getrecord->last_name)?$getrecord->last_name: '') }}
                </h3>
                <div class="rating">
                  <span class="stars">
                   {!! $getrecord->getHTMLRating() !!}
                  </span>
                  <span class="point">{!! $getrecord->averageRating() !!}</span>
                  <span class="text">{!! $getrecord->totalRating() !!} {{ __('tutor.Reviews') }}</span>
                </div>

                <div class="lesson-history">
                  <p class="lesson-history-item">
                    <span class="history-label text-capitalize d-flex align-items-center">
                      <i class="fas fa-user"></i>{{ __('tutor.Repeat_Student') }}
                    </span>
                    <span class="history-info">15</span>
                  </p>
                  <p class="lesson-history-item">
                    <span class="history-label text-capitalize d-flex align-items-center">
                      <i class="fas fa-sync-alt"></i>{{ __('tutor.Average_reply_time') }}
                    </span>
                    <span class="history-info">1 {{ __('tutor.Hour') }}</span>
                  </p>
                  <p class="lesson-history-item">
                    <span class="history-label text-capitalize d-flex align-items-center">
                      <i class="fas fa-list"></i>{{ __('tutor.Local_time') }}
                    </span>
                    <span class="history-info">{{ $getrecord->gettimezonedate() }}</span>
                  </p>
                  <p class="lesson-history-item">
                    <span class="history-label text-capitalize d-flex align-items-center">
                      <i class="fas fa-calendar-alt"></i>{{ __('tutor.Member_since') }}
                    </span>
                    <span class="history-info">{{ date('d-m-Y h:i A', strtotime($getrecord->created_at)) }}</span>
                  </p>
                </div>
              </div>
            </div>
            <div class="bio wow fadeInUp">
              <div class="user-bio-content">
                <h2 class="bio-section-title">{{ __('tutor.Bio') }}</h2>
                <p class="user-bio-text">
                  {{ $getrecord->about_us }}
                </p>
                <div class="edit-bio-btn-cont text-right mt-3">
                  <a href="{{ url('tutor/profile') }}" class="edit-bio-btn text-capitalize">{{ __('tutor.Edit_Bio') }}</a>
                </div>
              </div>
         
            </div>
          </div>
          <!-- end: user profile summery -->

          <!-- start: dashboard main content -->
          <div class="col-12 col-lg-8 col-xl-9">
            <div class="dashboard-main-content">
              <!-- start: dashboard summary -->
              <section class="dashboard-summary-section">
                <div class="section-heading">
                  <h3 class="section-title">Dashboard</h3>
                </div>
                <div class="section-content dash-sum-items">
                  <div class="row">
                    <div class="col-12 col-sm-6 col-md-4 col-lg-4 col-xl-2dot4 col-xxl-2dot4">
                      <a href="{{ url('tutor/earning') }}" class="single-dash-sum-item text-center d-flex flex-column justify-content-center">
                        <div class="dash-sum-image">
                          <img src="{{ url('assets/img/iconic-dash-dollar.png') }}" alt="dashboard-icon">
                        </div>
                        <h3 class="dash-sum-number">{{ number_format($getrecord->net_income,2) }}</h3>
                        <p class="dash-sum-name text-capitalize">Earning</p>
                      </a>
                    </div>
                    <div class="col-12 col-sm-6 col-md-4 col-lg-4 col-xl-2dot4 col-xxl-2dot4 mt-4 mt-sm-0">
                      <a href="{{ url('tutor/lesson') }}" class="single-dash-sum-item text-center d-flex flex-column justify-content-center">
                        <div class="dash-sum-image">
                          <img src="{{ url('assets/img/iconic-clipboard.png') }}" alt="dashboard-icon">
                        </div>
                        <h3 class="dash-sum-number">{{ $countLessonsTotal }}</h3>
                        <p class="dash-sum-name text-capitalize">Lessons</p>
                      </a>
                    </div>
                    <div class="col-12 col-sm-6 col-md-4 col-lg-4 col-xl-2dot4 col-xxl-2dot4 mt-4 mt-md-0">
                      <a href="{{ url('tutor/offer') }}" class="single-dash-sum-item text-center d-flex flex-column justify-content-center">
                        <div class="dash-sum-image">
                          <img src="{{ url('assets/img/iconic-file-books.png') }}" alt="dashboard-icon">
                        </div>
                        <h3 class="dash-sum-number">{{ $countOfferTotal }}</h3>
                        <p class="dash-sum-name text-capitalize">Total Offers</p>
                      </a>
                    </div>
                    <div class="col-12 col-sm-6 col-md-4 col-lg-4 col-xl-2dot4 col-xxl-2dot4 mt-4 mt-xl-0">
                      <a href="{{ url('tutor/student-request') }}" class="single-dash-sum-item text-center d-flex flex-column justify-content-center">
                        <div class="dash-sum-image">
                          <img src="{{ url('assets/img/iconic-user-request.png') }}" alt="dashboard-icon">
                        </div>
                        <h3 class="dash-sum-number">{{ $countRequestTotal }}</h3>
                        <p class="dash-sum-name text-capitalize">Student Request</p>
                      </a>
                    </div>
                    <div class="col-12 col-sm-6 col-md-4 col-lg-4 col-xl-2dot4 col-xxl-2dot4 mt-4 mt-xl-0">
                      <a href="{{ url('tutor/chat') }}" class="single-dash-sum-item text-center d-flex flex-column justify-content-center">
                        <div class="dash-sum-image">
                          <img src="{{ url('assets/img/iconic-envelope-message.png') }}" alt="dashboard-icon">
                        </div>
                        <h3 class="dash-sum-number">{{ $chatcount }}</h3>
                        <p class="dash-sum-name text-capitalize">New Messages Received</p>
                      </a>
                    </div>
                  </div>
                </div>
                
              </section>

  <section class="dashboard-summary-section">
               <div class="section-content dash-sum-items">
                  <div class="row">

                    <div class="col-12 col-sm-6 col-md-4 col-lg-4 col-xl-2dot4 col-xxl-2dot4 mt-4 mt-xl-0">
                      <a href="{{ url('tutor/my-availability') }}" class="single-dash-sum-item text-center d-flex flex-column justify-content-center">
                        <div class="dash-sum-image">
                          <img src="{{ url('assets/img/iconic-clipboard.png') }}" alt="dashboard-icon">
                        </div>
                        <p  style="margin-top: 40px;" class="dash-sum-name text-capitalize">My Availability</p>
                      </a>
                    </div>

                     <div class="col-12 col-sm-6 col-md-4 col-lg-4 col-xl-2dot4 col-xxl-2dot4 mt-4 mt-xl-0">
                      <div style="margin-top: 0px;" class="publish-course-link-cont text-left">
                        <a href="{{ url('tutor/new-course') }}" class="publish-course-link text-center d-inline-flex flex-column justify-content-center align-items-center text-center">
                          <div class="icon">
                            <img src="{{ url('assets/img/iconic-course-publish.png') }}" alt="dashboard-icon">
                          </div>
                          <p class="text text-capitalize">Publish new course</p>
                        </a>
                      </div>
                    </div>

                    </div>
                  </div>
                </section>
              <!-- end: dashboard summary -->


           @if(!empty(count($getrecord->get_course)))
              <!-- start: lecture video section -->
              <section class="lectures dashboard-lecture">
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

            @endif
              <!-- end: lecture video section -->



              <!-- start: active lessons -->
              <section class="active-lessons-section wow fadeInUp">
                <div class="section-heading d-flex justify-content-between">
                  <h3 class="section-title">Active lessons</h3>
                  <a href="{{ url('tutor/lesson') }}" class="view-all-btn">View all</a>
                </div>

                <div class="section-content active-lessons">
                  <div class="row">


                    @foreach($getLesson as $value)

                    <div class="col-12 col-sm-6 col-lg-6 col-xl-3">
                      <div class="single-lesson lesson-1 online">
                        <div class="single-lesson-status d-flex justify-content-between">
                          <div class="lesson-badge-cont">
                            <div class="lesson-lang-badge">
                              <img style="border-radius: 50%;" src="{!! $value->getstudent->getImage() !!}" alt="tutor-image">
                            </div>                            
                          </div>
                          <div class="online-status-cont text-right">
                            <a  style="text-transform: capitalize;">{{ $value->getstudent->name }} {{ $value->getstudent->last_name }}</a>
                             @if($value->getstudent->OnlineUser())
                              <span class="online-status d-inline-flex align-items-center justify-content-center text-center">
                                <span><i class="fas fa-circle"></i></span>
                                Online
                              </span>
                             @endif
                          </div>                        
                          
                        </div>


                 

                        <div class="lesson-heading d-flex justify-content-between align-items-center">
                          <h6 class="lesson-name">{{ !empty($value->getcourse->getcategory->category_name) ? $value->getcourse->getcategory->category_name : '' }}</h6>
                          <a href="#" class="join-class-btn">Join Class room</a>
                        </div>
                        <p class="lesson-desc">{{ $value->getcourse->course_title }}</p>
                        <div class="period-price d-flex justify-content-between align-items-center">
                          <span class="remaining-time">
                            <span class="icon mr-1">
                              <img src="{{ url('assets/img/iconic-alarm-clock.png') }}" alt="clock-icon">
                            </span>
                            <span class="text">{{ date('Y-m-d h:i A',$value->getlesson->lesson_date) }}</span>
                          </span>
                          <span class="price">${{ $value->lesson_per_rate }}</span>
                        </div>
                        <div class="lesson-action-buttons d-flex justify-content-between">
                          <a href="{{ url('tutor/lesson/view/'.$value->id) }}" class="button view-btn">View</a>
                          <a href="{{ url('admin/send_mssage/'.$value->student_id) }}" class="button message-btn">Send Mesage</a>
                        </div>
                      </div>
                    </div>

                    @endforeach



                  </div>
                </div>
              </section>
              <!-- end: active lessons -->



              <!-- start: homework section -->
              <section class="submited-homework-section homework-section wow fadeInUp">
                <div class="row">
                  <div class="col-12 col-xl-7">
                    <div class="list-view-box todo-content h-100">
                      <div class="section-heading d-flex justify-content-between">
                        <h3 class="section-title text-capitalize">Submited homework</h3>
                      </div>

                      <div class="list-view-content">
                      @foreach($getHomework as $homework)

                        <div class="single-item d-flex align-items-center justify-content-between">
                          <div class="item-col-1 d-flex align-items-center">
                            <div class="item-img">
                              <img src="{!! $homework->getstudent->getImage() !!}" alt="item-image">
                            </div>
                            <div class="item-intro">
                              <h5 class="item-title text-capitalize">{{ $homework->getstudent->name }} {{ $homework->getstudent->last_name }}</h5>
                              <p class="item-desc">{{ $homework->title }}</p>
                            </div>
                          </div>
                          <div class="item-col-2 d-flex flex-column text-center">
                            <p class="time d-inline-block">{{ date('Y-m-d h:i A',$homework->complete_date) }}</p>
                          </div>
                          <div class="item-col-last d-flex flex-column text-center">
                            <div class="price">
                              <span class="amount">${{ $homework->lesson_per_rate }}</span>
                              <span class="unit text-capitalize">Lesson</span>
                            </div>
                            <div class="item-action-buttons">
                              <a href="{{ url('admin/send_mssage/'.$homework->student_id) }}" class="button message-btn"><i class="far fa-envelope"></i></a>
                              <a href="{{ url('tutor/lesson/view/'.$homework->id) }}" class="button view-btn">
                                <img src="{{ url('assets/img/iconic-view-eye.png') }}" alt="view-icon">
                              </a>
                            </div>
                          </div>
                        </div>

                      @endforeach

                    
                      </div>
                    </div>
                  </div>
                  <div class=" col-12 col-xl-5">
                    <div class="task-calendar course-calendar-box h-100">
                      <h6 class="calendar-title text-capitalize">Add My Note</h6>
                      <div class="calendar-main">
                        <div id="course-calendar"></div>
                      </div>
                  
                    </div>
                  </div>
                </div>
              </section>
              <!-- end: homework section -->



              <!-- start: new request section -->

              <section class="new-request-section our-teachers-section wow fadeInUp">
                <div class="row">
                  <div class="col-12 col-xl-7">
                    <div class="list-view-box our-teachers-content h-100">
                      <div class="section-heading d-flex justify-content-between">
                        <h3 class="section-title text-capitalize">New request</h3>
                        <a href="{{ url('tutor/student-request') }}" class="view-all-btn">View all</a>
                      </div>

                      <div class="list-view-content">

                        @foreach($getrequest as $value)

                        <div class="single-item d-flex align-items-center justify-content-between">
                          <div class="item-col-1 d-flex align-items-center">
                            <div class="item-img">
                              <img src="{!! $value->getusers->getImage() !!}" alt="item-image">
                            </div>
                            <div class="item-intro">
                              <h5 class="item-title text-capitalize" style="text-transform: capitalize;">{{ $value->getusers->name }} {{ $value->getusers->last_name }}</h5>
                              <p class="item-desc text-capitalize">{{ $value->request_title }}</p>
                            </div>
                          </div>
                          <div class="item-col-2 ml-sm-auto">
                            <div class="price d-flex flex-column align-items-center">
                              <span class="amount">${{ $value->rate_per_hour }}</span>
                              <span class="unit text-capitalize">Per lesson</span>
                            </div>
                          </div>
                          <div class="item-col-last">
                            <div class="item-action-buttons">
                              <a href="{{ $value->getProfileRequestLink() }}" class="button view-btn">
                                <img src="{{ url('assets/img/iconic-view-eye.png') }}" alt="view-icon">
                              </a>
                            </div>
                          </div>
                        </div>

                        @endforeach


                     

                      </div>
                    </div>
                  </div>
                  <div class="col-12 col-xl-5">
                    <div class="notes-box h-100 d-flex flex-column">
                      <div class="section-heading d-flex flex-wrap flex-sm-nowrap justify-content-between">
                        <span class="notes-head d-flex align-items-center">
                          <h3 class="section-title text-capitalize">My Notes</h3>
                          <span class="notes-count ml-2">{{ $getrecord->get_note->count() }}</span>
                        </span>
                      
                      </div>

                      <div class="notes-list">
                    

                        @foreach($getrecord->get_note as $value_note)
                          <div class="single-note d-flex align-items-start">
                            <span class="icon">
                              <img src="{{ url('assets/img/iconic-file-text.png') }}" alt="note-icon">
                            </span>
                            <div class="content">
                              <a href="#" class="note-title">
                                {!! $value_note->title !!}
                              </a>
                              <p class="desc">
                                {!! $value_note->message !!}
                              </p>
                              <p class="date">{{ $value_note->note_date }}</p>
                            </div>
                          </div>
                        @endforeach
                       
                      </div>

                      <div class="all-notes-btn-cont text-right mt-auto">
                        <a href="{{ url('tutor/notes') }}" class="all-notes-btn view-all-btn">View all</a>
                      </div>
                    </div>
                  </div>
                </div>
              </section>
              <!-- end: new request section -->
            </div>
          </div>
          <!-- end: dashboard main content -->
        </div>
      </div>
    </div>
    <!-- end: main content -->



  	<!-- start: chat popup -->
  	<div id="chatPopup" class="chat-pop-box">
  		<div class="chat-pop-close-cont">
  			<button class="chat-pop-close">X</button>
  		</div>
  		<div class="chat-pop-inner">
  			<div class="heading text-center">
  				<p class="title notification">Notification</p>
  				<a href="{{ url('chat-page') }}" class="title inbox">Inbox</a>
  			</div>
  			<div class="all-conversation-list">
  				<div class="single-chat d-flex">
  					<a href="#" class="user-img">
  						<img src="{{ url('assets/img/student-profile/student-profile-3.jpg') }}" alt="user-image">
  					</a>
  					<a href="#" class="user-chat-info">
  						<h6 class="user-name">Sahed Rumi</h6>
  						<p class="message">
  							Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do ….
  						</p>
  						<p class="last-seen">2 h ago.</p>
  					</a>
  				</div>
  				<div class="single-chat d-flex">
  					<a href="#" class="user-img">
  						<img src="{{ url('assets/img/student-profile/student-profile-3.jpg') }}" alt="user-image">
  					</a>
  					<a href="#" class="user-chat-info">
  						<h6 class="user-name">Sahed Rumi</h6>
  						<p class="message">
  							Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do ….
  						</p>
  						<p class="last-seen">2 h ago.</p>
  					</a>
  				</div>
  				<div class="single-chat d-flex">
  					<a href="#" class="user-img">
  						<img src="{{ url('assets/img/student-profile/student-profile-3.jpg') }}" alt="user-image">
  					</a>
  					<a href="#" class="user-chat-info">
  						<h6 class="user-name">Sahed Rumi</h6>
  						<p class="message">
  							Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do ….
  						</p>
  						<p class="last-seen">2 h ago.</p>
  					</a>
  				</div>
  				<div class="single-chat d-flex">
  					<a href="#" class="user-img">
  						<img src="{{ url('assets/img/student-profile/student-profile-3.jpg') }}" alt="user-image">
  					</a>
  					<a href="#" class="user-chat-info">
  						<h6 class="user-name">Sahed Rumi</h6>
  						<p class="message">
  							Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do ….
  						</p>
  						<p class="last-seen">2 h ago.</p>
  					</a>
  				</div>
  			</div>
  		</div>
  	</div>
  	<!-- start: chat popup -->



<div class="modal fade" id="HomeWorkModal" role="dialog">
   <div class="modal-dialog modal-sm">
      <div class="modal-content">
         <div class="modal-header">
            <h4 style="font-size: 20px;" class="modal-title">Notes</h4>
            <button type="button" class="close" data-dismiss="modal">&times;</button>
         </div>
         <form action="{{ url('user/note/add') }}" method="post">
            {{ csrf_field() }}
            <div class="modal-body ">
                <input type="hidden" id="altField" name="note_date" value="">

                <div class="form-group" style="margin-bottom: 8px;">
                  <label>Note Date: <span id="getLessonDate"></span></label>
               </div>

               <div class="form-group" style="margin-bottom: 8px;">
                  <label>Title</label>
                  <input type="text" class="form-control" placeholder="Title" required name="title">
               </div>
               <div class="form-group" style="margin-bottom: 8px;">
                  <label>Note</label>
                  <textarea class="form-control" rows="4" placeholder="Note" required name="message"></textarea>
               </div>
            </div>
            <div class="modal-footer">
               <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
               <button type="submit" class="btn btn-danger">Submit</button>   
            </div>
         </form>
      </div>
   </div>
</div>



@endsection
@section('script')
<script type="text/javascript">
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