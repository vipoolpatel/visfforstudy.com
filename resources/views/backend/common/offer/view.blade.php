@extends('backend.layouts.app')
@section('style')
<style type="text/css">
   .small-btn 
   {
   padding: 1px 5px;font-size: 12px;line-height: 1.5;border-radius: 3px;
   }
   .modal-sm {
   max-width: 600px !important;
   }
</style>
@endsection 
@section('content')
<div class="breadcrumb-area">
   <div class="container">
      <div class="row">
         <div class="col-6">
            <div class="breadcrumb-items d-flex align-items-center">
               <span class="breadcrumb-trail">
               <a href="#" class="text-capitalize">Offer Details</a>
               </span>
            </div>
         </div>
         <div class="col-6" style="text-align: right;">
            <a href="{{ url('tutor/offer') }}" class="btn btn-primary">{{ __('student.Back') }}</a>
         </div>
      </div>
   </div>
</div>


   <div class="main-content lesson-detail-content">
      <div class="container">
         <div class="row">
            <div class="col-12">
               <!-- start: lesson detail content -->
               <section class="lesson-detail-section">
                  <div class="lesson-detail-view">
                     <div class="lesson-detail-tabulation course-tabulation w-100">
                        <div class="tabulation-header d-flex justify-content-between align-items-center">
                           <ul class="nav nav-tabs">
                              <li>
                                 <a data-toggle="tab" href="#lessonDetailTab" class="active">Lesson Details</a>
                              </li>
                              <li>
                             @if(Auth::user()->is_admin != 3)
                               <a data-toggle="tab" href="#detailChatTab">
                                 Student Detail
                              </a>
                              </li>
                            @endif
                           </ul>
                           <div class="tabulation-header-buttons">
                              @if(Auth::user()->is_admin != 2)
                                 @if($value->is_complete == '1' && Auth::user()->is_admin == 3)
                                 <a style="cursor: pointer;color: #fff;" class="button complete-btn text-capitalize thin-bg CompleteCourse">Complete course</a>

                                 @endif
                              @endif
                              @if($value->is_complete == '1')
                              <a href="#" class="button join-btn text-capitalize deep-bg mt-1 mt-md-0 ml-md-3">Join Class Room</a>
                              @endif
                           </div>
                        </div>
                        <div class="row">
                           <div class="col-lg-8">
                              <div class="tab-content lesson-detail-tab-content">
                                 <div id="lessonDetailTab" class="tab-pane in active lesson-detail-main">
                                    <div class="detail-tab-box course-title-box">
                                       <h3 class="course-title">{{ $value->title }}</h3>
                                    </div>
                                    <div class="detail-tab-box course-meta-box d-md-flex justify-content-between">
                                       <span class="meta-item name">
                                          <p class="label">Lesson</p>
                                          <p class="desc">{{ ucfirst(!empty($value->getcategory->category_name)?$value->getcategory->category_name: '') }}</p>
                                       </span>
                                       <span class="meta-item start-time text-md-center">
                                          <p class="label">Start Date</p>
                                          <p class="desc">{{ date('Y-m-d', $value->lesson_time) }}</p>
                                       </span>
                                       <span class="meta-item due-time text-md-center">
                                          <p class="label">Start Time</p>
                                          <p class="desc">{{ date('h:i A', $value->lesson_time) }}</p>
                                       </span>
                                       <span class="meta-item text-md-center">
                                          <p class="label">{{ __('tutor.Duration') }}</p>
                                          <p class="desc">{{ $value->duration }} {{ __('tutor.Minutes') }}</p>
                                       </span>
                                       <span class="meta-item status incomplete text-md-center">
                                       <p class="label">Payment Status</p>
                                          <p class="desc">
                                                @if(!empty($value->is_payment))
                                                   <span class="btn btn-success small-btn">{{ __('student.Booked') }}</span>
                                                @else
                                                   @if(Auth::user()->is_admin == 3)
                                                      <a href="{{ url('student/offer/payment/'.$value->id) }}" class="btn btn-danger">{{ __('student.Book_Now') }}</a>
                                                   @endif
                                                @endif
                                          </p>
                                       </span>
                                    </div>

                                    <div class="detail-tab-box course-meta-box d-md-flex justify-content-between">
                                       <span class="meta-item name">
                                          <p class="label">{{ __('tutor.Price_For_Each_Lesson') }}</p>
                                          <p class="desc">${{ $value->lesson_per_rate }}</p>
                                       </span>
                                       <span class="meta-item start-time text-md-center">
                                          <p class="label">{{ __('tutor.Whats_Your_Level') }}</p>
                                          <p class="desc">{{ ucfirst(!empty($value->getlevel->level_of_student_name)?$value->getlevel->level_of_student_name: '') }}</p>
                                       </span>
                                       <span class="meta-item due-time text-md-center">
                                          <p class="label">{{ __('tutor.Lesson_language') }}</p>
                                          <p class="desc">{{ ucfirst(!empty($value->getlanguage->language_name)?$value->getlanguage->language_name: '') }}</p>
                                       </span>
                                       <span class="meta-item text-md-center">
                                          <p class="label">{{ __('tutor.What_type_of_lesson_do_you_Provide') }}</p>
                                          <p class="desc">{{ ucfirst(!empty($value->get_lesson_type->request_type_name)?$value->get_lesson_type->request_type_name: '') }}</p>
                                       </span>
                                         <span class="meta-item status incomplete text-md-center">
                                       <p class="label">Order Status</p>
                                       <p class="desc">
                                          @if($value->is_complete == '1')
                                             Incomplete
                                          @elseif($value->is_complete == '2')
                                          <span style="color: green">Complete</span>
                                          @endif
                                       </p>
                                    </span>
                                    </div>






                                    <div class="detail-tab-box course-description">
                                       <h6 class="label text-capitalize">Task Description</h6>
                                       <p>
                                           {!! $value->description !!}
                                       </p>
                                    </div>
                                    <div class="detail-tab-box homework-tabulation">
                                       <ul class="nav nav-tabs">
                                          <li>
                                             <a data-toggle="tab" href="#submitedHwTab" class="active">Submited Homework</a>
                                          </li>
                                          <li>
                                             <a data-toggle="tab" href="#completedHwTab">Completed Homework</a>
                                             <span class="hw-complete-count ml-2">{{ $value->gethomeworksubmited->count() }}</span>
                                          </li>
                                       </ul>
                                       <div class="tab-content homework-tab-content">
                                          <div id="submitedHwTab" class="tab-pane in active">
                                             <div class="hw-list submited">

                                             @php
                                             $home = 1;
                                             @endphp
                                             @foreach($value->gethomework as $value_homework)
                                             <div class="single-hw-item">
                                                <h4 class="hw-title">
                                                   <span class="hw-sl">{{ $home++ }}.</span>
                                                   <span class="text">{{ $value_homework->title }}</span>
                                                </h4>
                                                <p class="hw-desc">
                                                   {{ $value_homework->description }}
                                                </p>
                                                @if(!empty($value_homework->attachment))
                                                <p class="hw-desc">
                                                   Donwload File: <a target="_blank" href="{{ url('upload/homework/'.$value_homework->attachment) }}">Download</a>
                                                </p>
                                                @endif
                                                <div class="hw-footer d-md-flex align-items-end">
                                                   <div class="hw-action-buttons">
                                                      @if(Auth::user()->is_admin == 2)
                                                      <a href="{{ url('admin/send_mssage/'.$value->student_id) }}" class="button mail-btn">Send Message</a>
                                                      @elseif(Auth::user()->is_admin == 3)

                                                      <a href="{{ url('student/chat') }}" class="button mail-btn">Send Message</a>
                                                      @if($value_homework->is_complete == 0)
                                                      <a style="cursor: pointer;" id="{{ $value_homework->id }}" class="button complete-btn MarkasComplete">Submit Homework</a>
                                                      @endif
                                                      @endif
                                                   </div>
                                                   <div class="hw-meta d-flex justify-content-between align-items-center mt-3 mt-md-0">
                                                      <span class="time-frame text-md-right">
                                                      Date & Time : {{ date('Y-m-d h:i A',$value_homework->lesson_time) }}
                                                      </span>
                                                   </div>
                                                </div>
                                             </div>
                                             @endforeach

                                             </div>
                                          </div>
                                          <div id="completedHwTab" class="tab-pane">
                                             <div class="hw-list completed">
                                           
                                             @php
                                             $homesubmited = 1;
                                             @endphp
                                             @foreach($value->gethomeworksubmited as $value_homework_submit)
                                             <div class="single-hw-item">
                                                <h4 class="hw-title">
                                                   <span class="hw-sl">{{ $homesubmited++  }}.</span>
                                                   <span class="text">{!! $value_homework_submit->title !!}</span>
                                                </h4>
                                                <p class="hw-desc">
                                                   {!! $value_homework_submit->description_complete !!}
                                                </p>
                                                @if(!empty($value_homework_submit->attachment_complete))
                                                <p class="hw-desc">
                                                   Donwload File: <a target="_blank" href="{{ url('upload/homework/'.$value_homework_submit->attachment_complete) }}">Download</a>
                                                </p>
                                                @endif
                                                <div class="hw-footer d-md-flex align-items-end">
                                                   <div class="hw-action-buttons">
                                                      Submitted Date & Time : {{ date('Y-m-d h:i A',$value_homework_submit->complete_date) }}
                                                   </div>
                                                </div>
                                             </div>
                                             @endforeach

                                            
                                             </div>
                                          </div>
                                       </div>
                                    </div>
                                 </div>
                           @if(Auth::user()->is_admin != 3)
                              <div id="detailChatTab" class="tab-pane detail-chat-tab">
                                 <div class="chatbox">
                                    <div class="user-info">
                                       <div class="row">
                                          <div class="col-12 col-md-12">
                                             <div class="profile-list-bio">
                                                <div class="bio-image">
                                                   <div class="profile-image">
                                                      <img src="{!! $value->getstudent->getImage() !!}" alt="profile-picture">
                                                   </div>
                                                </div>
                                                <div class="bio-desc">
                                                   <h3 class="profile-name" style="text-transform: capitalize;">{!! $value->getstudent->name !!} {!! $value->getstudent->last_name !!}</h3>
                                                   <div class="rating d-flex justify-content-center justify-content-md-start">
                                                      <span class="stars">
                                                      {!! $value->getstudent->getHTMLRating() !!}
                                                      </span>
                                                      <span class="point">{!! $value->getstudent->totalRating() !!}</span>
                                                      <span class="text">Reviews</span>
                                                   </div>
                                                   <h6 class="request-label">{!! !empty($value->getstudent->getlevelofstudent->level_of_student_name) ? $value->getstudent->getlevelofstudent->level_of_student_name : '' !!}</h6>

                                                    <a href="{{ url('admin/send_mssage/'.$value->student_id) }}" class="btn btn-danger text-capitalize">Chat</a>


                                                </div>
                                             </div>
                                          </div>
                                          
                                       </div>
                                    </div>
                                 </div>
                              </div>

                           @endif

                              </div>
                           </div>
                           <div class="col-lg-4">
                              <div class="notes-box d-flex flex-column">
                                 <div class="section-heading d-flex flex-wrap flex-sm-nowrap justify-content-between">
                                    <span class="notes-head d-flex align-items-center">
                                       <h3 class="section-title text-capitalize">My Notes</h3>
                                       <span class="notes-count ml-2">{{ $value->getnote->count() }}</span>
                                    </span>
                                       @if(Auth::user()->is_admin != 1)
                                       <a style="cursor: pointer;" class="add-note-btn AddNotesCourse">
                                          <i class="fas fa-plus"></i>
                                          <span class="text text-capitalize ml-1">Add notes</span>
                                       </a>
                                       @endif
                                 </div>
   
                                 <div class="notes-list">
                               @foreach($value->getnote as $value_note)
                                 <div class="single-note d-flex align-items-start">
                                    <span class="icon">
                                    <img src="{{ url('assets/img/iconic-file-text.png') }}" alt="note-icon">
                                    </span>
                                    <div class="content">
                                       <a href="#" class="note-title">
                                       {{ $value_note->title }}
                                       </a>
                                       <p class="desc">
                                          {{ $value_note->message }}
                                       </p>
                                       <p class="date">{{ date('Y-m-d h:i A',strtotime($value_note->created_at)) }}</p>
                                    </div>
                                 </div>
                                 @endforeach
                                 </div>
   
                              </div>

                              @if(Auth::user()->is_admin == 2)
                              <div class="hw-calendar course-calendar-box">
                                 <h6 class="calendar-title text-capitalize">My homework Calendar</h6>
                                 <div class="calendar-main">
                                    <div id="course-calendar"></div>
                                 </div>                        
                              </div>
                              @endif


                           </div>
                        </div>                        
                        
                     </div>
                  </div>
               </section>
               <!-- end: lesson detail content -->
            </div>
         </div>
      </div>
   </div>

