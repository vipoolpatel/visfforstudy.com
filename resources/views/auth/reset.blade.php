@extends('auth.layouts.app')
 @section('stylesheet')
<style type="text/css">
	.required {
		color: red;
	}
</style>
@endsection 
@section('content')


	<section class="login-section">
		<div class="container-fluid">
			<div class="row">
				<div class="col-12">
					<div class="login-form-box">
						<h2 class="login-form-title">Reset Password</h2>
				
						<form action="" class="login-form" method="POST">
							{{ csrf_field() }}
							<div class="form-group">
								<input type="password" name="password" class="log-fname form-control" required  placeholder="Password" >
								<div class="required">{{$errors->first('password')}}</div>
							</div>
							<div class="form-group">
								<input type="password" name="confirm_password" class="log-fname form-control" required  placeholder="Confirm Password" >
								<div class="required">{{$errors->first('confirm_password')}}</div>
							</div>
							<button type="submit" value="submit" class="reg-signup-btn reg-login-btn">Reset</button>
						</form>
						<div class="fogot-pass-btn-box text-center">
							<a href="{{ url('login') }}" class="forgot-pass-link">Login</a>
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>
@endsection