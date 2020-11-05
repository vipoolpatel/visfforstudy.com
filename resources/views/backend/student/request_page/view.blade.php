@extends('backend.layouts.app')
@section('content')

<div class="breadcrumb-area">
   <div class="container">
      <div class="row">
         <div class="col-6">
            <div class="breadcrumb-items d-flex align-items-center">
               <span class="breadcrumb-trail">
               <a href="#" class="text-capitalize">{{ __('student.View_Request_Detail') }}</a>
               </span>
            </div>
         </div>
         <div class="col-6" style="text-align: right;">
         	<a href="{{ url('student/request-page/edit/'.$value->id) }}" class="btn btn-danger">{{ __('student.Edit') }}</a>
	        <a href="{{ url('student/request-page') }}" class="btn btn-success">{{ __('student.Back') }}</a>
		</div>
      </div>
   </div>
</div>

<div class="main-content lesson-detail-content">
   <div class="container">
      <div class="row">
         <div class="col-12">
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
                                    <h5>{{ __('student.Request_Basic_Detail') }}</h5>
                                    <br>
                                    <table class="table">
                                       <tbody>
                                   		  <tr>
                                             <td style="width: 30%">
{{ __('student.Date_and_Time') }}
                                             </td>
                                             <td>{{ $value->lesson_start_date }} - {{ date('h:i A',strtotime($value->lesson_start_time)) }}</td>
                                          </tr>
                                          <tr>
                                             <td style="width: 30%">{{ __('student.Duration') }}</td>
                                             <td>{{ $value->duration }} {{ __('student.Minutes') }}</td>
                                          </tr>

                                      
                                          <tr>
                                             <td>{{ __('student.Level_of_Student') }}</td>
                                             <td>{{ ucfirst(!empty($value->getlevelofstudent->level_of_student_name)?$value->getlevelofstudent->level_of_student_name: '') }}</td>
                                          </tr>
                                          <tr>
                                             <td>{{ __('student.Category') }}</td>
                                             <td>{{ ucfirst(!empty($value->getcategory->category_name)?$value->getcategory->category_name: '') }}</td>
                                          </tr>
                                          <tr>
                                             <td>{{ __('student.Language') }} </td>
                                             <td>
                                                {{ ucfirst(!empty($value->getlanguage->language_name)?$value->getlanguage->language_name: '') }}
                                             </td>
                                          </tr>
                                          <tr>
                     <td>{{ __('student.Price_For_Each_Lesson') }}</td>
                                             <td>${{ $value->rate_per_hour }}</td>
                                          </tr>
                                          <tr>
                                             <td>
{{ __('student.What_type_of_lesson_do_you_need') }}
                                             </td>
                                             <td>{{ ucfirst(!empty($value->getrequesttype->request_type_name)?$value->getrequesttype->request_type_name: '') }}</td>
                                          </tr>
                                          <tr>
                                             <td>{{ __('student.Status') }}</td>
                                             <td>
                                             	@if($value->status == 1)
				                                  <span>{{ __('student.Pending') }}</span>
				                                @elseif($value->status == 2) 
				                                  <span style="color: green">{{ __('student.Approved') }}</span>
				                                @elseif($value->status == 3)
				                                  <span style="color: red">{{ __('student.Rejected') }}</span>
				                                @endif
                                             </td>
                                          </tr>
                                          <tr>
                                             <td>{{ __('student.Created_Date') }}</td>
                                             <td>{{ date('Y-m-d h:i A',strtotime($value->created_at)) }}</td>
                                          </tr>
                                       </tbody>
                                    </table>
                                 </div>
                                 <div class="detail-tab-box course-description">
                                    <h6 class="label text-capitalize">{{ __('student.Description') }}</h6>
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
         </div>
      </div>
   </div>
</div>

@endsection