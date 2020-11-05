@extends('backend.layouts.app')
@section('content')
<!-- start: breadcrumb area -->
<div class="breadcrumb-area">
   <div class="container">
      <div class="row">
         <div class="col-6">
            <div class="breadcrumb-items d-flex align-items-center">
               <span class="breadcrumb-trail">
               <a href="#" class="text-capitalize">{{ __('admin.View_Course_Detail') }}</a>
               </span>
            </div>
         </div>
         <div class="col-6" style="text-align: right;">
            <a href="{{ url('admin/course') }}" class="btn btn-danger">{{ __('admin.Back') }}</a>
      </div>
      </div>
   </div>
</div>
<!-- end: breadcrumb area -->
<!-- start: main content -->
<div class="main-content lesson-detail-content">
   <div class="container">
      <div class="row">
         <div class="col-12">
            <!-- start: course detail content -->
            <section class="lesson-detail-section">
               <div class="lesson-detail-view">
                  <div class="lesson-detail-tabulation course-tabulation w-100">


                     <div class="row">
                        <div class="col-lg-8">
                           <div class="tab-content lesson-detail-tab-content">
                              <div class="tab-pane in active lesson-detail-main">
                                 <div class="detail-tab-box course-title-box">
                                    <h3>{{ $value->course_title }}</h3>
                                 </div>
                                 <div class="detail-tab-box course-title-box">
                                    <h5>{{ __('admin.Course_Basic_Detail') }}</h5>
                                    <br />
                                    <table class="table">
                                        <tr>
                                          <td style="width: 30%">{{ __('admin.Teacher_Name') }}</td>
                                          <td>
{{ ucfirst(!empty($value->getusers->name)?$value->getusers->name: '') }}
{{ ucfirst(!empty($value->getusers->last_name)?$value->getusers->last_name: '') }}    
                                          </td>
                                       </tr>
                                       <tr>
                                          <td style="width: 30%">{{ __('admin.Category') }}</td>
                                          <td>{{ ucfirst(!empty($value->getcategory->category_name)?$value->getcategory->category_name: '') }}</td>
                                       </tr>
                                       <tr>
                                          <td>{{ __('admin.Course_Language') }} </td>
                                          <td>{{ ucfirst(!empty($value->getlanguage->language_name)?$value->getlanguage->language_name: '') }}</td>
                                       </tr>
                                       @if(!empty($value->getImageCourse()))
                                       <tr>
                                          <td>{{ __('admin.Course_Image') }} </td>
                                          <td><img style="height: 100px;" src="{!! $value->getImageCourse() !!}"></td>
                                       </tr>
                                       @endif
                                       @if(!empty($value->getVideoCourse()))
                                       <tr>
                                          <td>{{ __('admin.Course_Video') }} </td>
                                          <td>
                                             <video width="320" height="240" controls>
                                                <source src="{!! $value->getVideoCourse() !!}" type="video/mp4">
                                             </video>
                                          </td>
                                       </tr>
                                       @endif
                                       <tr>
                                          <td>{{ __('admin.Price_For_Each_Lesson') }}</td>
                                          <td>${{ $value->lesson_per_rate }}</td>
                                       </tr>
                                       <tr>
<td>{{ __('admin.What_type_of_lesson_do_you_Provide') }}</td>
                                          <td>{{ !empty($value->get_lesson_type->request_type_name) ? $value->get_lesson_type->request_type_name : '' }}</td>
                                       </tr>
                                       <tr>
                                          <td>{{ __('admin.Created_Date') }}</td>
                                          <td>{{ date('Y-m-d h:i A',strtotime($value->created_at)) }}</td>
                                       </tr>
                                    </table>
                                 </div>
                                 <div class="detail-tab-box course-description">
                                    <h6 class="label text-capitalize">{{ __('admin.Description') }}</h6>
                                    <p>
                                       {!! $value->description !!}
                                    </p>
                                 </div>
                              </div>
                           </div>
                        </div>
                        <div class="col-lg-4">
                           <div class="notes-box d-flex flex-column">
                              @if(!empty(count($value->get_course_subject)))
                              <div class="form-group time-picker" style="text-align: center;">
                                 <h5 for="publish-start-time">{{ __('admin.Subject_List') }}</h5>
                                 <br />
                                 <table class="table">
                                    @foreach($value->get_course_subject as $value_s)
                                    <tr>
                                       <td>{{ $value_s->subject_name }}</td>
                                       <td><a style="margin-left: 30px;padding: 3px 10px;" href="{{ url('tutor/course/subject/delete/'.$value_s->id) }}" class="btn btn-danger"><i class="fa fa-trash"></i></a></td>
                                    </tr>
                                    @endforeach
                                 </table>
                              </div>
                              @endif
                              @if(!empty(count($value->get_course_lesson)))
                              <div class="form-group time-picker" style="text-align: center;">
                                 <h5 for="publish-start-time">{{ __('admin.Chosed_start_date_time_and_duration') }}</h5>
                                 <hr />
                                 @foreach($value->get_course_lesson as $values)
                                 <div>
                                    <div class="initial-field with-btn">
                                       {{ $values->lesson_start_date }}
                                       <span class="time-picker-separator">-</span>
                                       {{ date('h:i A',strtotime($values->lesson_end_time)) }}
                                       <span class="time-picker-separator">-</span>
                                       {{ $values->duration }} {{ __('admin.Minutes') }}
                                       <a style="margin-left: 30px;padding: 3px 10px;" href="{{ url('tutor/course/lesson/delete/'.$values->id) }}" class="btn btn-danger"><i class="fa fa-trash"></i></a>
                                    </div>
                                 </div>
                                 <hr />
                                 @endforeach                                                   
                              </div>
                              @endif
                           </div>
                        </div>
                     </div>
                  </div>
               </div>
            </section>
            <!-- end: course detail content -->
         </div>
      </div>
   </div>
</div>
<!-- end: main content -->
@endsection