<div class="modal fade" id="CompleteCourseModal" role="dialog">
   <div class="modal-dialog modal-sm">
      <div class="modal-content">
         <div class="modal-header">
            <h4 style="font-size: 20px;" class="modal-title">Complete Course</h4>
            <button type="button" class="close" data-dismiss="modal">&times;</button>
         </div>
         <form action="{{ url('student/lesson/complete/'.$value->id) }}" method="post">
            {{ csrf_field() }}
            <input type="hidden" name="offer_id" value="{{ $value->id }}">
            <input type="hidden" name="type" value="offer">
            <div class="modal-body ">
               <div class="form-group">
                  <label>How many start?</label>
                  <select class="form-control" required name="rating">
                     <option value="1">1</option>
                     <option value="2">2</option>
                     <option value="3">3</option>
                     <option value="4">4</option>
                     <option value="5">5</option>
                  </select>
               </div>
               <div class="form-group">
                  <label>Review</label>
                  <textarea class="form-control" rows="4" placeholder="Write your review" required name="review"></textarea>
               </div>
            </div>
            <div class="modal-footer">
               <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
               <button type="submit" class="btn btn-danger">Complete</button>   
            </div>
         </form>
      </div>
   </div>
</div>

<div class="modal fade" id="AddNotesCourseModal" role="dialog">
   <div class="modal-dialog modal-sm">
      <div class="modal-content">
         <div class="modal-header">
            <h4 style="font-size: 20px;" class="modal-title">Notes</h4>
            <button type="button" class="close" data-dismiss="modal">&times;</button>
         </div>
         <form action="{{ url('note/lesson/add') }}" method="post">
            {{ csrf_field() }}
            <input type="hidden" name="offer_id" value="{{ $value->id }}">
            <input type="hidden" name="type" value="offer">
            <div class="modal-body ">
               <div class="form-group">
                  <label>Title</label>
                  <input type="text" class="form-control" placeholder="Title" required name="title">
               </div>
               <div class="form-group">
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



