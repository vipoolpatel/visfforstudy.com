@extends('auth.layouts.app')
 {{-- @section('stylesheet')
<style type="text/css">

</style>
@endsection  --}}
@section('content')


	<!-- start: signup options -->
	<section class="signup-options-section">
		<div class="container-fluid">
			<div class="row">
				<div class="col-12">					
					<div class="signup-options text-center">
						<h2 class="signup-options-title">{{ __('auth.Sign_up') }}</h2>
						<p class="signup-options-desc">{{ __('auth.Please_choose_your_role_for_sign_up') }}</p>

						<div class="signup-roles d-flex justify-content-center">
							<a href="{{ url('become-student') }}" class="single-role student-role">
								<div class="signup-role-img">
									<img src="assets/img/student-studying.png" alt="student-studying">
								</div>
								<h2 class="signup-role-title text-capitalize">{{ __('auth.Student') }}</h2>
							</a>
							<a href="{{ url('become-tutor') }}" class="single-role teacher-role">
								<div class="signup-role-img">
									<img src="assets/img/tutor-at-board.png" alt="tutor-teaching">
								</div>
								<h2 class="signup-role-title text-capitalize">{{ __('auth.Teacher') }}</h2>
							</a>
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>
	<!-- end: signup options -->

	

@endsection
 {{-- @section('script')

         @endsection  --}}

