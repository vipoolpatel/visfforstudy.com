@extends('backend.layouts.app')
@section('style')
<style type="text/css">
      .all-course-table tr > th {
            text-align: left;
      }
      .all-course-table tr > td {
            text-align: left;
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
               <h3 class="page-title breadcrumb-trail">Notes List</h3>
             
            </div>
         </div>
       
       {{-- Search box --}}
      </div>
   </div>
</div>
<!-- end: request filter/breadcrumb area -->



<!-- start: main content -->
<div class="main-content withdraw-request-content">
   <div class="container">
      <div class="row">
         <div class="col-12">
            <!-- start: all offer content -->
            <section class="all-withdraw-request-section all-offer-section">
               @include('message')
               <div class="all-course-view all-withdraw-request">
                  <div class="course-tabulation w-100">
                     <div class="tab-content all-course-list-box">
                        {{-- Start --}}
                        <div class="tab-pane in active pending-withdraw">
                           <table class="all-course-table">
                              <thead>
                                 <tr class="course-list-heading">
                                    <th>Note ID</th>
                                    <th>Title</th>
                                    <th>Message</th>
                                    <th>Note Date</th>
                                    <th>{{ __('admin.Created_Date') }}</th>
                                    <th>{{ __('admin.Action') }}</th>
                                 </tr>
                              </thead>
                              <tbody>
                                 @forelse($getrecord as $value)
                                 <tr class="single-course-item">
                                  
                                    <td>{{ $value->id}}</td>
                                    <td>{{ $value->title}}</td>
                                    <td>{{ $value->message}}</td>
                                    <td>{{ date('Y-m-d', strtotime($value->note_date)) }}</td>
                                   
                                    <td>{{ date('Y-m-d h:i A', strtotime($value->created_at)) }}</td>
                                    <td class="action" data-title="Action">
                                       <span class="action-btn-wrap">
                                       <a onclick="delete_record('{{ url('common/notes/delete/'.$value->id) }}')" class="button trash-btn"><i class="far fa-trash-alt"></i></a>


                                       </span>
                                    </td>
                                 </tr>
                                 @empty
                                 <tr  class="single-course-item">
                                    <td colspan="100%">{{ __('admin.Record_not_found') }}</td>
                                 </tr>
                                 @endforelse
                              </tbody>
                           </table>
                           <div style="float: right">
                              {{ $getrecord->appends(Illuminate\Support\Facades\Input::except('page'))->links() }}
                           </div>
                        </div>
                        {{-- End --}}
                     </div>
                  </div>
               </div>
            </section>
            <!-- end: all offer content -->
         </div>
      </div>
   </div>
</div>

@endsection

@section('script')
<script type="text/javascript">
  
</script>
@endsection