<div class="modal fade" id="HomeWorkModal" role="dialog">
   <div class="modal-dialog modal-sm">
      <div class="modal-content">
         <div class="modal-header">
            <h4 style="font-size: 20px;" class="modal-title">Add Homework</h4>
            <button type="button" class="close" data-dismiss="modal">&times;</button>
         </div>
         <form action="{{ url('tutor/lesson/homework_submit') }}"  enctype="multipart/form-data" method="post">
            {{ csrf_field() }}
            <input type="hidden" id="altField" name="lesson_date" value="">
            <input type="hidden" name="offer_id" value="{{ $value->id }}">
            <input type="hidden" name="type" value="offer">
            <div class="modal-body ">
               <div class="add-hw-form d-flex flex-wrap justify-content-between">
                  <div class="form-group title-field">
                     <label for="hwTitle">Lesson Date: <span id="getLessonDate"></span></label>
                  </div>
                  <div class="form-group title-field">
                     <label for="hwTitle">Home work Title</label>
                     <input type="text" name="title" id="hwTitle" required class="form-control hw-title" placeholder="Enter a home work Title">
                  </div>
                  <div class="form-group time-field">
                     <label for="hwTime">Lesson time</label>
                     <input type="time" name="lesson_time" id="hwTime" required class="form-control hw-time">
                  </div>
                  <div class="form-group attachment-field">
                     <label for="">Upload/Download file</label>
                     <div class="custom-file-btn-wrapper form-control">
                        <input type="file" name="attachment" id="hwAttachment" class="inputfile form-control hw-attachment" data-multiple-caption="{count} files selected" multiple="">
                        <label for="hwAttachment"><span>Select a file…</span></label>
                     </div>
                  </div>
                  <div class="form-group description-field">
                     <label for="hwDescription">Add Description</label>
                     <textarea name="description" id="hwDescription" required class="form-control hw-desc" cols="6" rows="4"></textarea>
                  </div>
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


