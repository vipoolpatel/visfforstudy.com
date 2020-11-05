@extends('layouts.app')
 {{-- @section('stylesheet')
<style type="text/css">

</style>
@endsection  --}}
@section('content')

<!-- start: hero area -->
	<section class="hero-area">
		<div class="hero-bg" style="background-image: url({{ url('assets/img/banner-bg/banner-bg-5.jpg') }});"></div>
		<div class="hero-overlay"></div>
		<div class="container h-100">
			<div class="row align-items-lg-center h-100">
				<!-- hero main content -->
				<div class="col-12 h-100">
					<!-- hero main content -->
					<div class="hero-main-content">
						<h2 class="hero-title text-capitalize">
						{{ __('auth.Book_your_lesson') }}</h2>
						
						<div class="hero-booking-featuers">
							<ul class="lesson-booking-features reg-form-guide-list">
								<li class="single-booking-feature">
									{{ __('auth.Satisfaction_guarantee') }}
									
								</li>
								<li class="single-feature">
									{{ __('auth.Security_your_payment') }}	
								
								</li>
								<li class="single-feature">
								
									{{ __('auth.You_will_not_pay_to') }}	
								</li>
							</ul>
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>
	<!-- end: hero area -->



	<!-- start: main content -->
	<div id="main-content" class="main-content">
		<div class="container">
			<div class="row">
				<div class="col-lg-12">
					<!-- start: booking section -->
					<section class="booking-section">
						<div class="row">
							<div class="col-lg-10 col-xl-8">
								<div class="find-multi-search-box booking-form-container">
									<form action="{{ url('book_order_course') }}" method="post" class="booking-form">
										{{ csrf_field() }}
										<input type="hidden" name="user_id" id="user_id" value="{{ $user_id }}">
										<div class="multi-search-form d-flex align-items-end">
											<div class="input-group">
												<div class="form-group">
													<label>{{ __('auth.Category') }}</label>
													<select name="category_id" id="category_id" required class="subject-multi form-control">
														<option value="">{{ __('auth.Select_Category') }}</option>
														@foreach($getcategory as $value_c)
														<option value="{{ $value_c->id }}">{{ $value_c->category_name }}</option>
														@endforeach
													</select>
												</div>
												<div class="form-group">
													<label>{{ __('auth.What_Subject_You') }}	</label>
													<select name="subject_id" id="subject_id" required class="subject-multi form-control">
														<option value="">Selct Subject</option>
													</select>
												</div>
												<div class="form-group">
													<label>{{ __('auth.What_the_Aim_for_Your_Booking') }}</label>
													<select name="booking_id" required class="book-aim-multi form-control">
														<option value="">Select</option>
														@foreach($getBooking as $value_b)
														<option value="{{ $value_b->id }}">{{ $value_b->booking_name }}</option>
														@endforeach

													</select>
												</div>
												<div class="form-group">
													<label>{{ __('auth.Whats_Your_Level') }}</label>
													<select name="level_of_student_id" required class="level-multi form-control">
														<option value="">{{ __('auth.Select_Level') }}</option>
														@foreach($getlevel as $value_l)
														<option value="{{ $value_l->id }}">{{ $value_l->level_of_student_name }}</option>
														@endforeach
													</select>
												</div>
											</div>
										</div>

										<div class="book-form-check custom">
											<h5 class="label">
											{{ __('auth.What_type_of_lesson_do_you_need') }}</h5>
											@foreach($getrequesttype as $value)
												<div class="form-group d-inline-flex align-items-center mb-0 mr-4">
													<input type="radio" name="lesson_type_id" required id="book-check-regular{{ $value->id }}" class="reg-check form-check-input" value="{{ $value->id }}" >
													<label for="book-check-regular{{ $value->id }}" class="form-check-label">
														{{ $value->request_type_name }}
													</label>
												</div>
											@endforeach
										</div>

										{{-- <div class="custom-date-picker">
											<div id="date-lesson-box" class="date-picker-box">
												<input type="text" name="book-sesson-date" id="book-sesson-date" class="book-date" placeholder="Pick a Date">
											</div>
										</div> --}}

										<div id="getCourseDate"></div>

										<div id="getCourseTime"></div>

										<div class="book-form-check custom">
											<h5 class="label">Price For Each Lesson : $<span id="lesson_per_rate">0.00</span></h5>
										</div>
						
										<div class="text-message">
											<div class="form-group">
												<label for="booking-message">{{ __('auth.What_do_you_want_to_learn') }}</label>
												<textarea name="description" required id="booking-message" class="booking-message form-control" placeholder="{{ __('auth.Type_here') }}" cols="10" rows="5"></textarea>
											</div>
										</div>

										<button type="submit" class="booking-submit-btn reg-signup-btn text-capitalize">{{ __('auth.Book_Now') }}</button>
									</form>									
								</div>
							</div>
						</div>
					</section>
					<!-- end: booking section -->
				</div>
			</div>
		</div>
	</div>
	<!-- end: main content -->


 


@endsection
@section('script')
<script type="text/javascript">
	$(document).ready(function(){

		$('body').delegate('.lesson_date_id','change',function(){
			var lesson_date_id = $(this).val();
			var user_id = $('#user_id').val();
			$.ajax({
		         url: "{{ url('getCourseTime') }}",
		         type: "POST",
		         data:{
		           "_token": "{{ csrf_token() }}",
		             lesson_date_id:lesson_date_id,
		             user_id:user_id
		          },
		          dataType:"json",
		          success:function(response){
            			$('#getCourseTime').html(response.success);
		          },
	        });		

		});
		

		$('#subject_id').change(function() {
			getdate();
		});

		function cleardata() {
			$('#getCourseDate').html('');
    		$('#getCourseTime').html('');
		}

		function getdate() {
			cleardata();
			var subject_id = $('#subject_id').val();
			var user_id = $('#user_id').val();
			$.ajax({
		         url: "{{ url('getCourseDate') }}",
		         type: "POST",
		         data:{
		           "_token": "{{ csrf_token() }}",
		             subject_id:subject_id,
		             user_id:user_id
		          },
		          dataType:"json",
		          success:function(response){
            			$('#getCourseDate').html(response.success);
            			$('#lesson_per_rate').html(response.lesson_per_rate);
            			
		          },
	        });		
		}





		$('#category_id').change(function() {
			var category_id = $(this).val();
			var user_id = $('#user_id').val();
			$.ajax({
		         url: "{{ url('getBookLessonSubjectCategory') }}",
		         type: "POST",
		         data:{
		           "_token": "{{ csrf_token() }}",
		             category_id:category_id,
		             user_id:user_id,
		          },
		          dataType:"json",
		          success:function(response){
              		$('#subject_id').html(response.success);
              		cleardata();
		          },
	        });		
		});


	});   
</script>
@endsection 