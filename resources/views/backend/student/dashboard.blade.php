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
    <div class="dashboard-contents main-content">
      <div class="container">
        <div class="row">
          <!-- start: user profile summery -->
          <div class="col-12 col-lg-4 col-xl-3 profile">
            <div class="profile-summary">
              <div class="user-profile text-center text-capitalize">
                <div class="profile-image">
                    <img src="{!! $getrecord->getImage() !!}" alt="profile-picture">
                </div>

                <div class="profile-edit-btn-cont text-right mb-1">
                  <a href="{{ url('student/profile') }}" class="profile-edit-btn text-capitalize">{{ __('student.Edit_Profile') }}</a>
                </div>

                <h3 class="profile-name">
                  {{ ucfirst(!empty($getrecord->name)?$getrecord->name: '') }}
                  {{ ucfirst(!empty($getrecord->last_name)?$getrecord->last_name: '') }}
                </h3>
                <p class="local-time thin-colored-text">
                  <span class="flag"><img style="height: 15px;" src="{!! $getrecord->getcountry->getImage() !!}" ></span>
                  <span class="time">{{ $getrecord->gettimezonedate() }}</span>
                </p>

                <div class="rating">
                  <span class="stars">
                    {!! $getrecord->getHTMLRating() !!}
                  </span>
                  <span class="point">{!! $getrecord->averageRating() !!}</span>
                  <span class="text">{{ __('student.Rating') }}</span>
                </div>

                <div class="lesson-history">
             
                  <p class="lesson-history-item">
                    <span class="history-label text-capitalize d-flex align-items-center">
                      <i class="fas fa-signal"></i>{{ __('student.Level_of_Student') }}
                    </span>
                    <span class="history-info">
                      {{ !empty($getrecord->getlevelofstudent->getlevelofstudentname())?$getrecord->getlevelofstudent->getlevelofstudentname(): '' }}
                    </span>
                  </p>
                  <p class="lesson-history-item">
                    <span class="history-label text-capitalize d-flex align-items-center">
                      <i class="fas fa-list"></i>{{ __('student.Category') }}
                    </span>
                    <span class="history-info">
                      {{ !empty($getrecord->getcategory->getcategoryname())?$getrecord->getcategory->getcategoryname(): '' }}
                    </span>
                  </p>
                  <p class="lesson-history-item">
                    <span class="history-label text-capitalize d-flex align-items-center">
                      <i class="fas fa-calendar-alt"></i>{{ __('student.Published_Date') }}
                    </span>
                    <span class="history-info">
                      {{ date('d-m-Y h:i A', strtotime($getrecord->created_at)) }}
                    </span>
                  </p>
                </div>

              </div>
            </div>
            <div class="bio wow fadeInUp">
              <div class="user-bio-content">
                <h2 class="bio-section-title">{{ __('student.Bio') }}</h2>
                <p class="user-bio-text">
                    {{ $getrecord->about_us }}
                </p>
                <div class="edit-bio-btn-cont text-right mt-3">
                  <a href="{{ url('student/profile') }}" class="edit-bio-btn text-capitalize">{{ __('student.Edit_Bio') }}</a>
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
                  <h3 class="section-title">{{ __('student.Dashboard') }}</h3>
                </div>
                <div class="section-content dash-sum-items">
                  <div class="row">
                    <div class="col-12 col-sm-6 col-md-4 col-lg-4 col-xl-2dot4 col-xxl-2dot4">
                      <a href="{{ url('student/request-page') }}" class="single-dash-sum-item text-center d-flex flex-column justify-content-center">
                        <div class="dash-sum-image">
                          <img src="{{ url('assets/img/iconic-envelope-request.png') }}" alt="dashboard-icon">
                        </div>
                        <h3 class="dash-sum-number">{{ $countRequestTotal }}</h3>
                        <p class="dash-sum-name text-capitalize">{{ __('student.Total_request') }}</p>
                      </a>
                    </div>
                    <div class="col-12 col-sm-6 col-md-4 col-lg-4 col-xl-2dot4 col-xxl-2dot4 mt-4 mt-sm-0">
                      <a href="{{ url('student/course') }}" class="single-dash-sum-item text-center d-flex flex-column justify-content-center">
                        <div class="dash-sum-image">
                          <img src="{{ url('assets/img/iconic-course-book-open.png') }}" alt="dashboard-icon">
                        </div>
                        <h3 class="dash-sum-number">{{ $countCourseTotal }}</h3>
                        <p class="dash-sum-name text-capitalize">{{ __('student.Total_Course') }}</p>
                      </a>
                    </div>
                    <div class="col-12 col-sm-6 col-md-4 col-lg-4 col-xl-2dot4 col-xxl-2dot4 mt-4 mt-md-0">
                      <a href="{{ url('student/offer-page') }}" class="single-dash-sum-item text-center d-flex flex-column justify-content-center">
                        <div class="dash-sum-image">
                          <img src="{{ url('assets/img/iconic-offer-card.png') }}" alt="dashboard-icon">
                        </div>
                        <h3 class="dash-sum-number">{{ $Newoffer }}</h3>
                        <p class="dash-sum-name text-capitalize">{{ __('student.New_offer') }}</p>
                      </a>
                    </div>
                    <div class="col-12 col-sm-6 col-md-4 col-lg-4 col-xl-2dot4 col-xxl-2dot4 mt-4 mt-xl-0">
                      <a href="{{ url('student/request-page') }}" class="single-dash-sum-item text-center d-flex flex-column justify-content-center">
                        <div class="dash-sum-image">
                          <img src="{{ url('assets/img/iconic-user-request.png') }}" alt="dashboard-icon">
                        </div>
                        <h3 class="dash-sum-number">{{ $RequestCount }}</h3>
                        <p class="dash-sum-name text-capitalize">{{ __('student.Create_New_Request') }}</p>
                      </a>
                    </div>
                    <div class="col-12 col-sm-6 col-md-4 col-lg-4 col-xl-2dot4 col-xxl-2dot4 mt-4 mt-xl-0">
                      <a href="{{ url('student/chat') }}" class="single-dash-sum-item text-center d-flex flex-column justify-content-center">
                        <div class="dash-sum-image">
                          <img src="{{ url('assets/img/iconic-envelope-message.png') }}" alt="dashboard-icon">
                        </div>
                        <h3 class="dash-sum-number">{{ $chatcount }}</h3>
                        <p class="dash-sum-name text-capitalize">{{ __('student.New_Messages_Received') }}</p>
                      </a>
                    </div>
                  </div>
                </div>
              </section>
              <!-- end: dashboard summary -->



              <!-- start: active lessons -->
              <section class="active-lessons-section wow fadeInUp">
                <div class="section-heading d-flex justify-content-between">
                  <h3 class="section-title">Active lessons</h3>
                  <a href="{{ url('student/course') }}" class="view-all-btn">View all</a>
                </div>
                <div class="section-content active-lessons">
                  <div class="row">

                    @foreach($getLesson as $value)

                    <div class="col-12 col-sm-6 col-lg-6 col-xl-3">
                      <div class="single-lesson lesson-1 online">
                        <div class="single-lesson-status d-flex justify-content-between">
                          <div class="lesson-badge-cont">
                            <div class="lesson-lang-badge">
                              <img style="border-radius: 50%;" src="{!! $value->getusers->getImage() !!}" alt="tutor-image">
                            </div>                            
                          </div>
                          <div class="online-status-cont text-right">
                            <a href="{!! $value->getusers->getProfileTutorLink() !!}">{{ $value->getusers->name }} {{ $value->getusers->last_name }}</a>
                             @if($value->getusers->OnlineUser())
                              <span class="online-status d-inline-flex align-items-center justify-content-center text-center">
                                <span><i class="fas fa-circle"></i></span>
                                Online
                              </span>
                             @endif
                          </div>                        
                          
                        </div>


                 

                        <div class="lesson-heading d-flex justify-content-between align-items-center">
                          <h6 class="lesson-name">{{ !empty($value->getcourse->getcategory->getcategoryname()) ? $value->getcourse->getcategory->getcategoryname(): '' }}</h6>
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
                          <a href="{{ url('student/course/view/'.$value->id) }}" class="button view-btn">View</a>
                          <a href="{{ url('admin/send_mssage/'.$value->user_id) }}" class="button message-btn">Send Mesage</a>
                        </div>
                      </div>
                    </div>

                    @endforeach


                  </div>
                </div>
              </section>
              <!-- end: active lessons -->



              <!-- start: homework section -->
              <section class="homework-section wow fadeInUp">
                <div class="row">
                  <div class="col-12 col-xl-7">
                    <div class="list-view-box todo-content h-100">
                      <div class="section-heading d-flex justify-content-between">
                        <h3 class="section-title text-capitalize">Homework To Do</h3>
                      </div>

                      <div class="list-view-content">

                       @foreach($getHomework as $homework)

                        <div class="single-item d-flex align-items-center justify-content-between">
                          <div class="item-col-1 d-flex align-items-center">
                            <div class="item-img">
                              <img src="{!! $homework->getusers->getImage() !!}" alt="item-image">
                            </div>
                            <div class="item-intro">
                              <h5 class="item-title text-capitalize">
        {{ $homework->getusers->name }} {{ $homework->getusers->last_name }}</h5>
                              <p class="item-desc">{{ $homework->title }}</p>
                            </div>
                          </div>
                          <div class="item-col-2 d-flex flex-column text-center">
                            <p class="time d-inline-block">{{ date('Y-m-d h:i A',$homework->lesson_time) }}</p>
                          </div>
                          <div class="item-col-last d-flex flex-column text-center">
                            <div class="price">
                              <span class="amount">&#36;15</span>
                              <span class="unit text-capitalize">Lesson</span>
                            </div>
                            <div class="item-action-buttons">
                                <a href="{{ url('admin/send_mssage/'.$homework->user_id) }}" class="button message-btn"><i class="far fa-envelope"></i></a>
                                <a href="{{ url('student/course/view/'.$homework->id) }}" class="button view-btn">
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
                    <div class="course-calendar-box h-100">
                      <h6 class="calendar-title text-capitalize">Add My Note </h6>
                      <div class="calendar-main">
                        <div id="course-calendar"></div>
                      </div>
                    
                    </div>
                  </div>


                </div>
              </section>
              <!-- end: homework section -->



              <!-- start: our teachers section -->
              <section class="our-teachers-section wow fadeInUp">
                <div class="row">
                  <div class="col-12 col-xl-7">
                    <div class="list-view-box our-teachers-content h-100">
                      <div class="section-heading d-flex justify-content-between">
                        <h3 class="section-title text-capitalize">Our teachers</h3>
                        {{-- <a href="#" class="view-all-btn">View all</a> --}}
                      </div>

                      <div class="list-view-content">
                       
                        @forelse ($getTeacher as $value_teacher)
                        
                        <div class="single-item d-flex align-items-center justify-content-between">
                          <div class="item-col-1 d-flex align-items-center">
                            <div class="item-img">
                              <img src="{!! $value_teacher->getImage() !!}" alt="item-image">
                            </div>
                            <div class="item-intro">
                              <h5 class="item-title text-capitalize">
                                {{ ucfirst(!empty($value_teacher->name)?$value_teacher->name: '') }} {{ ucfirst(!empty($value_teacher->last_name)?$value_teacher->last_name: '') }}
                              </h5>
                              <p class="item-desc text-capitalize">
                                {{ !empty($value_teacher->getcategory->category_name)? $value_teacher->getcategory->category_name : '' }}
                              </p>
                              <p class="rating">
                                <span class="stars">
                                   {!! $value_teacher->getHTMLRating() !!}
                                </span>
                                
                              </p>
                            </div>
                          </div>
                             @if(!empty($value_teacher->hour_per_rate))
                          <div class="item-col-2 ml-sm-auto">
                            <div class="price d-flex flex-column align-items-center">
                              <span class="amount">${{ $value_teacher->hour_per_rate }}</span>
                              <span class="unit text-capitalize">Lesson</span>
                            </div>
                          </div>
                          @endif
                          <div class="item-col-last">
                            <div class="item-action-buttons">
                              <a href="{{ url('tutor-profile/'.$value_teacher->id) }}" class="button view-btn">
                                <img src="{{ url('assets/img/iconic-view-eye.png') }}" alt="view-icon">
                              </a>
                            </div>
                          </div>
                        </div>
                        @empty
                         <div class="single-item d-flex align-items-center justify-content-between">
                           <div colspan="100%"></div>
                         </div>
                        @endforelse

                       
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
                        <a href="{{ url('student/notes') }}" class="all-notes-btn view-all-btn">View all</a>
                      </div>
                    </div>
                  </div>
                </div>
              </section>
              <!-- end: our teachers section -->
            </div>
          </div>
          <!-- end: dashboard main content -->
        </div>
      </div>
    </div>
    <!-- end: main content -->




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
