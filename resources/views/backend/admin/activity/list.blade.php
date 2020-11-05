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
               <h3 class="page-title breadcrumb-trail">Activity List</h3>
               <div class="status-search">
                  <p class="status-text">
                     <a href="{{ url('admin/activity/add') }}" style="margin-left: 10px;" class="btn btn-danger">Add new Activity</a>
                  </p>
               </div>
            </div>
         </div>
         <div class="col-12 col-lg-auto col-xl-auto flex-lg-fill">
            <div class="find-multi-search-box">
               <form action="" method="get" class="multi-search-form d-flex align-items-end justify-content-end">
                  <div class="input-group">
                     <div class="form-group">
                        <label for="lang-multi">Activity ID</label>
                        <input type="text" name="id" value="{{ Request()->id }}" class="form-control" style="height: 35px;" placeholder="Enter Activity ID">
                     </div>

                     
                     <div class="form-group">
                        <label for="lang-multi">Title</label>
                        <input type="text" name="title" value="{{ Request()->title }}" class="form-control" style="height: 35px;" placeholder="Enter a title">
                     </div>
                  </div>
                  <button type="submit" class="multi-search-submit d-inline-flex align-items-center justify-content-between">
                  <span class="btn-text">{{ __('admin.Search') }}</span>
                  <i class="fas fa-search"></i>
                  </button>

                     <a href="{{ url('admin/activity') }}" class="multi-search-submit d-inline-flex align-items-center justify-content-between" style="margin-left: 10px;color: #fff;">{{ __('admin.Reset') }}</a>
                     
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
               <div class="all-course-view">
                  <div class="course-tabulation w-100">
                     <div class="tab-content all-course-list-box">
                        <table class="all-course-table total-teacher-table">
                           <thead>
                              <tr class="course-list-heading">
                                 <th>Activity ID</th>
                                  @if (Auth::user()->is_admin == "4")
                                 <th>Staff Name</th>
                                 @endif
                                 <th>Title</th>
                                 <th>Description</th>
                                 <th>Created Date</th>
                                 <th>{{ __('admin.Action') }}</th>
                              </tr>
                           </thead>
                           <tbody>
                              @forelse($getrecord as $value)
                              
                              <tr class="single-course-item">
                                <td>{{ $value->id }}</td>
                                 @if (Auth::user()->is_admin == "4")
                              <td class="teacher-name" data-title="Teacher name">
                              <span class="info-wrap">
                              @if($value->getusers->OnlineUser())
                              <i class="fa fa-circle online-user"></i>
                              @endif
                              <span class="image">
                              <img src="{!! $value->getusers->getImage() !!}" alt="tutor-image">
                              </span>
                              <span class="name">
                              {{ ucfirst(!empty($value->getusers->name)?$value->getusers->name: '') }}
                              {{ ucfirst(!empty($value->getusers->last_name)?$value->getusers->last_name: '') }}
                              </span>
                              </span>
                              </td> 
                              @endif
                                 <td>{{ $value->title }}</td>
                                 <td>
                                {{ $value->description }}    
                                       
                                    
                                 </td> 
                                 <td>{{ date('Y-m-d h:i A', strtotime($value->created_at)) }}</td>
                              
                                  <td class="action" data-title="Action">
                                    <span class="action-btn-wrap">
                                    <a href="{{ url('admin/activity/edit/'.$value->id) }}" class="button error-btn">
                                    <i class="fas fa-edit"></i>
                                    </a>
                                  
                                    <a onclick="delete_record('{{ url('admin/activity/delete/'.$value->id) }}')" class="button trash-btn"><i class="far fa-trash-alt"></i></a>

                                 
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
{{-- @section('script')
<script>
  
   
</script>
@endsection
 --}}