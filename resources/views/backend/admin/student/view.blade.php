@extends('backend.layouts.app')
@section('content')
<div class="breadcrumb-area">
   <div class="container">
      <div class="row">
         <div class="col-6">
            <div class="breadcrumb-items d-flex align-items-center">
               <span class="breadcrumb-trail">
               <a href="#" class="text-capitalize">{{ __('admin.View_Student_Detail') }}</a>
               </span>
            </div>
         </div>
         <div class="col-6" style="text-align: right;">
            <a href="{{ url('admin/student') }}" class="btn btn-danger">{{ __('admin.Back') }}</a>
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
                                    <h5>{{ __('admin.View_Student_Detail') }}</h5>
                                    <br>
                                    <table class="table">
                                       <tbody>
                                          <tr>
                                             <td style="width: 30%">{{ __('admin.Student_Name') }}</td>
                                             <td class="teacher-name" data-title="Teacher name">
                                                <span class="info-wrap">
                                                @if($value->OnlineUser())
                                                <i class="fa fa-circle online-user"></i>
                                                @endif
                                                <span class="image">
                                                <img src="{!! $value->getImage() !!}" style="height: 50px;border-radius: 50%;" alt="{{ ucfirst(!empty($value->name)?$value->name: '') }}">
                                                </span>
                                                <span class="name">
                                                {{ ucfirst(!empty($value->name)?$value->name: '') }}
                                                {{ ucfirst(!empty($value->last_name)?$value->last_name: '') }}
                                                </span>
                                                </span>
                                             </td>
                                          </tr>
                                          <tr>
                                             <td>{{ __('admin.Email') }} </td>
                                             <td>
                                                {{ $value->email }}
                                             </td>
                                          </tr>
                                          <tr>
                                             <td>{{ __('admin.Category_Name') }} </td>
                                             <td>
                                                {{ ucfirst(!empty($value->getcategory->category_name) ? $value->getcategory->category_name : '') }}
                                             </td>
                                          </tr>
                                          <tr>
                                             <td>{{ __('admin.Level_of_Student') }} </td>
                                             <td>
                                                {{ ucfirst(!empty($value->getlevelofstudent->level_of_student_name) ? $value->getlevelofstudent->level_of_student_name: '') }}
                                             </td>
                                          </tr>
                                           <tr>
                                             <td>{{ __('admin.Language') }}</td>
                                             <td>
                                                @foreach($value->get_langauge as $key => $value_l)
                                                    {{ $value_l->getuserlanguage->language_name }} <br />
                                                @endforeach
                                             </td>
                                          </tr>
                                          <tr>
                                            <td>Country Name</td>
                                            <td>
                                            {{ ucfirst(!empty($value->getcountry->nicename) ? $value->getcountry->nicename : '') }}
                                            </td>
                                         </tr>
                                          <tr>
                                             <td>{{ __('admin.Status') }}</td>
                                             <td>
                                                @if($value->status == 1)
                                                <span style="color: green;">{{ __('admin.Active') }}</span>
                                                @elseif($value->status == 0)
                                                <span style="color: red;">{{ __('admin.Inactive') }}</span>
                                                @endif
                                             </td>
                                          </tr>
                                          <tr>
                                             <td>{{ __('admin.Created_Date') }}</td>
                                             <td>{{ date('Y-m-d h:i A',strtotime($value->created_at)) }}</td>
                                          </tr>
                                       </tbody>
                                    </table>
                                 </div>
                                 <div class="detail-tab-box course-description">
                                    <h6 class="label text-capitalize">{{ __('admin.Bio') }}</h6>
                                    <p>
                                       {!! $value->about_us !!}
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
