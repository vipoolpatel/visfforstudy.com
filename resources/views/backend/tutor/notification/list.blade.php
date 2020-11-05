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
<!-- start: breadcrumb area -->
<div class="breadcrumb-area">
   <div class="container">
      <div class="row">
         <div class="col-12">
            <div class="breadcrumb-items d-flex align-items-center">
               <span class="breadcrumb-trail">
               <a href="#" class="text-capitalize">Notification</a>
               </span>
            </div>
         </div>
      </div>
   </div>
</div>
<!-- end: breadcrumb area -->

<!-- start: main content -->
<div class="main-content withdraw-request-content">
   <div class="container">
      <div class="row">
         <div class="col-12">
            <!-- start: all offer content -->
            <section class="all-withdraw-request-section all-offer-section">
               <div class="all-course-view all-withdraw-request">
                  <div class="course-tabulation w-100">
                     <div class="tab-content all-course-list-box">
                        {{-- Start --}}
<div class="tab-pane in active pending-withdraw">
   <table class="all-course-table">
      <thead>
         <tr class="course-list-heading">
            <th>Message</th>
            <th>Action</th>
         </tr>
      </thead>
      <tbody>
      @forelse($getrecord as $value)
        @php
          $getdata = json_decode($value->data);
        @endphp

      <tr class="single-course-item">
         <td>{{ $getdata->message }}</td>
         <td class="action" data-title="Action">        
            <span class="action-btn-wrap">
                @if($getdata->type == 'course')
                  <a href="{{ url('tutor/course/view/'.$getdata->common_id) }}" class="button view-btn"><i class="far fa-eye"></i></a>
                @elseif($getdata->type == 'offer')
                  <a href="{{ url('tutor/offer/view/'.$getdata->common_id) }}" class="button view-btn"><i class="far fa-eye"></i></a>
                @elseif($getdata->type == 'offerbook')
                 <a href="{{ url('tutor/offer/view/'.$getdata->common_id) }}" class="button view-btn"><i class="far fa-eye"></i></a>
                @elseif($getdata->type == 'coursebook')
                 <a href="{{ url('tutor/lesson/view/'.$getdata->common_id) }}" class="button view-btn"><i class="far fa-eye"></i></a>
                @endif
            </span>
         </td>
      </tr>
      @empty
         <tr class="single-course-item">
            <td colspan="100%">Notification not found.</td>
         </tr>
      @endforelse

      </tbody>
   </table>

   <div style="clear: both;"></div>
   <div style="float: right;margin-top: 20px;">
        {{ $getrecord->appends(Illuminate\Support\Facades\Input::except('page'))->links() }}  
   </div>
   <div style="clear: both;"></div>
   <br />
        

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
{{-- @section('script')
<<script type="text/javascript"></script>
@endsection   --}}