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
<!-- start: request filter/breadcrumb area -->
<div class="request-filter-area breadcrumb-area">
   <div class="container">
      <div class="row align-items-end justify-content-between flex-lg-nowrap">
         <div class="col-12 col-lg-auto col-xl-auto flex-grow-1 mb-3 mb-lg-0">
            <div class="title-and-status d-md-flex justify-content-between justify-content-lg-start align-items-center">
               <h3 class="page-title breadcrumb-trail">Contact us List</h3>
               
            </div>
         </div>
         <div class="col-12 col-lg-auto col-xl-auto flex-lg-fill">
            <div class="find-multi-search-box">
               <form action="" method="get" class="multi-search-form d-flex align-items-end justify-content-end">
                  <div class="input-group">
                     <div class="form-group">
                        <label for="lang-multi">Contact us ID</label>
                        <input type="text" name="id" value="{{ Request()->id }}" class="form-control" style="height: 35px;" placeholder="Contact us ID">
                     </div>

                     
                     <div class="form-group">
                        <label for="lang-multi">First Name</label>
                        <input type="text" name="first_name" value="{{ Request()->first_name }}" class="form-control" style="height: 35px;" placeholder="First Name">
                     </div>
                     <div class="form-group">
                        <label for="lang-multi">Email ID</label>
                        <input type="text" name="email" value="{{ Request()->email }}" class="form-control" style="height: 35px;" placeholder="Email ID">
                     </div>
                  </div>
                  <button type="submit" class="multi-search-submit d-inline-flex align-items-center justify-content-between">
                  <span class="btn-text">{{ __('admin.Search') }}</span>
                  <i class="fas fa-search"></i>
                  </button>

                     <a href="{{ url('admin/contact_us') }}" class="multi-search-submit d-inline-flex align-items-center justify-content-between" style="margin-left: 10px;color: #fff;">{{ __('admin.Reset') }}</a>
                     
               </form>
            </div>
         </div>
      </div>
   </div>
</div>
<!-- end: request filter/breadcrumb area -->
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
                                 <th>Contact us ID</th>
                                 <th>First Name</th>
                                 <th>Last Name</th>
                                 <th>Email ID</th>
                                 <th>Mobile No</th>
                                 <th>City Name</th>
                                 <th>Zip Code</th>
                                 <th>About us</th>
                                 <th>Created Date</th>
                                 <th>{{ __('admin.Action') }}</th>
                              </tr>
                           </thead>
                           <tbody>
                              @forelse($getrecord as $value)
                              <tr class="single-course-item">
                                 <td>{{ $value->id }}</td>
                                 <td>{{ $value->first_name }}</td>
                               
                                 <td>{{ $value->last_name }}</td>
                                 <td>{{ $value->email }}</td>
                                 <td>{{ $value->mobile_no }}</td>
                                 <td>{{ $value->city_name }}</td>
                                 <td>{{ $value->zip_code }}</td>
                                 <td>{{ $value->about_us }}</td>
                                <td>{{ date('d-m-Y h:i A', strtotime($value->created_at)) }}</td>
                                 <td class="action" data-title="Action">
                                    <span class="action-btn-wrap">
                                 

                                    <a onclick="delete_record('{{ url('admin/contact_us/delete/'.$value->id) }}')" class="button trash-btn"><i class="far fa-trash-alt"></i></a>


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
