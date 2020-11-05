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




  	<!-- start: breadcrumb area -->
  	<div class="breadcrumb-area">
  		<div class="container">
  			<div class="row">
  				<div class="col-12">
  					<div class="breadcrumb-items d-flex align-items-center">
  						<span class="breadcrumb-trail">
  							<a href="#" class="text-capitalize">Withdraw request</a>
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
  									
  										<table class="all-course-table">
  											<thead>
  												<tr class="course-list-heading">
  													<th class="teacher-name">Teacher name</th>
  													<th class="invoice-num">Invoice number</th>
  													<th class="balance">Amount</th>
                            <th class="balance">Payment Detail</th>
  													<th class="date-time">Request Date & Time</th>
                            <th class="date-time">Approved / Rejected By</th>
                            <th class="date-time">Status</th>
  													<th class="action">Action</th>
  												</tr>
  											</thead>
  											<tbody>
                          @forelse($getrecord as $value)
  												<tr class="single-course-item">
  													<td class="teacher-name" data-title="Teacher name">
  														<span class="info-wrap">
  															<span class="image">
  																<img src="{!! $value->getuser->getImage() !!}" alt="teacher-image">
  															</span>
  															<span class="name" style="text-transform: capitalize;">{!! $value->getuser->name !!} {!! $value->getuser->last_name !!}</span>
  														</span>
  													</td>
  													<td class="invoice-num" data-title="Invoice number">{{ $value->id }}</td>
  													<td class="balance" data-title="Teacher balance">${!! number_format($value->amount,2) !!}</td>

                            <td class="balance" style="text-transform: capitalize;">
                              @if($value->payment_type == 'bank')
                                  <b>Bank Name:</b> {{ $value->bank_name }} <br />
                                  <b>Account Number:</b> {{ $value->account_number }} <br />
                                  <b>Sort Code:</b> {{ $value->sort_code }} <br />
                                  <b>Name on Card:</b> {{ $value->name_of_card }} <br />
                              @endif
                              @if($value->payment_type == 'paypal')
                                  Paypal : {{ $value->paypal_id }}
                              @endif
                              

                            </td>

  													<td class="date-time" data-title="Request Date &amp; Time">{!! date('Y-m-d H:i A',strtotime($value->created_at)) !!}</td>

                          <td class="author teacher-name" data-title="Approved by">
                            @if(!empty($value->getadmin))
                            <span class="info-wrap">
                              <span class="image">
                                <img src="{{ url($value->getadmin->getImage()) }}" alt="author-image">
                              </span>
                              <span class="name" style="text-transform: capitalize;">{{ $value->getadmin->name }} {{ $value->getadmin->last_name }}</span>
                            </span>
                            @endif
                          </td>
                          <td>
                            <span style="color: {{ $value->getstatus->color_code }}">{{ $value->getstatus->status_name }}</span>
                          </td>

  													<td class="action" data-title="Action">
  														<span class="action-btn-wrap">
                                @if($value->status == 1)
  															<a style="cursor: pointer;" onclick="approve_record('{{ url('admin/earning/approve/'.$value->id) }}')"  class="button ok-btn">
                                  <i class="fas fa-check"></i>
                                </a>
                                <a style="cursor: pointer;" onclick="reject_record('{{ url('admin/earning/reject/'.$value->id) }}')" class="button cancel-btn">
                                  <i class="fas fa-times"></i>
                                </a>
                                @endif

                                <a href="{{ url('admin/earning/'.$value->user_id) }}" class="button view-btn">
                                  <i class="far fa-eye"></i>
                                </a>
  															<a href="{{ url('admin/send_mssage/'.$value->user_id) }}" class="button mail-btn">
  																<i class="far fa-envelope"></i>
  															</a>
  															
  														</span>
  													</td>
  												</tr>
                          @empty
                          <tr class="single-course-item">
                            <td colspan="100%">Withdraw request not found.</td>
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
  							</div>
  						</div>
  					</section>
  					<!-- end: all offer content -->
  				</div>
  			</div>
  		</div>
  	</div>
  	<!-- end: main content -->


@endsection
