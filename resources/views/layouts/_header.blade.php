
@php
//use Session;

use App\Models\LevelOfStudentModel;
$getlevel = LevelOfStudentModel::getLevelOfStudent();

$getlevelofstudentname = LevelOfStudentModel::getLevelOfStudent();

@endphp

	<!-- start: header -->
	<header class="header-area">
		<div class="container-fluid">
			<div class="row align-items-xl-end justify-content-xl-between">
				<div class="col-lg-6 col-xl-5">
					<div class="logo-and-search">
						<div class="logo">
							<a href="{{ url('/') }}">
								<img src="{{ url('assets/img/logo-2x.png') }}" alt="visffor-logo">
							</a>
						</div>

						<form action="{{ url('find-tutor') }}" method="get" class="math-search d-flex align-items-center">
							<div class="input-group input-group-sm">
								<input type="text" name="category" value="{{ Request()->category }}" class="math form-control" placeholder="{{ __('layouts.Try_Search_Math_or_English') }}">
								<select name="level_of_teacher" class="math-level form-control">
										<option value="">{{ __('layouts.Select_Level') }}</option>
										@foreach ($getlevel as $value_level)
										<option {{ (Request()->level_of_teacher == $value_level->id) ? 'selected' : '' }} value="{{ $value_level->id }}">{{ $value_level->getlevelofstudentname() }}</option>
										@endforeach
								</select>
							</div>
							<button type="submit" class="math-search-submit">
								<i class="fas fa-search"></i>
							</button>
						</form>
					</div>
				</div>

				<div class="col-lg-6 col-xl-7">
					<div class="menu-and-reg d-flex align-items-center justify-content-between justify-content-md-between justify-content-lg-end">
						<ul class="main-menu d-flex flex-grow-1 align-items-center justify-content-lg-end justify-content-xl-center">
							<li class=" @if ( Request::segment(1)== '') current-page @endif"><a href="{{ url('/') }}">{{ __('layouts.Home') }}</a></li>
							<li class="@if ( Request::segment(1)== 'find-student') current-page @endif"><a href="{{ url('find-student') }}">{{ __('layouts.Find_a_Student') }}</a></li>
							<li class="@if ( Request::segment(1)== 'find-tutor') current-page @endif"><a href="{{ url('find-tutor') }}">{{ __('layouts.Find_a_Tutor') }}</a></li>
							<li class="@if ( Request::segment(1)== 'become-tutor') current-page @endif"><a href="{{ url('become-tutor') }}">{{ __('layouts.Become_a_Tutor') }}</a></li>
						</ul>

						<div class="language-search">
							<select class="form-control" id="change-language">
								<option {{ (\Session::get('locale') == 'en') ? 'selected' : '' }} value="{{ url('locale/en') }}">{{ __('layouts.English') }}</option>
								<option {{ (\Session::get('locale') == 'ch') ? 'selected' : '' }} value="{{ url('locale/ch') }}">{{ __('layouts.Chinese') }}</option>
							</select>
						</div>

					
						
							@if(Auth::check())
								@php
									$p_chat = App\Models\UserPermissionModel::getPermission('chat_page');
									$p_notification = App\Models\UserPermissionModel::getPermission('notification_page');
									$p_withdraw_request = App\Models\UserPermissionModel::getPermission('withdraw_request');
									$p_system_setting = App\Models\UserPermissionModel::getPermission('system_setting');
									$p_seo = App\Models\UserPermissionModel::getPermission('seo_page');
									$p_contact_us = App\Models\UserPermissionModel::getPermission('contact_us_page');
									$p_social_icon = App\Models\UserPermissionModel::getPermission('social_icon_page');
									$p_activity = App\Models\UserPermissionModel::getPermission('activity_page');						
								@endphp

								<div class="user-status">
									<a href="#" class="user-options-toggler d-flex align-items-center justify-content-end">
										<span class="user-img active">
											<img src="{!! Auth::user()->getImage() !!}" alt="loggedin-user">
										</span>
										<span class="loggedin-user-name text-capitalize text-right">{{ Auth::user()->name }}</span>
									</a>
									<div id="user-options-pop-wrap">
										<div class="pointer-tip"></div>
										<ul class="popup-content">
										@if (Auth::user()->is_admin == "1" || Auth::user()->is_admin == "4")
											<li><a href="{{ url('admin/dashboard') }}">{{ __('layouts.Dashboard') }}</a></li>
											<li><a href="{{ url('admin/profile') }}">{{ __('layouts.Profile') }}</a></li>
											<li><a href="{{ url('admin/change-password') }}">{{ __('layouts.Change_Password') }}</a></li>
											@if(!empty($p_chat))
											<li><a href="{{ url('admin/chat') }}">{{ __('layouts.Chat') }}</a></li>
											@endif
											@if(!empty($p_social_icon))
											<li><a href="{{ url('admin/social-icon') }}">{{ __('layouts.Social_Icon') }}</a></li>
											@endif
										@elseif(Auth::user()->is_admin == "2")
											<li><a href="{{ url('tutor/dashboard') }}">{{ __('layouts.Dashboard') }}</a></li>
											<li><a href="{{ url('tutor/profile') }}">{{ __('layouts.Profile') }}</a></li>
											<li><a href="{{ url('tutor/qualification') }}">{{ __('layouts.Qualification') }}</a></li>
											<li><a href="{{ url('tutor/change-password') }}">{{ __('layouts.Change_Password') }}</a></li>
											<li><a href="{{ url('tutor/chat') }}">{{ __('layouts.Chat') }}</a></li>
										@elseif(Auth::user()->is_admin == "3")
											<li><a href="{{ url('student/dashboard') }}">{{ __('layouts.Dashboard') }}</a></li>
											<li><a href="{{ url('student/profile') }}">{{ __('layouts.Profile') }}</a></li>
											<li><a href="{{ url('student/change-password') }}">{{ __('layouts.Change_Password') }}</a></li>
											<li><a href="{{ url('student/chat') }}">{{ __('layouts.Chat') }}</a></li>
										@endif
											<li><a href="{{ url('logout') }}">{{ __('layouts.Logout') }}</a></li>
										</ul>
									</div>
								</div>


							{{-- 	@if(Auth::user()->is_admin == '1' || Auth::user()->is_admin == '4')
									<a href="{{ url('admin/dashboard') }}" class="reg-btn signup">{{ __('layouts.Dashboard') }}</a>
								@elseif(Auth::user()->is_admin == '2')
									<a href="{{ url('tutor/dashboard') }}" class="reg-btn signup">{{ __('layouts.Dashboard') }}</a>
								@elseif(Auth::user()->is_admin == '3')
									<a href="{{ url('student/dashboard') }}" class="reg-btn signup">{{ __('layouts.Dashboard') }}</a>
								@endif --}}
							@else
								<div class="user-access d-flex">
									<a href="{{ url('signup') }}" class="reg-btn signup">{{ __('layouts.Sign_Up') }}</a>
									<a href="{{ url('login') }}" class="reg-btn login">{{ __('layouts.Login') }}</a>
								</div>
							@endif
							
						
					</div>
				</div>
			</div>
		</div>
	</header>
