@extends('backend.layouts.app')
@section('content')


<div class="breadcrumb-area">
   <div class="container">
      <div class="row">
         <div class="col-6">
            <div class="breadcrumb-items d-flex align-items-center">
               <span class="breadcrumb-trail">
               <a href="#" class="text-capitalize">{{ __('tutor.View_Qualification_Detail') }}</a>
               </span>
            </div>
         </div>
         <div class="col-6" style="text-align: right;">
            <a href="{{ url('tutor/qualification/edit/'.$value->id) }}" class="btn btn-success">{{ __('tutor.Edit') }}</a>
            <a href="{{ url('tutor/qualification') }}" class="btn btn-danger">{{ __('tutor.Back') }}</a>
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
                                    <h5>{{ __('tutor.View_Qualification_Detail') }}</h5>
                                    <br>
                                    <table class="table">
                                       <tbody>
                                          <tr>
                                             <td style="width: 30%">
{{ __('tutor.University_Name') }}
                                             </td>
                                             <td>{{ $value->university_name }}</td>
                                          </tr>
                                          <tr>
                                             <td>{{ __('tutor.Degree') }} </td>
                                             <td>{{ $value->degree }}</td>
                                          </tr>
                                          <tr>
                                             <td>{{ __('tutor.Major') }}</td>
                                             <td>{{ $value->major }}</td>
                                          </tr>
                                          <tr>
                                             <td>{{ __('tutor.Start_Year') }}</td>
                                             <td>{{ $value->start_year }}</td>
                                          </tr>
                                          <tr>
                                             <td>{{ __('tutor.End_Year') }}</td>
                                             <td>{{ $value->end_year }}</td>
                                          </tr>
                                           @if(!empty($value->upload_file))
                                          <tr>
                                             <td>Upload File</td>
                                             <td>
                                               
                                    <a target="_black" href="{{ url('upload/qualification/'.$value->upload_file) }}">Download</a>
                                 
                                             </td>
                                          </tr>
                                          @endif
                                          <tr>
                                             <td>{{ __('tutor.Description') }}</td>
                                             <td><p>{!! $value->description !!}</p></td>
                                          </tr>
                                       </tbody>
                                    </table>
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