<div class="modal fade" id="SubmitHomeWorkModal" role="dialog">
   <div class="modal-dialog modal-sm">
      <div class="modal-content">
         <div class="modal-header">
            <h4 style="font-size: 20px;" class="modal-title">Submit Homework</h4>
            <button type="button" class="close" data-dismiss="modal">&times;</button>
         </div>
         <form action="{{ url('student/lesson/homework_submit') }}"  enctype="multipart/form-data" method="post">
            {{ csrf_field() }}
            <input type="hidden" name="home_work_id" id="get_home_work_id">
            <div class="modal-body">
               <div class="add-hw-form d-flex flex-wrap justify-content-between">
                  <div class="form-group attachment-field" style="width: 100%;">
                     <label for="">Upload/Download file</label>
                     <div class="custom-file-btn-wrapper form-control">
                        <input type="file" name="attachment" id="hwAttachmenthomework" class="inputfile form-control hw-attachment" data-multiple-caption="{count} files selected" multiple="">
                        <label for="hwAttachmenthomework"><span>Select a file…</span></label>
                     </div>
                  </div>
                  <div class="form-group description-field">
                     <label for="hwDescription">Add Description</label>
                     <textarea name="description" id="hwDescription" required class="form-control hw-desc" cols="6" rows="4"></textarea>
                  </div>
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
   $('.MarkasComplete').click(function(){
         var id = $(this).attr('id');
         $('#get_home_work_id').val(id);
         $('#SubmitHomeWorkModal').modal('show');
   });
      
      $('.AddNotesCourse').click(function(){
            $('#AddNotesCourseModal').modal('show');
      });

      $('.CompleteCourse').click(function(){
            $('#CompleteCourseModal').modal('show');
      });

      
   
</script>
@endsection
