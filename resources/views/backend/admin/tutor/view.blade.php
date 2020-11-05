@extends('backend.layouts.app')
@section('content')
<div class="breadcrumb-area">
   <div class="container">
      <div class="row">
         <div class="col-6">
            <div class="breadcrumb-items d-flex align-items-center">
               <span class="breadcrumb-trail">
               <a href="#" class="text-capitalize">{{ __('admin.View_Tutor_Detail') }}</a>
               </span>
            </div>
         </div>
         <div class="col-6" style="text-align: right;">
            <a href="{{ url('admin/tutor') }}" class="btn btn-danger">{{ __('admin.Back') }}</a>
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
                                    <h5>{{ __('admin.View_Tutor_Detail') }}</h5>
                                    <br>
<table class="table">
<tbody>
<tr>
<td style="width: 30%">{{ __('admin.Tutor_Name') }}</td>
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
<td>{{ ucfirst(!empty($value->getcategory->category_name) ? $value->getcategory->category_name : '') }}</td>
</tr>
<tr>
<td> {{ __('admin.Level_of_Teacher') }}</td>
<td>
{{ ucfirst(!empty($value->getlevelofstudent->level_of_student_name) ? $value->getlevelofstudent->level_of_student_name: '') }}
</td>
</tr>

<tr>
<td> {{ __('admin.Experience') }}</td>
<td>{{ $value->experience_of_teacher }} {{ __('admin.Years') }}</td>
</tr>

<tr>
<td> {{ __('admin.Price_For_Each_Lesson') }}</td>
<td>${{ $value->hour_per_rate }}</td>
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


<div class="detail-tab-box course-description">

<h6 class="label text-capitalize">{{ __('admin.Qualification') }}</h6>

<table class="table">
<thead>
<tr>
<th>{{ __('admin.University_Name') }}</th>
<th>{{ __('admin.Degree') }}</th>
<th>{{ __('admin.Major') }}</th>
<th>{{ __('admin.Start_Year') }}</th>
<th>{{ __('admin.End_Year') }}</th>
<th>Upload File</th>
<th>{{ __('admin.Description') }}</th>
</tr>
</thead>
<tbody>
@forelse($value->get_qulification as $row)
<tr>
<td>{{ $row->university_name }}</td>
<td>{{ $row->degree }}</td>
<td>{{ $row->major }}</td>
<td>{{ $row->start_year }}</td>
<td>{{ $row->end_year }}</td>
<td>@if(!empty($row->upload_file))
<a target="_black" href="{{ url('upload/qualification/'.$row->upload_file) }}">Download</a>
@endif</td>
<td width="30%">{{ $row->description }}</td>
</tr>
@empty
<tr class="single-course-item">
<td colspan="100%">{{ __('admin.Qulification_not_found') }}</td>
</tr>
@endforelse
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
