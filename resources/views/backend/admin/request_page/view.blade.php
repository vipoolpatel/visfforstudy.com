@extends('backend.layouts.app')

@section('content')


<div class="breadcrumb-area">
   <div class="container">
      <div class="row">
         <div class="col-6">
            <div class="breadcrumb-items d-flex align-items-center">
               <span class="breadcrumb-trail">
               <a href="#" class="text-capitalize">{{ __('admin.View_Request_Detail') }}</a>
               </span>
            </div>
         </div>
         <div class="col-6" style="text-align: right;">
            <a href="{{ url('admin/request') }}" class="btn btn-danger">{{ __('admin.Back') }}</a>
      </div>
      </div>
   </div>
</div>



<div class="main-content lesson-detail-content">
   <div class="container">
      <div class="row">
         <div class="col-12">
            <!-- start: course detail content -->
            <section class="lesson-detail-section">
               <div class="lesson-detail-view">
                  <div class="lesson-detail-tabulation course-tabulation w-100">
                     <div class="row">
                        <div class="col-lg-12">
                           <div class="tab-content lesson-detail-tab-content">
                              <div class="tab-pane in active lesson-detail-main">
                                 <div class="detail-tab-box course-title-box">
                                    <h3>{{ $value->request_title }}</h3>
                                 </div>
                                 <div class="detail-tab-box course-title-box">
                                    <h5>{{ __('admin.Request_Basic_Detail') }}</h5>
                                    <br>
                                    <table class="table">
                                       <tbody>
                                         <tr>
                                             <td style="width: 30%">{{ __('admin.Student_Name') }}</td>
                                             <td class="teacher-name" data-title="Teacher name">
                                                <span class="info-wrap">
                                             @if($value->getusers->OnlineUser())
                                             <i class="fa fa-circle online-user"></i>
                                             @endif
                                             <span class="image">
                                             <img src="{!! $value->getusers->getImage() !!}" style="height: 50px;border-radius: 50%;" alt="{{ ucfirst(!empty($value->getusers->name)?$value->getusers->name: '') }}">
                                             </span>
                                             <span class="name">
                                             {{ ucfirst(!empty($value->getusers->name)?$value->getusers->name: '') }}
                                             {{ ucfirst(!empty($value->getusers->last_name)?$value->getusers->last_name: '') }}
                                             </span>
                                             </span>
                                             </td>
                                          </tr>
                                         <tr>
                                             <td style="width: 30%">
{{ __('admin.Date_and_Time') }}
                                             </td>
                                             <td>{{ $value->lesson_start_date }} - {{ $value->lesson_start_time }}</td>
                                          </tr>
                                          <tr>
                                             <td style="width: 30%">{{ __('admin.Duration') }}</td>
                                             <td>{{ $value->duration }} {{ __('admin.Minutes') }}</td>
                                          </tr>

                                          <tr>
                                             <td>{{ __('admin.What_type_of_lesson_do_you_need') }}</td>
                                             <td>{{ ucfirst(!empty($value->getrequesttype->request_type_name)?$value->getrequesttype->request_type_name: '') }}</td>
                                          </tr>
                                          <tr>
                                             <td>{{ __('admin.Level_of_Student') }}</td>
                                             <td>{{ ucfirst(!empty($value->getlevelofstudent->level_of_student_name)?$value->getlevelofstudent->level_of_student_name: '') }}</td>
                                          </tr>
                                          <tr>
                                             <td>{{ __('admin.Category') }}</td>
                                             <td>{{ ucfirst(!empty($value->getcategory->category_name)?$value->getcategory->category_name: '') }}</td>
                                          </tr>
                                          <tr>
                                             <td>{{ __('admin.Language') }} </td>
                                             <td>
                                                {{ ucfirst(!empty($value->getlanguage->language_name)?$value->getlanguage->language_name: '') }}
                                             </td>
                                          </tr>
                                          <tr>
                                             <td>
                                             {{ __('admin.Price_For_Each_Lesson') }}</td>
                                             <td>${{ $value->rate_per_hour }}</td>
                                          </tr>
                                       
                                          <tr>
                                             <td>{{ __('admin.Created_Date') }}</td>
                                             <td>{{ date('Y-m-d h:i A',strtotime($value->created_at)) }}</td>
                                          </tr>
                                       </tbody>
                                    </table>
                                 </div>
                                 <div class="detail-tab-box course-description">
                                    <h6 class="label text-capitalize">{{ __('admin.Description') }}</h6>
                                    <p>
                                      {!! $value->request_description !!}
                                    </p>
                                 </div>
                              </div>
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






@endsection