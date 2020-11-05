@extends('backend.layouts.app')
@section('style')
<style type="text/css">
   .all-course-table tr > th {
   text-align: left;
   }
   .all-course-table tr > td {
   text-align: left !important;
   }
   .small-btn 
   {
      padding: 1px 5px;font-size: 12px;line-height: 1.5;border-radius: 3px;
   }
    .modal-sm {
      max-width: 500px !important;
  }
  .form-group {
    margin-bottom: 5px;
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
  							<a href="#" class="text-capitalize">Tutor Earning Detail</a>
  						</span>
  					</div>
  				</div>
  			</div>
  		</div>
  	</div>
  	<!-- end: breadcrumb area -->



  	<!-- start: main content -->
  	<div class="main-content earning-content all-course-content">
  		<div class="container">
  			<div class="row">
  				<div class="col-12">
  					
            @if(Auth::user()->is_admin == 1)
            <section class="earning-section all-course-section">
              <div class="earning-stats text-center d-flex">
                 <h4><img style="height: 70px;border-radius: 50%;" src="{!! $user->getImage() !!}"> {{ $user->name }} {{ $user->last_name }}</h4>
              </div>
            </section>
            @endif
            

  					<section class="earning-section all-course-section">
 						<div class="earning-stats text-center d-flex">
  							<div class="single-stat">
  								<p class="label text-capitalize">Net income</p>
  								<h3 class="amount">${{ number_format($user->net_income,2) }}</h3>
  							</div>
  							<div class="single-stat">
  								<p class="label text-capitalize">Withdrawn</p>
  								<h3 class="amount">${{ number_format($user->withdrawn,2) }}</h3>
  							</div>
  							<div class="single-stat">
  								<p class="label text-capitalize">Pending Clearance</p>
  								<h3 class="amount">${{ number_format($user->PendingClearance(),2) }}</h3>
  							</div>
  							<div class="single-stat">
  								<p class="label text-capitalize">Available For Withdraw</p>
  								<h3 class="amount">${{ number_format($user->available_for_withdraw,2) }}</h3>
  							</div>
  						</div>
              @if(empty($earning))
  						<div class="withdraw-area d-md-flex align-items-center">
  							<h4 class="area-label withdraw-label">Withdraw</h4>
  							<div class="withdraw-options d-flex">
  								<div class="single-option">

                    @if(!empty($user->paypal))
                    <form action="{{ url('tutor/paypal/withdrawn') }}" method="post">
                      {{ csrf_field() }}
                       <button type="submit" class="withdraw-button paypal text-capitalize">
                        <span class="pg-icon"><img src="{{ url('assets/img/iconic-paypal-payment.png') }}" alt="paypal-icon"></span>
                        Paypal account
                      </button>
                    </form>
                    @else
                       <button type="button" class="withdraw-button paypal text-capitalize PaymentInfo">
                        <span class="pg-icon"><img src="{{ url('assets/img/iconic-paypal-payment.png') }}" alt="paypal-icon"></span>
                        Paypal account
                      </button>
                    @endif
                    

  								</div>
  								<div class="single-option">
  									<button type="button" class="withdraw-button local-bank text-capitalize BankTransfer">
  										<span class="pg-icon">
  											<img src="{{ url('assets/img/iconic-payoneer-payment.png') }}" alt="bank-icon">
  										</span>
  										Bank transfer
  									</button>
  								</div>
  							</div>
  						</div>
              @endif
{{-- 
  						<div class="show-filter-area d-md-flex align-items-center">
  							<h4 class="area-label filter-label">Show</h4>
  							<div class="filter-options d-flex flex-wrap flex-md-nowrap">
  								<div class="single-option type-option">
  									<select name="show-filter" id="show-filter">
  										<option selected>Everything</option>
  										<option>Withdrawn</option>
  										<option>Pending clearance</option>
  									</select>
  								</div>
  								<div class="single-option yearly-option">
  									<select name="year-filter" id="year-filter">
  										<option selected>2020</option>
  										<option>2019</option>
  										<option>2018</option>
  									</select>
  								</div>
  								<div class="single-option monthly-option">
  									<select name="month-filter" id="month-filter">
  										<option selected>All months</option>
  										<option>January</option>
  										<option>February</option>
  										<option>March</option>
  										<option>December</option>
  									</select>
  								</div>
  							</div>
  						</div> --}}

              <br />

  						<div class="all-course-view">
  							<div class="course-tabulation w-100">
                  
  								<div class="tab-content all-course-list-box">
                    <h4 style="margin-bottom: 10px;">Transaction History</h4>
  									<table class="all-course-table">
  										<thead>
  											<tr class="course-list-heading">
  												<th class="teacher-name">Student name</th>
  												<th class="course-title">Lesson title</th>
  												<th class="date-time">Date &amp; Time</th>
  												<th class="duration">Duration</th>
  												<th class="price">Amount</th>
  											</tr>
  										</thead>
  										<tbody>
                        @forelse($gettransaction as $value)
  											<tr class="single-course-item">
  												<td class="teacher-name" data-title="Student name">
  													<span class="info-wrap">
  														<span class="image">
  															<img src="{{ $value->getstudent->getImage() }}" alt="student-image">
  														</span>
  														<span class="name" style="text-transform: capitalize;">{{ !empty($value->getstudent->name) ? $value->getstudent->name : '' }} {{ !empty($value->getstudent->last_name) ? $value->getstudent->last_name : '' }}</span>
  													</span>
  												</td>
                          @if($value->type == 'offer')
                            <td class="course-title" data-title="Lesson title">{{ $value->getoffer->title }}</td>
                            <td class="date-time" data-title="Date &amp; Time">{{ date('Y-m-d h:i A',$value->getoffer->lesson_time) }}</td>
                            <td class="duration" data-title="Duration">{{ $value->getoffer->duration }} min</td>
                          @else
                            <td class="course-title" data-title="Lesson title">{{ !empty($value->getordercourse->getcourse->course_title) ? $value->getordercourse->getcourse->course_title : '' }}</td>
                            <td class="date-time" data-title="Date &amp; Time">{{ date('Y-m-d h:i A',$value->getordercourse->getlesson->lesson_time) }}</td>
                            <td class="duration" data-title="Duration">{{ $value->getordercourse->getlesson->duration }} min</td>
                          @endif
                          <td class="price" data-title="Price">${{ $value->amount }}</td>
												  
  											</tr>
                        @empty
                          <tr class="single-course-item">
                            <td colspan="100%">Not Transaction yet!</td>
                          </tr>                        
                        @endforelse

  										</tbody>
  									</table>

                      <div style="clear: both;"></div>
                        <div style="float: right;margin-top: 10px;">
                           {{ $gettransaction->appends(Illuminate\Support\Facades\Input::except('page'))->links() }}
                        </div>
                        <div style="clear: both;"></div>
                        <br />


  								</div>
  							</div>
  						</div>


              <div class="all-course-view">
                <div class="course-tabulation w-100">
                  
                  <div class="tab-content all-course-list-box">
                    <h4 style="margin-bottom: 10px;">Withdraw History</h4>
                    <table class="all-course-table">
                      <thead>
                        <tr class="course-list-heading">
                          <th class="teacher-name">Created Date</th>
                          <th class="teacher-name">Amount</th>
                          <th class="teacher-name">Payment Type</th>
                          <th class="price">Status</th>
                        </tr>
                      </thead>
                      <tbody>

                        @forelse($getwallettransaction as $row)
                        <tr class="single-course-item">
                            <td>{{ date('Y-m-d H:i A',strtotime($row->created_at)) }}</td>
                            <td>${{ number_format($row->amount,2) }}</td>
                            <td style="text-transform: capitalize;">{{ $row->payment_type }}</td>
                            <td><span style="color: {{ $row->getstatus->color_code  }};">{{ $row->getstatus->status_name  }}</span></td>

                        </tr>   
                        @empty
                          <tr class="single-course-item">
                            <td colspan="100%">Not Wallet Transaction yet!</td>
                          </tr>                        
                        @endforelse

                      </tbody>
                    </table>

                      <div style="clear: both;"></div>
                        <div style="float: right;margin-top: 10px;">
                           {{ $getwallettransaction->appends(Illuminate\Support\Facades\Input::except('page'))->links() }}
                        </div>
                        <div style="clear: both;"></div>
                        <br />


                  </div>
                </div>
              </div>

  					</section>
  					<!-- end: earning section -->
  				</div>
  			</div>
  		</div>
  	</div>
  	<!-- end: main content -->




<div class="modal fade" id="PaymentInfoModal" role="dialog">
  <div class="modal-dialog modal-sm">
    <div class="modal-content">
      <div class="modal-header">
         <h4 style="font-size: 20px;" class="modal-title">Paypal Account</h4>
         <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>
      <form action="{{ url('tutor/paypal/save') }}" method="post">
        {{ csrf_field() }}
          <div class="modal-body ">
             <label>Paypal Account ID</label>
             <input type="email" placeholder="Paypal Account ID" required class="form-control" value="{{ $user->paypal }}" name="paypal">
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
              <button type="submit" class="btn btn-danger">Submit</button>  
          </div>
    </form>
    </div>
  </div>
</div>


<div class="modal fade" id="BankTransferModal" role="dialog">
  <div class="modal-dialog modal-sm">
    <div class="modal-content">
      <div class="modal-header">
         <h4 style="font-size: 20px;" class="modal-title">Bank Account</h4>
         <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>
      <form action="{{ url('tutor/bank/save') }}" method="post">
        {{ csrf_field() }}
          <div class="modal-body ">

              <div class="form-group">
                 <label>Bank Name</label>
                 <input type="text" required class="form-control" placeholder="Bank Name" value="{{ $user->bank_name }}" name="bank_name">
              </div>

              <div class="form-group">
                 <label>Account Number</label>
                 <input type="text" required class="form-control" placeholder="Account Number" value="{{ $user->account_number }}" name="account_number">
              </div>

              <div class="form-group">
                 <label>Sort Code</label>
                 <input type="text" required class="form-control" placeholder="Sort Code" value="{{ $user->sort_code }}" name="sort_code">
              </div>

              <div class="form-group">
                 <label>Name on Card</label>
                 <input type="text" required class="form-control" placeholder="Name on Card" value="{{ $user->name_of_card }}" name="name_of_card">
              </div>

              

          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
              <button type="submit" class="btn btn-danger">Submit</button>  
          </div>
    </form>
    </div>
  </div>
</div>



@endsection

@section('script')

<script type="text/javascript">


  $('.BankTransfer').click(function(){
      $('#BankTransferModal').modal('show');
  });

  $('.PaymentInfo').click(function(){
      $('#PaymentInfoModal').modal('show');
  });

</script>

@endsection
