@extends('backend.layouts.app')
@section('style')
<style type="text/css">
      .content-table tr > th {
            text-align: left;
      }
      .content-table tr > td {
            text-align: left;
      }
      .modal-sm {
        max-width: 600px !important;
     }
</style>
@endsection 
@section('content')



    <!-- start: main content -->
    <div class="dashboard-contents admin-dashboard-content main-content">
      <div class="container">
        <div class="row">
          <div class="col-12">
            <!-- start: dashboard main content -->
            <div class="dashboard-main-content">
              <!-- start: dashboard summary -->
              <section class="dashboard-summary-section">
                <div class="section-heading">
                  <h3 class="section-title">{{ __('admin.Dashboard') }}</h3>
                </div>
                <div class="section-content dash-sum-items">
                  <div class="row">
                    @if(!empty($p_total_earing))
                    <div class="col-6 col-md-3 col-lg-2dot4 col-xl-1dot7">
                      <a href="{{ url('admin/withdraw-request') }}" class="single-dash-sum-item text-center d-flex flex-column justify-content-center">
                        <div class="dash-sum-image">
                          <img src="{{ url('assets/img/iconic-dash-dollar.png') }}" alt="dashboard-icon">
                        </div>
                        <h3 class="dash-sum-number">{{ number_format($TotalEaring,2) }}</h3>
                        <p class="dash-sum-name text-capitalize">Total earing</p>
                      </a>
                    </div>
                    @endif

                    @if(!empty($p_net_profit))
                    <div class="col-6 col-md-3 col-lg-2dot4 col-xl-1dot7">
                      <a href="{{ url('admin/withdraw-request') }}" class="single-dash-sum-item text-center d-flex flex-column justify-content-center">
                        <div class="dash-sum-image">
                          <img src="{{ url('assets/img/iconic-dash-chart.png') }}" alt="dashboard-icon">
                        </div>
                        <h3 class="dash-sum-number">{{ number_format($TotalNetProfit,2) }}</h3>
                        <p class="dash-sum-name text-capitalize">Net profit</p>
                      </a>
                    </div>
                    @endif

                    @if(!empty($p_withdraw_request))
                    <div class="col-6 col-md-3 col-lg-2dot4 col-xl-1dot7 mt-4 mt-md-0">
                      <a href="{{ url('admin/withdraw-request') }}" class="single-dash-sum-item text-center d-flex flex-column justify-content-center">
                        <div class="dash-sum-image">
                          <img src="{{ url('assets/img/iconic-dash-savings.png') }}" alt="dashboard-icon">
                        </div>
                        <h3 class="dash-sum-number">{{ $withdraw_request }}</h3>
                        <p class="dash-sum-name text-capitalize">Withdraw request</p>
                      </a>
                    </div>
                    @endif


                  @if(!empty($p_email_marketing))
                    <div class="col-6 col-md-3 col-lg-2dot4 col-xl-1dot7 mt-4 mt-md-0">
                      <a href="{{ url('admin/email-marketing') }}" class="single-dash-sum-item text-center d-flex flex-column justify-content-center">
                        <div class="dash-sum-image">
                          <img src="{{ url('assets/img/iconic-dash-mail.png') }}" alt="dashboard-icon">
                        </div>
                        <h3 class="dash-sum-number">{{ $countEmailTotal }}</h3>
                        <p class="dash-sum-name text-capitalize">{{ __('admin.Email_marketing') }}</p>
                      </a>
                    </div>
                    @endif


                     @if(!empty($p_pending_offers))
                    <div class="col-6 col-md-3 col-lg-2dot4 col-xl-1dot7 mt-4 mt-lg-0">
                      <a href="{{ url('admin/offer') }}" class="single-dash-sum-item text-center d-flex flex-column justify-content-center">
                        <div class="dash-sum-image">
                          <img src="{{ url('assets/img/iconic-dash-pending-offer.png') }}" alt="dashboard-icon">
                        </div>
                        <h3 class="dash-sum-number">{{ $countOfferPending }}</h3>
                        <p class="dash-sum-name text-capitalize">{{ __('admin.Pending_offers') }}</p>
                      </a>
                    </div>
                      @endif

                     @if(!empty($p_pending_courses))
                    <div class="col-6 col-md-3 col-lg-2dot4 col-xl-1dot7 mt-4 mt-xl-0">
                      <a href="{{ url('admin/course') }}" class="single-dash-sum-item text-center d-flex flex-column justify-content-center">
                        <div class="dash-sum-image">
                          <img src="{{ url('assets/img/iconic-dash-pending-course.png') }}" alt="dashboard-icon">
                        </div>
                        <h3 class="dash-sum-number">{{ $countCoursePending }}</h3>
                        <p class="dash-sum-name text-capitalize">{{ __('admin.Pending_courses') }}</p>
                      </a>
                    </div>
                      @endif

                    @if(!empty($p_pending_requests))
                    <div class="col-6 col-md-3 col-lg-2dot4 col-xl-1dot7 mt-4 mt-xl-0">
                      <a href="{{ url('admin/request') }}" class="single-dash-sum-item text-center d-flex flex-column justify-content-center">
                        <div class="dash-sum-image">
                          <img src="{{ url('assets/img/iconic-dash-pending-request.png') }}" alt="dashboard-icon">
                        </div>
                        <h3 class="dash-sum-number">{{ $countRequestPending }}</h3>
                        <p class="dash-sum-name text-capitalize">{{ __('admin.Pending_requests') }}</p>
                      </a>
                    </div>
                      @endif

                     @if(!empty($p_total_tutor))
                      <div class="col-6 col-md-3 col-lg-2dot4 col-xl-1dot7 mt-4">
                      <a href="{{ url('admin/tutor') }}" class="single-dash-sum-item text-center d-flex flex-column justify-content-center">
                        <div class="dash-sum-image">
                          <img src="{{ url('assets/img/iconic-dash-teacher.png') }}" alt="dashboard-icon">
                        </div>
                        <h3 class="dash-sum-number">{{ $countTeacherTotal }}</h3>
                        <p class="dash-sum-name text-capitalize">Total Tutor</p>
                      </a>
                    </div>
                      @endif

                     @if(!empty($p_total_student))
                    <div class="col-6 col-md-3 col-lg-2dot4 col-xl-1dot7 mt-4">
                      <a href="{{ url('admin/student') }}" class="single-dash-sum-item text-center d-flex flex-column justify-content-center">
                        <div class="dash-sum-image">
                          <img src="{{ url('assets/img/iconic-dash-students.png') }}" alt="dashboard-icon">
                        </div>
                        <h3 class="dash-sum-number">{{ $countStudentTotal }}</h3>
                        <p class="dash-sum-name text-capitalize">{{ __('admin.Total_student') }}</p>
                      </a>
                    </div>
                      @endif
                  
                   @if(!empty($p_total_category))
                    <div class="col-6 col-md-3 col-lg-2dot4 col-xl-1dot7 mt-4">
                      <a href="{{ url('admin/category') }}" class="single-dash-sum-item  text-center d-flex flex-column justify-content-center">
                        <div class="dash-sum-image">
                          <img src="{{ url('assets/img/iconic-dash-add-teacher.png') }}" alt="dashboard-icon">
                        </div>
                        <h3 class="dash-sum-number">{{ $countCategoryTotal }}</h3>
                        <p class="dash-sum-name text-capitalize">{{ __('admin.Total_Category') }}</p>
                      </a>
                    </div>
                      @endif

                    @if(!empty($p_total_offer))
                     <div class="col-6 col-md-3 col-lg-2dot4 col-xl-1dot7 mt-4">
                      <a href="{{ url('admin/offer') }}" class="single-dash-sum-item  text-center d-flex flex-column justify-content-center">
                        <div class="dash-sum-image">
                          <img src="{{ url('assets/img/iconic-dash-add-student.png') }}" alt="dashboard-icon">
                        </div>
                        <h3 class="dash-sum-number">{{ $countOfferTotal }}</h3>
                        <p class="dash-sum-name text-capitalize">{{ __('admin.Total_Offer') }}</p>
                      </a>
                    </div>
                      @endif

                     @if(!empty($p_total_admin))
                    <div class="col-6 col-md-3 col-lg-2dot4 col-xl-1dot7 mt-4">
                      <a href="{{ url('admin/admin') }}" class="single-dash-sum-item add-admin-btn text-center d-flex flex-column justify-content-center">
                        <div class="dash-sum-image">
                          <img src="{{ url('assets/img/iconic-add-admin.png') }}" alt="dashboard-icon">
                        </div>
                        <h3 class="dash-sum-number">{{ $countAdminTotal }}</h3>
                        <p class="dash-sum-name text-capitalize">{{ __('admin.Total_admin') }}</p>
                      </a>
                    </div>
                      @endif

                     @if(!empty($p_total_booked_lesson))
                    <div class="col-6 col-md-3 col-lg-2dot4 col-xl-1dot7 mt-4">
                      <a href="{{ url('admin/lesson') }}" class="single-dash-sum-item text-center d-flex flex-column justify-content-center">
                        <div class="dash-sum-image">
                          <img src="{{ url('assets/img/iconic-dash-booked-lesson.png') }}" alt="dashboard-icon">
                        </div>
                        <h3 class="dash-sum-number">{{ $TotalBookedLesson }}</h3>
                        <p class="dash-sum-name text-capitalize">Total booked lesson</p>
                      </a>
                    </div>
                      @endif

                    @if(!empty($p_new_report))
                    <div class="col-6 col-md-3 col-lg-2dot4 col-xl-1dot7 mt-4">
                      <a href="{{ url('admin/report') }}" class="single-dash-sum-item text-center d-flex flex-column justify-content-center">
                        <div class="dash-sum-image">
                          <img src="{{ url('assets/img/iconic-dash-new-report.png') }}" alt="dashboard-icon">
                        </div>
                        <h3 class="dash-sum-number">{{ $TotalNewReport }}</h3>
                        <p class="dash-sum-name text-capitalize">New report</p>
                      </a>
                    </div>
                    @endif
                  </div>
                </div>
              </section>
              <!-- end: dashboard summary -->



              <!-- start: report section -->
              <section class="report-section tabled-section order-1 order-xl-1">
                <div class="row section-content custom-column-wrap justify-content-between">
                  
                 @if(!empty($p_new_report)) 
                  <div class="col-new-reports">
                    <div class="new-reports-content list-view-box">
                      <div class="section-heading d-flex justify-content-between">
                        <h3 class="section-title text-capitalize">New reports</h3>
                        <a href="{{ url('admin/report') }}" class="view-all-btn">View all</a>
                      </div>
                      <div class="list-view-content">
                        <table class="content-table">
                          <thead>
                            <tr class="table-heading">
                              <th class="name teacher">Sender Name</th>
                              <th class="name">Receiver Name</th>
                              <th class="title">Message</th>
                            </tr>                       
                           </thead>
                          <tbody>

                            @forelse($getReportDashboard as $report)

                            <tr class="single-item">
                              <td class="name teacher" data-title="Teacher Name">
                                <div class="item-col-1 d-flex align-items-center">
                                  <div class="item-img">
                                    <img src="{!! $report->getsender->getImage() !!}" alt="teacher-image">
                                  </div>
                                  <div class="item-intro">
                                    <h5 class="item-title text-capitalize" style="text-transform: capitalize;font-size: 12px;">{!! $report->getsender->name !!} {!! $report->getsender->last_name !!}</h5>                    
                                    <div class="item-action-buttons" style="margin-top: 10px;margin-bottom: 10px;">
                                      <a href="{{ url('admin/send_mssage/'.$report->sender_id) }}" class="button message-btn"><i class="far fa-envelope"></i></a>
                                    </div>

                                  </div>
                                </div>
                              </td>
                              <td class="name student" data-title="Student Name">
                                <div class="item-col-2 d-flex align-items-center">
                                  <div class="item-img">
                                    <img src="{!! $report->getreceiver->getImage() !!}" alt="student-image">
                                  </div>
                                  <div class="item-intro">
                                    <h5 class="item-title text-capitalize" style="text-transform: capitalize;font-size: 12px;">{!! $report->getreceiver->name !!} {!! $report->getreceiver->last_name !!}</h5>
                                    <div class="item-action-buttons" style="margin-top: 10px;margin-bottom: 10px;">
                                      <a href="{{ url('admin/send_mssage/'.$report->receiver_id) }}" class="button message-btn"><i class="far fa-envelope"></i></a>
                                    </div>
                                  </div>
                                </div>
                              </td>
                              <td class="title" data-title="Lesson Title">
                                <div class="item-col-3">
                                  <p class="title-text">{!! $report->reason !!}</p>
                                </div>
                              </td>
                            </tr>
                            @empty
                             <tr class="single-item">
                              <td colspan="100%"></td>
                            </tr>
                            @endforelse

                          </tbody>
                        </table>
                      </div>
                    </div>
                  </div>
                  @endif

                  <!-- staff activity -->
                  @if(!empty($p_staff_report_page))
                  
                  <div class="col-staff-activity order-md-3 order-xl-2">
                    <div class="staff-activity-content list-view-box">
                      <div class="section-heading d-flex justify-content-between">
                        <h3 class="section-title text-capitalize">Staff activity</h3>
                        <a href="{{ url('admin/activity') }}" class="view-all-btn">View all</a>
                      </div>
                      <div class="list-view-content">
                        <table class="content-table">
                          <thead>
                            <tr class="table-heading">
                              @if (Auth::user()->is_admin == "4")
                              <th class="name">Name</th>
                              @endif
                              <th class="description">Daily reports</th>
                              <th class="action">Action</th>
                            </tr>
                          </thead>
                          <tbody>
                            @forelse ($getActivity as $value_ac)
                             
                            
                            <tr class="single-item">
                               @if (Auth::user()->is_admin == "4")
                              <td class="name" data-title="Name">
                                <div class="item-col-1 d-flex align-items-center">
                                  <div class="item-img">
                                    <img src="{!! $value_ac->getusers->getImage() !!}" alt="item-image">
                                  </div>
                                  <div class="item-intro">
                                    <h5 class="item-title text-capitalize"></h5>
                                    <p class="item-desc">
                            {{ ucfirst(!empty($value_ac->getusers->name)?$value_ac->getusers->name: '') }}
                               {{ ucfirst(!empty($value_ac->getusers->last_name)?$value_ac->getusers->last_name: '') }}
                                     </p>
                                  </div>
                                </div>
                              </td>
                              @endif
                              <td class="description" data-title="Daily reports">
                                <div class="detail-content more">
                              {{ $value_ac->title }}
                                </div>
                              
                              </td>
                              <td class="action" data-title="Action">
                                <div class="item-action-buttons">
                                  <a href="#" class="button message-btn"><i class="far fa-envelope"></i></a>
                                </div>
                              </td>
                            </tr>
                            @empty
                             <tr class="single-item">
                              <td colspan="100%"></td>
                             </tr>
                            @endforelse


                         
                           
                          </tbody>
                        </table>
                      </div>
                    </div>
                  </div>

                  @endif


                   @if(!empty($p_total_admin))
                  <div class="col-status-box order-3 order-md-2 order-xl-3">
                    <div class="status-box-content admin-status list-view-box">
                      <div class="section-heading">
                        <h3 class="section-title text-capitalize">Admin</h3>
                      </div>
                      <div class="user-list list-view-content">

                        @foreach($getAdminOnline as $admin)

                        <a href="{{ url('admin/admin') }}" class="single-user d-flex align-items-center">
                          <span class="image">
                            <img src="{!! $admin->getImage() !!}" alt="user-image">
                          </span>
                          <h6 class="name" style="text-transform: capitalize;">{!!  $admin->name !!} {!!  $admin->last_name !!}</h6>

                          <span class="online-status d-inline-flex align-items-center justify-content-center text-center ml-auto">
                            <span><i class="fas fa-circle"></i></span>
                            Online
                          </span>

                        </a>

                        @endforeach

                    
                      </div>
                    </div>
                  </div>
                  @endif


                </div>
              </section>
              <!-- end: report section -->



              <!-- start: notes section -->
              <section class="notes-section">
                <div class="row section-content custom-column-wrap justify-content-between">
                  <!-- notifications -->
                @if(!empty($p_notification_page))
                  <div class="col-notifications">
                    <div class="notifications-content">
                      <div class="section-heading d-flex flex-wrap flex-sm-nowrap justify-content-between">
                        <span class="notes-head d-flex align-items-start">
                          <h3 class="section-title text-capitalize">Notifications</h3>
                          <span class="notes-count ml-2">14</span>
                        </span>
                        <a href="#" class="view-all-btn">View all</a>
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
                      </div>
                    </div>
                  </div>
                @endif

                  <!-- notes box -->
                  <div class="col-notes">
                    <div class="notes-content notes-box h-100 d-flex flex-column">
                      <div class="section-heading d-flex flex-wrap flex-sm-nowrap justify-content-between">
                        <span class="notes-head d-flex align-items-start">
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

                      <div class="all-notes-btn-cont text-right mt-auto mb-2">
                        <a href="{{ url('admin/notes') }}" class="all-notes-btn view-all-btn">View all</a>
                      </div>
                    </div>
                  </div>

                  <!-- add note custom calendar -->
                  <div class="col-add-note-calendar">
                    <div class="add-note-content course-calendar-box h-100">
                      <h6 class="calendar-title text-capitalize">Add your notes</h6>
                      <div class="calendar-main">
                        <div id="course-calendar"></div>
                      </div>
                    </div>
                  </div>

                  <!-- status box -->
                  @if(!empty($p_total_student))
                    <div class="col-status-box">
                      <div class="status-box-content student-status list-view-box">
                        <div class="section-heading">
                          <h3 class="section-title text-capitalize">Active students</h3>
                        </div>
                        <div class="user-list list-view-content">

                        @foreach($getStudentOnline as $student)
                          <a href="#" class="single-user d-flex align-items-center">
                            <span class="image">
                              <img src="{!! $student->getImage() !!}" alt="user-image">
                            </span>
                            <h6 class="name" style="text-transform:capitalize;">{!! $student->name !!} {!! $student->last_name !!}</h6>
                            <span class="online-status d-inline-flex align-items-center justify-content-center text-center ml-auto">
                              <span><i class="fas fa-circle"></i></span>
                              Online
                            </span>
                          </a>
                        @endforeach                      
                        </div>
                      </div>
                  </div>
                  @endif

                </div>
              </section>
              <!-- end: notes section -->



              <!-- start: lesson section -->
              <section class="lesson-section tabled-section">
                <div class="row section-content custom-column-wrap justify-content-between">
                  @if(!empty($p_total_booked_lesson))
                  <div class="col-booked-lesson">
                    <div class="book-lesson-content list-view-box">
                      <div class="section-heading d-flex justify-content-between">
                        <h3 class="section-title text-capitalize">Booked lesson</h3>
                        <a href="{{ url('admin/lesson') }}" class="view-all-btn">View all</a>
                      </div>
                      <div class="list-view-content">
                        <table class="content-table">
                          <thead>
                            <tr class="table-heading">
                              <th class="name teacher">Teacher Name</th>
                              <th class="name">Student Name</th>
                              <th class="title">Lesson Title</th>
                              <th class="price">Price</th>
                              <th class="status">Status</th>
                            </tr>
                          </thead>
                          <tbody>

                          @forelse($getAdminBookedLesson as $lesson) 

                            <tr class="single-item">
                              <td class="name teacher" data-title="Teacher Name">
                                <div class="item-col-1 d-flex align-items-center">
                                  <div class="item-img">
                                    <img src="{!! $lesson->getusers->getImage() !!}" alt="teacher-image">
                                  </div>
                                  <div class="item-intro">
                                    <h5 class="item-title text-capitalize" style="text-transform: capitalize;">{!! $lesson->getusers->name !!} {!! $lesson->getusers->last_name !!}</h5>
                                    <p class="item-desc">{{ !empty($lesson->getusers->getcategory->category_name) ? $lesson->getusers->getcategory->category_name : '' }}</p>
                                  </div>
                                </div>
                              </td>
                              <td class="name student" data-title="Student Name">
                                <div class="item-col-2 d-flex align-items-center">
                                  <div class="item-img">
                                    <img src="{!! $lesson->getstudent->getImage() !!}" alt="student-image">
                                  </div>
                                  <div class="item-intro">
                                    <h5 class="item-title text-capitalize" style="text-transform: capitalize;">{!! $lesson->getstudent->name !!} {!! $lesson->getstudent->last_name !!}</h5>
                                    <p class="item-desc">{{ !empty($lesson->getstudent->getlevelofstudent->level_of_student_name) ? $lesson->getstudent->getlevelofstudent->level_of_student_name : '' }}</p>
                                  </div>
                                </div>
                              </td>
                              <td class="title" data-title="Lesson Title">
                                <div class="item-col-3">
                                  <p class="title-text">{!! !empty($lesson->getcourse->course_title) ? $lesson->getcourse->course_title : '' !!}</p>
                                </div>
                              </td>
                              <td class="price" data-title="Price">
                                <div class="item-col-4">
                                  ${{ $lesson->lesson_per_rate }}
                                </div>
                              </td>
                              <td class="status" data-title="Status">
                                <div class="item-col-5">
                                  <span class="completed">{{ !empty($lesson->getstatus->status_name) ? $lesson->getstatus->status_name : '' }}</span>
                                </div>
                              </td>
                            </tr>
                            @empty
                              <tr class="single-item">
                                <td class="100%">Booked lesson not found</td>
                              </tr>

                            @endforelse


                          </tbody>
                        </table>
                      </div>
                    </div>
                  </div>
                  @endif

                   @if(!empty($p_pending_requests))
                  <!-- new publish course request -->
                  <div class="col-new-publish-request">
                    <div class="new-publish-content list-view-box">
                      <div class="section-heading d-flex justify-content-between">
                        <h3 class="section-title text-capitalize">{{ __('admin.New_Publish_Course_Request') }}</h3>
                        <a href="{{ url('admin/course') }}" class="view-all-btn">{{ __('admin.View_all') }}</a>
                      </div>
                      <div class="list-view-content">
                        <table class="content-table">
                          <thead>
                            <tr class="table-heading">
                              <th class="name">{{ __('admin.Tutor_Name') }}</th>
                              <th class="subject-time">{{ __('admin.Course_Title') }}</th>
                              <th class="action">{{ __('admin.Action') }}</th>
                            </tr>
                          </thead>
                          <tbody>
                            
                             @foreach ($getcourse as $value)
                            <tr class="single-item">
                              <td class="name" data-title="Name">
                                <div class="item-col-1 d-flex align-items-center">
                                    @if($value->getusers->OnlineUser())
                                          <i class="fa fa-circle online-user"></i>
                                    @endif
                                  <div class="item-img">
                                    <img src="{!! $value->getusers->getImage() !!}" alt="item-image">
                                  </div>
                                  <div class="item-intro">
                                    <h5 class="item-title text-capitalize">
                                          {{ ucfirst(!empty($value->getusers->name)?$value->getusers->name: '') }}
                                          {{ ucfirst(!empty($value->getusers->last_name)?$value->getusers->last_name: '') }}
                                     </h5>
                                    <p class="item-desc">{{ ucfirst(!empty($value->getcategory->category_name)?$value->getcategory->category_name: '') }}</p>
                                  </div>
                                </div>
                              </td>
                              <td class="subject-time" >
                                {{ $value->course_title }}
                              </td>
                              <td>
                                
                                  <a class="btn btn-primary" style="cursor: pointer;color: #fff;" onclick="status_change_course('<?=$value->id?>','2')">{{ __('admin.Approve') }}</a>
                                  <a class="btn btn-danger" style="cursor: pointer;color: #fff;" onclick="status_change_course('<?=$value->id?>','3')">{{ __('admin.Reject') }}</a>
                                  <a href="{{ url( 'admin/course/view/'. $value->id ) }}" class="btn btn-warning">{{ __('admin.View_Course_Details') }}</a>
                               
                              </td>
                            </tr>
                            @endforeach
                     
                          </tbody>
                        </table>
                      </div>
                    </div>
                  </div>

                  @endif


                  @if(!empty($p_total_tutor)) 
                  <!-- status box -->
                  <div class="col-status-box">
                    <div class="status-box-content teacher-status list-view-box">
                      <div class="section-heading">
                        <h3 class="section-title text-capitalize">Active Tutor</h3>
                      </div>
                      <div class="user-list list-view-content">

                        @foreach($getTutorOnline as $tutor)
                          <a href="{{ url('admin/tutor/view/'.$tutor->id) }}" class="single-user d-flex align-items-center">
                            <span class="image">
                              <img src="{!! $tutor->getImage() !!}" alt="user-image">
                            </span>
                            <h6 class="name" style="text-transform: capitalize;">{!! $tutor->name !!} {!! $tutor->last_name !!}</h6>
                            <span class="online-status d-inline-flex align-items-center justify-content-center text-center ml-auto">
                              <span><i class="fas fa-circle"></i></span>
                              Online
                            </span>
                          </a>
                        @endforeach

                      </div>
                    </div>
                  </div>
                  @endif
                </div>
              </section>
              <!-- end: lesson section -->

              <!-- start: report section -->
              <section class="report-section tabled-section order-1 order-xl-1">
                <div class="row section-content custom-column-wrap justify-content-between">
                  <!-- new reports -->

                @if(!empty($p_pending_requests)) 

                  <div class="col-new-reports">
                    <div class="new-reports-content list-view-box">
                      <div class="section-heading d-flex justify-content-between">
                        <h3 class="section-title text-capitalize">{{ __('admin.New_Publish_Request') }}</h3>
                        <a href="{{ url('admin/request') }}" class="view-all-btn">{{ __('admin.View_all') }}</a>
                      </div>
                      <div class="list-view-content">
                        <table class="content-table">
                          <thead>
                            <tr class="table-heading">
                              <th>{{ __('admin.Name') }}</th>
                              <th>{{ __('admin.Title') }}</th>
                              <th>{{ __('admin.Action') }}</th>
                            </tr>
                          </thead>
                          <tbody>
                            {{-- start --}}
                          @forelse ($getrequest as $value_r)
                            <tr class="single-item">
                              <td class="name" data-title="Name">
                                <div class="item-col-1 d-flex align-items-center">
                                  @if($value_r->getusers->OnlineUser())
                                          <i class="fa fa-circle online-user"></i>
                                    @endif
                                  <div class="item-img">
                                    <img src="{!! $value_r->getusers->getImage() !!}" alt="item-image">
                                  </div>
                                  <div class="item-intro">
                                    <h5 class="item-title text-capitalize">

                                    {{ ucfirst(!empty($value_r->getusers->name)?$value_r->getusers->name: '') }}
                                    {{ ucfirst(!empty($value_r->getusers->last_name)?$value_r->getusers->last_name: '') }}
                                    </h5>
                                    <p class="item-desc">{{ ucfirst(!empty($value_r->getcategory->category_name)?$value_r->getcategory->category_name: '') }}</p>
                                  </div>
                                </div>
                              </td>
                              <td class="title" data-title="Title">
                                <div class="item-col-2">
                                  <p class="title-text">{{ $value_r->request_title }} </p>
                                </div>
                              </td>
                              
                           <td>
                              
                                  <a style="cursor: pointer;color: #fff;" class="btn btn-primary" onclick="status_change_request('<?=$value_r->id?>','2')">{{ __('admin.Approve') }}</a>
                                  <a style="cursor: pointer;color: #fff;" class="btn btn-danger" onclick="status_change_request('<?=$value_r->id?>','3')">{{ __('admin.Reject') }}</a>
                                  <a href="{{ url('admin/request/view/'.$value_r->id) }}" class="btn btn-warning">
                                    <img src="{{ url('assets/img/iconic-view-eye.png') }}" alt="view-icon">
                                  </a>
                                
                              </td>
                            
                            </tr>
                            @empty
                            <tr class="single-item">
                                  <td colspan="100%"></td>
                             </tr>
                            @endforelse
                             
                           
                          </tbody>
                        </table>
                      </div>
                    </div>
                  </div>

                  @endif

                  
                 @if(!empty($p_total_offer))
                  <!-- staff activity -->
                  <div class="col-staff-activity order-md-3 order-xl-2">
                    <div class="staff-activity-content list-view-box">
                      <div class="section-heading d-flex justify-content-between">
                        <h3 class="section-title text-capitalize">{{ __('admin.New_Publish_Offer') }}</h3>
                        <a href="{{ url('admin/offer') }}" class="view-all-btn">{{ __('admin.View_all') }}</a>
                      </div>
                      <div class="list-view-content">
                        <table class="content-table">
                          <thead>
                            <tr class="table-heading">
                              <th>{{ __('admin.Name') }}</th>
                              <th>{{ __('admin.Title') }}</th>
                              <th>{{ __('admin.Action') }}</th>
                            </tr>
                          </thead>
                          <tbody>
                            {{-- start --}}
                            @forelse ($getoffer as $value_o)
                             

                            <tr class="single-item">
                              <td class="name" data-title="Name">
                                <div class="item-col-1 d-flex align-items-center">
                                    @if($value_o->getusers->OnlineUser())
                                          <i class="fa fa-circle online-user"></i>
                                    @endif
                                  <div class="item-img">
                                    <img src="{!! $value_o->getusers->getImage() !!}" alt="item-image">
                                  </div>
                                  <div class="item-intro">
                                    <h5 class="item-title text-capitalize">
                                      {{ ucfirst(!empty($value_o->getusers->name)?$value_o->getusers->name: '') }} {{ ucfirst(!empty($value_o->getusers->last_name)?$value_o->getusers->last_name: '') }}
                                    </h5>
                                    <p class="item-desc">{{ ucfirst(!empty($value_o->getcategory->category_name)?$value_o->getcategory->category_name: '') }}</p>
                                  </div>
                                </div>
                              </td>
                              <td class="description" data-title="Daily reports">
                                <div class="detail-content more">
                                  {{ $value_o->title }}
                                </div>
                              </td>
                              <td>
                               
                                  <a style="cursor: pointer;color: #fff;" class="btn btn-primary" onclick="status_change_offer('<?=$value_o->id?>','2')">{{ __('admin.Approve') }}</a>
                                  <a style="cursor: pointer;color: #fff;" class="btn btn-danger" onclick="status_change_request('<?=$value_o->id?>','3')">{{ __('admin.Reject') }}</a>
                                  <a style="cursor: pointer;color: #fff;" href="{{ url('admin/offer/view/'.$value_o->id) }}" class="btn btn-warning">
                                    <img src="{{ url('assets/img/iconic-view-eye.png') }}" alt="view-icon">
                                  </a>
                              
                              </td>
                            </tr>

                            @empty
                            <tr class="single-item">
                                  <td colspan="100%"></td>
                             </tr>
                            @endforelse

                            {{-- end --}}
                            
                          </tbody>
                        </table>
                      </div>
                    </div>
                  </div>
                  @endif

                  <!-- status box -->
                  <div class="col-status-box order-3 order-md-2 order-xl-3">
                    <div class="status-box-content admin-status list-view-box" style="display: none;">
                     
                    </div>
                  </div>


                </div>
              </section>
              <!-- end: report section -->
            </div>
            <!-- end: dashboard main content -->
          </div>
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
  
@section('script')
  <script type="text/javascript">

    function status_change_course(id, status) {
        $.ajax({
                type:'GET',
                url:"{{url('admin/course/change_status')}}",
                data: {id:id,status:status},
                dataType: 'JSON',
                success:function(data){
                   alert(data.success);
                   location.reload();
                }
         });

    };

    function status_change_request(id, status) {
        $.ajax({
                type:'GET',
                url:"{{url('admin/request/change_request_status')}}",
                data: {id:id,status:status},
                dataType: 'JSON',
                success:function(data){
                   alert(data.success);
                   location.reload();
                }
         });

    };

    function status_change_offer(id, status) {
        $.ajax({
                type:'GET',
                url:"{{url('admin/offer/change_offer_status')}}",
                data: {id:id,status:status},
                dataType: 'JSON',
                success:function(data){
                   alert(data.success);
                   location.reload();
                }
         });

    };

    
  </script>
@endsection   

