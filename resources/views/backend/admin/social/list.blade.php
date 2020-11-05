@extends('backend.layouts.app')
@section('style')
<style type="text/css">
      .all-course-table tr > th {
            text-align: left;
      }
      .all-course-table tr > td {
            text-align: left !important;
      }
</style>
@endsection 
@section('content')



<div class="admin-filter-area request-filter-area breadcrumb-area">
<div class="container">
      <div class="row align-items-end justify-content-between flex-lg-nowrap">

            <div class="col-12 col-lg-auto col-xl-auto flex-grow-1 mb-3 mb-lg-0">
                  <div class="title-and-status d-md-flex justify-content-between justify-content-lg-start align-items-center">
                        <h3 class="page-title breadcrumb-trail">
                           {{ __('admin.Social_List') }} 
                        </h3>

                        
                  </div>
            </div>
          
        </div>
    </div>
</div>




      <!-- start: main content -->
<div class="main-content all-course-content">
      <div class="container">
            <div class="row">
                  <div class="col-12">
<!-- start: all course content -->
<section class="all-course-section admin-total-user-section">
@include('message')
<div class="all-course-view">
<div class="course-tabulation w-100">
<div class="tab-content all-course-list-box">
<table class="all-course-table total-teacher-table">
<thead>
<tr class="course-list-heading">
<th>  {{ __('admin.Icon_name') }} </th>
<th>  {{ __('admin.Social_Link') }}</th>

<th> {{ __('admin.Action') }}</th>
</tr>
</thead>
<tbody>

@forelse($getrecord as $value)


<tr class="single-course-item">

<td><i class="{{ $value->icon_name }}"></i></td>
<td>{{ $value->social_link }}</td>


<td class="action" data-title="Action">
<span class="action-btn-wrap">
<a href="{{ url('admin/social-icon/edit/'.$value->id) }}" class="button error-btn">
<i class="fas fa-edit"></i>
</a>


<a onclick="delete_record('{{ url('admin/social-icon/delete/'.$value->id) }}')" class="button trash-btn"><i class="far fa-trash-alt"></i></a>

</span>
</td>
</tr>
@empty
<tr class="single-course-item">
<td colspan="100%">{{ __('admin.Record_not_found') }}</td>

</tr>
@endforelse

</tbody>
</table>
<div style="clear: both;"></div>
<div style="float: right;margin-top: 20px;">
{{ $getrecord->appends(Illuminate\Support\Facades\Input::except('page'))->links() }}  
</div>

</div>
</div>
</div>

</section>
<!-- end: all course content -->
</div>
</div>
</div>
</div>
<!-- end: main content -->




@endsection
