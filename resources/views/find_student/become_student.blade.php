@extends('layouts.app')

@section('content')

	<!-- start: hero area -->
	<section class="hero-area">
		<div class="hero-bg" style="background-image: url(assets/img/banner-bg/banner-bg-7.jpg);"></div>
		<div class="hero-overlay"></div>
		<div class="container h-100">
			<div class="row align-items-center h-100">
				<!-- hero main content -->
				<div class="col-12 col-lg-7">
					<div class="hero-main-content">
						<h1 class="hero-title">{{ __('auth.Become_a_Student_in_EduVisffor') }}</h1>
						<p class="hero-description">
							{{ __('auth.Get_verified_Teacher_in_visffor') }}
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
										<img src="assets/img/iconic-teacher.png" alt="teacher-icon">
									</div>
									<h3 class="reg-feature-label">

										{{ __('find_student.Find_a_Tutor') }}
									</h3>
								</div>
							</div>
							<div class="col-12 col-sm-6 col-lg-3 mb-4 mb-md-5 mb-lg-0">
								<div class="single-reg-feature">
									<div class="reg-feature-icon">
										<i class="far fa-user"></i>
									</div>
									<h3 class="reg-feature-label">

										{{ __('find_student.Book_the_Tutor') }}
									</h3>
								</div>
							</div>
							<div class="col-12 col-sm-6 col-lg-3 mb-4 mb-sm-0">
								<div class="single-reg-feature">
									<div class="reg-feature-icon">
										<img src="assets/img/iconic-free-course.png" alt="course-icon">
									</div>
									<h3 class="reg-feature-label">

				{{ __('find_student.Free_Online_Classroom') }}
									</h3>
								</div>
							</div>
							<div class="col-12 col-sm-6 col-lg-3 mb-0 mb-sm-0">
								<div class="single-reg-feature">
									<div class="reg-feature-icon">
										<img src="assets/img/iconic-book-open.png" alt="open-book-icon">
									</div>
									<h3 class="reg-feature-label">
{{ __('find_student.All_Learning_Materials_Provided_by_Tutors_for_Free') }}

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
									<h3 class="reg-form-title">{{ __('find_student.Registration_Here') }}</h3>
									<p class="reg-form-desc">

										{{ __('find_student.After_register') }}
									</p>
									<form action="{{ url('become-student/add') }}" method="post" class="registration-form">
											{{ csrf_field() }}
										<div class="form-group">
											<label for="reg-fname">
											{{ __('find_student.Your_Full_Name') }}</label>
											<input type="text" name="name" required value="{{ old('name') }}" class="reg-fname form-control" placeholder="{{ __('find_student.Type_your_full_name') }}">
										</div>
										<div class="form-group">
											<label for="reg-email">
											{{ __('find_student.Your_Email') }}
											</label>
											<input type="email" value="{{ old('email') }}" name="email" class="reg-email form-control" placeholder="{{ __('find_student.Type_your_email') }}">
											<span style="color: red;">{{ $errors->first('email') }}</span>
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
											<label for="reg-pass">{{ __('find_student.Your_Password') }}</label>
											<input type="password" name="password" class="reg-pass form-control" placeholder="{{ __('find_student.Enter_a_password') }}">
										</div>
										<div class="form-group">
											<label for="reg-cpass">

											{{ __('find_student.Confirm_Password') }}</label>
											<input type="password" name="confirm_password" class="reg-cpass form-control" placeholder="{{ __('find_student.Re_enter_password') }}">
											<span style="color: red;">{{ $errors->first('password') }}</span>
										</div>
<div class="form-group">
	<label for="reg-verify">
		@php
		$firstNumber_acc = mt_rand(0, 9);
		$secondNumber_acc = mt_rand(0, 9);
		echo $firstNumber_acc . ' + ' . $secondNumber_acc .' = ?';
		@endphp
	</label>
	<input type="hidden" name="current_captcha" value="{{ $firstNumber_acc + $secondNumber_acc }}"/>
	<input type="text" name="CaptchaCode" class="reg-verify form-control" placeholder="{{ __('find_student.Verification_code') }}">
	<span style="color: red;">{{ $errors->first('CaptchaCode') }}</span>
</div>

										<button type="submit" class="reg-signup-btn">{{ __('find_student.Sign_up') }}</button>
									</form>
								</div>
							</div>

							<div class="col-12 col-lg-7 col-xl-6 mt-5 mt-lg-0">
								<div class="reg-form-guide h-100 d-flex align-items-center">
									<div class="tabulation w-100">
										<ul class="nav nav-tabs">
											<li>
												<a data-toggle="tab" href="#howToTab" class="active">
{{ __('find_student.How_to_become_a_Student') }}
												</a>
											</li>
											<li>
												<a data-toggle="tab" href="#rolesTab">
{{ __('find_student.Student_roles') }}
												</a>
											</li>
											<li><a data-toggle="tab" href="#paymentTab">
{{ __('find_student.Payment_roles') }}
											</a></li>
										</ul>
										<div class="tab-content">
											<div id="howToTab" class="tab-pane in active">
												<ul class="reg-form-guide-list">
													<li class="single-guide">
	{{ __('find_student.Register_your_account_on_website') }}

													</li>
													<li class="single-guide">
		{{ __('find_student.Browse_thousands_of_teachers_according_to_your_demands') }}

													</li>

													<li class="single-guide">
{{ __('find_student.Book_the_teachers') }}

													</li>
												</ul>
											</div>
											<div id="rolesTab" class="tab-pane">
												<ul class="reg-form-guide-list">
													<li class="single-guide">
	{{ __('find_student.Student_role_one') }}

													</li>
													<li class="single-guide">
	{{ __('find_student.Student_role_two') }}

													</li>
													<li class="single-guide">
	{{ __('find_student.Student_role_three') }}

													</li>
												</ul>
											 </div>
											<div id="paymentTab" class="tab-pane">
												<ul class="reg-form-guide-list">
													<li class="single-guide">
	{{ __('find_student.Payment_role_one') }}

													</li>
													<li class="single-guide">
		{{ __('find_student.Payment_role_two') }}

													</li>
													<li class="single-guide">
{{ __('find_student.Payment_role_three') }}

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
