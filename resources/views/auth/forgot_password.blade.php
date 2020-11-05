@extends('auth.layouts.app')
{{-- @section('stylesheet')
<style type="text/css">
	
</style>
@endsection --}}

@section('content')


<!-- start: login section -->
	<section class="login-section">
		<div class="container-fluid">
			<div class="row">
				<div class="col-12">
					<div class="login-form-box">
						<h2 class="login-form-title">{{ __('auth.Forget_Password') }}</h2>
				
						<form action="{{ url('forgot_password/reset') }}" class="login-form" method="POST">
							{{ csrf_field() }}
							<div class="form-group">
								<input type="email" name="email" id="email" class="log-fname form-control" placeholder="{{ __('auth.Enter_Email') }}">
							</div>
							
							
							<button type="submit" value="submit" class="reg-signup-btn reg-login-btn">{{ __('auth.Forget_Password') }}</button>
						</form>
						<div class="fogot-pass-btn-box text-center">
							<a href="{{ url('login') }}" class="forgot-pass-link">Login</a>
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>
	<!-- end: login section -->
@endsection