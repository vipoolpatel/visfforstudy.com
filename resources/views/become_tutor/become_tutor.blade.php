@extends('layouts.app')

@section('content')


	<!-- start: hero area -->
	<section class="hero-area">
		<div class="hero-bg" style="background-image: url({{ url('assets/img/banner-bg/banner-bg-7.jpg') }});"></div>
		<div class="hero-overlay"></div>
		<div class="container h-100">
			<div class="row align-items-center h-100">
				<!-- hero main content -->
				<div class="col-12 col-lg-7">
					<div class="hero-main-content">
						<h1 class="hero-title">{{ __('auth.Become_a_Tutor_in_EduVisffor') }}</h1>
						<p class="hero-description">
							{{ __('auth.Change_your_career_Whether_you') }}

						</p>
						<div class="hero-action-btn-box">
							<a href="#registrationFormSec" class="hero-action-btn register-btn scrolls">{{ __('auth.Registration_now') }}</a>
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
				<div class="col-12">
					<!-- start: registration features -->
					<section class="registration-features text-center">
						<div class="row">
							<div class="col-12 col-sm-6 col-lg-3 mb-4 mb-md-5 mb-lg-0">
								<div class="single-reg-feature">
									<div class="reg-feature-icon">
										<i class="far fa-address-card"></i>
									</div>
									<h3 class="reg-feature-label">
										{{ __('auth.Free_Registration') }}

									</h3>
								</div>
							</div>
							<div class="col-12 col-sm-6 col-lg-3 mb-4 mb-md-5 mb-lg-0">
								<div class="single-reg-feature">
									<div class="reg-feature-icon">
										<i class="fas fa-book-reader"></i>
									</div>
									<h3 class="reg-feature-label">
										{{ __('auth.Access_Thousands_of_Students_for_Free') }}

									</h3>
								</div>
							</div>
							<div class="col-12 col-sm-6 col-lg-3 mb-4 mb-sm-0">
								<div class="single-reg-feature">
									<div class="reg-feature-icon">
										<img src="{{ url('assets/img/iconic-free-course.png') }}" alt="course-icon">
									</div>
									<h3 class="reg-feature-label">
										{{ __('auth.Free_Online_Classes') }}

									</h3>
								</div>
							</div>
							<div class="col-12 col-sm-6 col-lg-3 mb-0 mb-sm-0">
								<div class="single-reg-feature">
									<div class="reg-feature-icon">
										<img src="{{ url('assets/img/iconic-payment.png') }}" alt="payment-icon">
									</div>
									<h3 class="reg-feature-label">
										{{ __('auth.Payment_Guaranteed_for_Each_Lecture') }}

									</h3>
								</div>
							</div>
						</div>
					</section>
					<!-- end: registration features -->

					<!-- start: registration form -->
					<section id="registrationFormSec" class="registration-form-sec">
						<div class="row justify-content-xl-between">
							<!-- registration form -->
							<div class="col-12 col-md-10 col-lg-5 col-xl-5">
								<div class="reg-form-sec-inner">
									<h3 class="reg-form-title">
									{{ __('auth.Registration_Here') }}
								</h3>
									<p class="reg-form-desc">
									{{ __('auth.After_register') }}
									</p>
									<form action="{{ url('become-tutor/add') }}" method="post" class="registration-form">
										{{ csrf_field() }}
										<div class="form-group">
											<label for="reg-fname">
												{{ __('auth.Your_Full_Name') }}
											</label>
											<input type="text" value="{{ old('name') }}" required name="name" class="reg-fname form-control" placeholder="{{ __('auth.Type_your_full_name') }}">
										</div>
										<div class="form-group">
											<label for="reg-email">{{ __('auth.Your_Email') }}</label>
											<input type="email" value="{{ old('email') }}" name="email" class="reg-email form-control" placeholder="{{ __('auth.Type_your_email') }}">
											<span style="color:red">{{  $errors->first('email') }}</span>
										</div>
										<div class="form-group">
											<label>Your Country Name</label>
											<select class="form-control" name="country_id" required>
												<option value="">Select Country Name</option>
													@foreach ($getcountry as $value_cou)
													<option value="{{ $value_cou->id }}">{{ $value_cou->getnicename() }}	</option>
													@endforeach
											</select>
										</div>
										<div class="form-group">
											<label for="reg-pass">{{ __('auth.Your_Password') }}</label>
											<input type="password" name="password" required class="reg-pass form-control" placeholder="{{ __('auth.Enter_a_password') }}">
										</div>
										<div class="form-group">
											<label for="reg-cpass">{{ __('auth.Confirm_Password') }}</label>
											<input type="password" name="confirm_password" class="reg-cpass form-control" placeholder="{{ __('auth.Re_enter_password') }}">
											<span style="color:red">{{  $errors->first('password') }}</span>
										</div>
										<div class="form-group">
											<label for="reg-verify">
												@php
												$firstNumber_acc = mt_rand(0, 9);
												$secondNumber_acc = mt_rand(0 ,9);
												echo $firstNumber_acc . ' + ' . $secondNumber_acc .' = ?';
										   	@endphp
											 </label>
											<input type="hidden" name="current_captcha" value="{{ $firstNumber_acc + $secondNumber_acc }}">
											<input type="text" name="CaptchaCode" class="reg-verify form-control" placeholder="{{ __('auth.Verification_code') }}" required>
											<span style="color:red">{{  $errors->first('CaptchaCode') }}</span>
							      </div>

										<button type="submit" class="reg-signup-btn">{{ __('auth.Sign_up') }}</button>
									</form>
								</div>
							</div>

							<div class="col-12 col-lg-7 col-xl-6 mt-5 mt-lg-0">
								<div class="reg-form-guide h-100 d-flex align-items-center">
									<div class="tabulation w-100">
										<ul class="nav nav-tabs">
											<li>
												<a data-toggle="tab" href="#howToTab" class="active">
									{{ __('auth.How_to_become_a_teacher') }}
											</a>
											</li>
											<li>
												<a data-toggle="tab" href="#rolesTab">
												{{ __('auth.Teacher_roles') }}
											</a>
											</li>
											<li><a data-toggle="tab" href="#paymentTab">
									{{ __('auth.Payment_roles') }}
											</a></li>
										</ul>
										<div class="tab-content">
											<div id="howToTab" class="tab-pane in active">
												<ul class="reg-form-guide-list">
													<li class="single-guide">

													{{ __('auth.Register_your_teacher_account_from_left_side') }}
													</li>
													<li class="single-guide">
														{{ __('auth.Join_the_online_Interview') }}

													</li>
													<li class="single-guide">

													{{ __('auth.Complete_your_profile_by') }}
													</li>
												</ul>
											</div>
											<div id="rolesTab" class="tab-pane">
												<ul class="reg-form-guide-list">
													<li class="single-guide">
													{{ __('auth.Teacher_role_one') }}
													</li>
													<li class="single-guide">

														{{ __('auth.Teacher_role_two') }}
													</li>
													<li class="single-guide">

														{{ __('auth.Teacher_role_three') }}
													</li>
												</ul>
											 </div>
											<div id="paymentTab" class="tab-pane">
												<ul class="reg-form-guide-list">
													<li class="single-guide">

										{{ __('auth.Payment_role_one') }}
													</li>
													<li class="single-guide">

													{{ __('auth.Payment_role_two') }}
													</li>
													<li class="single-guide">

														{{ __('auth.Payment_role_three') }}
													</li>
												</ul>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
					</section>
					<!-- end: registration form -->
				</div>
			</div>
		</div>
	</div>
	<!-- end: main content -->





@endsection
 {{-- @section('script')

         @endsection  --}}
