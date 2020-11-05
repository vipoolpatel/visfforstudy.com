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
               <h3 class="page-title breadcrumb-trail">Report List</h3>
               
            </div>
         </div>
         <div class="col-12 col-lg-auto col-xl-auto flex-lg-fill">
            <div class="find-multi-search-box">
               <form action="" method="get" class="multi-search-form d-flex align-items-end justify-content-end">
                  <div class="input-group">
                      <div class="form-group">
                        <label for="lang-multi">Report ID</label>
                        <input type="text" name="id" value="{{ Request()->id }}" class="form-control" style="height: 35px;" placeholder="Report ID">
                     </div>

                <div class="form-group">
                <label for="level-multi">Sender Name</label>
                <select name="sender_id" class="level-multi form-control">
                    <option value="">Select Sender Name</option>
                    @foreach ($getuser as $row)
                        <option value="{{ $row->id }}" {{ ( $row->id ==  Request()->sender_id) ? 'selected' : '' }} >{{ $row->name }}</option>
                    @endforeach
                </select>
                </div>   
                     
                  </div>
                  <button type="submit" class="multi-search-submit d-inline-flex align-items-center justify-content-between">
                     <span class="btn-text">{{ __('admin.Search') }}</span>
                     <i class="fas fa-search"></i>
                  </button>
                  <a href="{{ url('admin/report') }}" class="multi-search-submit d-inline-flex align-items-center justify-content-between" style="margin-left: 10px;color: #fff;">{{ __('admin.Reset') }}</a>
               </form>
            </div>
         </div>
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
                                    <th>Report ID</th>
                                    <th>Sender Name</th>
                                    <th>Receiver Name</th>
                                    <th>Message</th>
                                    <th>{{ __('admin.Created_Date') }}</th>
                                    <th>{{ __('admin.Action') }}</th>
                                 </tr>
                              </thead>
                              <tbody>
                                 @forelse($getrecord as $value)
                                 <tr class="single-course-item">
                                    <td>{{ $value->id}}</td>
<td class="teacher-name" data-title="Teacher name">
    <span class="info-wrap">
    @if($value->getsender->OnlineUser())
    <i class="fa fa-circle online-user"></i>
    @endif
    <span class="image">
    <img src="{!! $value->getsender->getImage() !!}" alt="tutor-image">
    </span>
    <span class="name">
        {!! $value->getsender->name !!} {!! $value->getsender->last_name !!}
    
    </span>
    </span>
</td>
<td class="teacher-name" data-title="Teacher name">
    <span class="info-wrap">
    @if($value->getreceiver->OnlineUser())
    <i class="fa fa-circle online-user"></i>
    @endif
    <span class="image">
    <img src="{!! $value->getreceiver->getImage() !!}" alt="tutor-image">
    </span>
    <span class="name">
      
        {!! $value->getreceiver->name !!} {!! $value->getreceiver->last_name !!}
    </span>
    </span>
</td>
                                   
                                    
                                    <td>{{ $value->reason}}</td>
                                   
                                    <td>{{ date('Y-m-d h:i A', strtotime($value->created_at)) }}</td>
                                
    <td class="action" data-title="Action">
        <span class="action-btn-wrap">
        
        <a onclick="delete_record('{{ url('admin/report/delete/'.$value->id) }}')" class="button trash-btn"><i class="far fa-trash-alt"></i></a>

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