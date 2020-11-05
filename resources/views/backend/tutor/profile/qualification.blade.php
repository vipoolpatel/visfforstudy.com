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
                   {{ __('tutor.Qualification_List') }}
               </h3>
            </div>
         </div>
         <div class="col-12 col-lg-auto col-xl-auto flex-lg-fill" style="text-align: right;">
            <div class="admin-search-box">
                <a href="{{ url('tutor/qualification/add') }}" style="margin-left: 10px;" class="btn btn-danger"> {{ __('tutor.Add_new_Qualification') }}</a>
            </div>
         </div>
      </div>
   </div>
</div>




<div class="main-content all-course-content">
   <div class="container">
      <div class="row">
         <div class="col-12">
            <section class="all-course-section">
               @include('message')
               <div class="all-course-view">
                  <div class="course-tabulation w-100">
                     <div class="tab-content all-course-list-box">
                        <table class="all-course-table">
                           <thead>
                              <tr class="course-list-heading">
                                 <th>{{ __('tutor.University_Name') }}</th>
                                 <th>{{ __('tutor.Degree') }}</th>
                                 <th>{{ __('tutor.Major') }}</th>
                                 <th>{{ __('tutor.Start_Year') }}</th>
                                 <th>{{ __('tutor.End_Year') }}</th>
                                 <th>Upload File</th>
                                 <th>{{ __('tutor.Action') }}</th>
                              </tr>
                           </thead>
                           <tbody>
                              @forelse($value->get_qulification as $row)
                              <tr class="single-course-item">
                                 <td>{{ $row->university_name }}</td>
                                 <td>{{ $row->degree }}</td>
                                 <td>{{ $row->major }}</td>
                                 <td>{{ $row->start_year }}</td>
                                 <td>{{ $row->end_year }}</td>
                                 <td>
                                 @if(!empty($row->upload_file))
                                    <a target="_black" href="{{ url('upload/qualification/'.$row->upload_file) }}">Download</a>
                                 @endif
</td>

<td class="action" data-title="Action">
   <span class="action-btn-wrap">
      <a href="{{ url('tutor/qualification/view/'.$row->id) }}" class="button view-btn"><i class="far fa-eye"></i></a>
      <a href="{{ url('tutor/qualification/edit/'.$row->id) }}" class="button error-btn"> <i class="fas fa-edit"></i></a>
      <a href="{{ url('tutor/qualification/delete/'.$row->id) }}" class="button trash-btn"><i class="far fa-trash-alt"></i></a>
   </span>
</td>

                              </tr>                              
                              @empty
                              <tr class="single-course-item">
                                 <td colspan="100%">
{{ __('tutor.Qualification_not_found') }}
                                 </td>
                              </tr>                              
                              @endforelse

                           </tbody>
                        </table>
                       
                     </div>
                  </div>
               </div>
            </section>
         </div>
      </div>
   </div>
</div>
@endsection