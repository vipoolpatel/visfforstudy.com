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
                                    <th>User ID</th>
                                    <th>Name</th>
                                    <th>Type</th>
                                    <th>Message</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                 </tr>
                              </thead>
                              <tbody>

                                @forelse($getrecord as $value)
                                @php
                                  $getdata = json_decode($value->data);
                                @endphp
                                <tr>
                                  <td>{{ $value->notifiable_id }}</td>
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
                                  <td style="text-transform: capitalize;">
                                    @if($getdata->type == 'coursebook')
                                        Course Booked
                                    @elseif($getdata->type == 'offerbook')
                                        Offer Booked
                                    @else
                                      {{ $getdata->type }}
                                    @endif
                                  </td>
                                  <td>{{ $getdata->message }}</td>
                                  <td>
                                    @if($getdata->type == 'request')
                                      @php
                                      $value_r = App\Models\RequestModel::get_single($getdata->common_id);
                                      @endphp

                                      <select class="form-control ChangeRequestStatus" id="{{ $value_r->id }}" style="width: 150px;">
                                        @foreach ($getstatus as $value_s)
                                         <option {{ ($value_s->id == $value_r->status) ? 'selected' : '' }} value="{{ $value_s->id }}">{{ $value_s->getstatusname() }}</option>
                                         @endforeach
                                     </select>

                                    @elseif($getdata->type == 'offer')

                                     @php
                                      $value_o = App\Models\OfferModel::get_single($getdata->common_id);
                                      @endphp

                                     <select class="form-control ChangeOfferStatus" id="{{ $value_o->id }}" style="width: 150px;">
                                       @foreach ($getstatus as $value_s)
                                       <option {{ ($value_s->id == $value_o->status) ? 'selected' : '' }} value="{{ $value_s->id }}">{{ $value_s->getstatusname() }}</option>
                                       @endforeach
                                    </select>


                                    @elseif($getdata->type == 'course')
                                      @php
                                      $value_c = App\Models\CourseModel::get_single($getdata->common_id);
                                      @endphp

                                     <select class="form-control ChangeStatus" id="{{ $value_c->id }}" style="width: 150px;">
                                          @foreach ($getstatus as $value_s)
                                           <option {{ ($value_s->id == $value_c->status) ? 'selected' : '' }} value="{{ $value_s->id }}">{{ $value_s->getstatusname() }}</option>
                                           @endforeach                                            
                                     </select>

                                    @elseif($getdata->type == 'offerbook')
                                      Booked
                                    @elseif($getdata->type == 'coursebook')
                                      Booked
                                    @endif
                                  </td>
                                   <td class="action" data-title="Action">        
                                    <span class="action-btn-wrap">
                                    @if($getdata->type == 'request')
                                         <a href="{{ url('admin/request/view/'.$getdata->common_id) }}" class="button view-btn"><i class="far fa-eye"></i></a>
                                         
                                    @elseif($getdata->type == 'offer')

                                     <a href="{{ url('admin/offer/view/'.$getdata->common_id) }}" class="button view-btn"><i class="far fa-eye"></i></a>

                                    @elseif($getdata->type == 'course')

                                     <a href="{{ url('admin/course/view/'.$getdata->common_id) }}" class="button view-btn"><i class="far fa-eye"></i></a>

                                    @elseif($getdata->type == 'offerbook')

                                        <a href="{{ url('admin/offer/view/'.$getdata->common_id) }}" class="button view-btn"><i class="far fa-eye"></i></a>

                                    @elseif($getdata->type == 'coursebook')

                                      <a href="{{ url('admin/lesson/view/'.$getdata->common_id) }}" class="button view-btn"><i class="far fa-eye"></i></a>

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

@section('script')
   <script type="text/javascript">
         $('.ChangeRequestStatus').change(function(){
            var id = $(this).attr('id');
            var status = $(this).val();
            $.ajax({
               type: 'GET',
               url:"{{url('admin/request/change_request_status')}}",
               data: {id:id,status:status},
               dataType: 'JSON',
               success:function(data){
                 alert(data.success);
               }
            });
         });


   $('.ChangeStatus').change(function(){
       var id = $(this).attr('id');
       var status = $(this).val();
       $.ajax({
          type: 'GET',
          url:"{{url('admin/course/change_status')}}",
          data: {id:id,status:status},
          dataType: 'JSON',
          success:function(data){
            alert(data.success);
          }
       });
    });


    $('.ChangeOfferStatus').change(function(){
      var id = $(this).attr('id');
      var status = $(this).val();
      $.ajax({
         type: 'GET',
         url:"{{url('admin/offer/change_offer_status')}}",
         data: {id:id,status:status},
         dataType: 'JSON',
         success:function(data){
           alert(data.success);
         }
      });
   });


   </script>
@endsection

