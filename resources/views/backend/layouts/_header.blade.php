
	<!-- start: logged in header -->
	<header class="loggedin-header">
		<div class="container">
			<div class="row align-items-center justify-content-lg-between flex-xl-nowrap">
				<div class="col-12 col-md-4 col-lg-auto flex-lg-fill">
					<div class="logo-and-menu d-flex align-items-center justify-content-between justify-content-xl-start">
						<div class="logo">
							<a href="{{ url('') }}" class="d-flex align-items-center">
								<img src="{{ url('assets/img/logo-logged-in-2x.png') }}" alt="visffor-loggedin-logo">
								<h1 class="site-title text-uppercase">{{ __('layouts.VISFFOR') }}</h1>
							</a>
						</div>

						{{-- Admin Menu start --}}
					@php

						$p_chat = App\Models\UserPermissionModel::getPermission('chat_page');
						$p_notification = App\Models\UserPermissionModel::getPermission('notification_page');
						$p_withdraw_request = App\Models\UserPermissionModel::getPermission('withdraw_request');
						$p_system_setting = App\Models\UserPermissionModel::getPermission('system_setting');
						$p_seo = App\Models\UserPermissionModel::getPermission('seo_page');
						$p_contact_us = App\Models\UserPermissionModel::getPermission('contact_us_page');
						$p_social_icon = App\Models\UserPermissionModel::getPermission('social_icon_page');
						$p_activity = App\Models\UserPermissionModel::getPermission('staff_report_page');

					@endphp

					@if (Auth::user()->is_admin == '1' || Auth::user()->is_admin == '4')
						<div class="loggedin-menu-cont">
							<ul class="main-menu flex-grow-1 d-flex align-items-center">

								<li class="@if ( Request::segment(2) == 'dashboard' ) current-page @endif"><a href="{{ url('admin/dashboard') }}">{{ __('layouts.Dashboard') }}</a></li>

								@if(!empty($p_chat))
								<li class="@if ( Request::segment(2) == 'chat' ) current-page @endif"><a href="{{ url('admin/chat') }}" >{{ __('layouts.Chat') }}</a></li>
								@endif

								@if(!empty($p_notification))
								<li class="@if ( Request::segment(2) == 'notification' ) current-page @endif"><a href="{{ url('admin/notification') }}">{{ __('layouts.Notification') }}</a></li>
								@endif



								@if(!empty($p_withdraw_request))

								<li class="@if ( Request::segment(2) == 'withdraw-request' ) current-page @endif"><a href="{{ url('admin/withdraw-request') }}">{{ __('layouts.Withdraw_Request') }}</a></li>
								@endif


								@if(!empty($p_system_setting))
								<li class="@if ( Request::segment(2) == 'setting') current-page @endif"><a href="{{ url('admin/setting') }}">{{ __('layouts.System_Setting') }}</a></li>
								@endif

								@if(!empty($p_seo))
								<li class="@if ( Request::segment(2) == 'seo') current-page @endif"><a href="{{ url('admin/seo')}}">{{ __('layouts.SEO') }}</a></li>
								@endif

								@if(!empty($p_contact_us))
								<li class="@if ( Request::segment(2) == 'contact_us') current-page @endif">
								<a href="{{ url('admin/contact_us') }}">Contact us</a>
								</li>
								@endif

								@if(!empty($p_activity))
								<li class="@if ( Request::segment(2) == 'activity') current-page @endif">
								<a href="{{ url('admin/activity') }}">Staff Activity</a>
								</li>
								@endif


							</ul>
						</div>
					@endif
             {{-- Admin Menu End --}}
						 {{-- Student Menu Start --}}
					@if (Auth::user()->is_admin == "3")
						<div class="loggedin-menu-cont">
							<ul class="main-menu flex-grow-1 d-flex align-items-center">
								<li class="@if ( Request::segment(2)== 'dashboard' ) current-page @endif"><a href="{{ url('student/dashboard') }}">{{ __('layouts.Dashboard') }}</a></li>

								<li class="@if ( Request::segment(2)== 'chat' ) current-page @endif"><a href="{{ url('student/chat') }}" >{{ __('layouts.Chat') }}</a></li>

								<li class="@if ( Request::segment(2)== 'course' ) current-page @endif"><a href="{{ url('student/course') }}">{{ __('layouts.Course') }}</a></li>
								<li class="@if ( Request::segment(2)== 'offer-page' ) current-page @endif"><a href="{{ url('student/offer-page') }}">{{ __('layouts.Offer') }}</a></li>
								<li class="@if ( Request::segment(2)== 'request-page' ) current-page @endif"><a href="{{ url('student/request-page') }}">{{ __('layouts.Request') }}</a></li>

								<li class="@if ( Request::segment(2) == 'notification' ) current-page @endif"><a href="{{ url('student/notification') }}">{{ __('layouts.Notification') }}</a></li>
							</ul>
						</div>
					 @endif
						 {{-- Student Menu End  --}}
						 {{-- Teacher [Tutor] Menu Start --}}
					@if (Auth::user()->is_admin == "2")
						<div class="loggedin-menu-cont">
							<ul class="main-menu flex-grow-1 d-flex align-items-center">
								<li class="@if ( Request::segment(2)== 'dashboard' ) current-page @endif"><a href="{{ url('tutor/dashboard') }}">{{ __('layouts.Dashboard') }}</a></li>
								<li class="@if ( Request::segment(2)== 'chat' ) current-page @endif"><a href="{{ url('tutor/chat') }}">{{ __('layouts.Chat') }}</a></li>
								<li class="@if ( Request::segment(2)== 'lesson' ) current-page @endif"><a href="{{ url('tutor/lesson') }}">{{ __('layouts.Lesson') }}</a></li>
								<li class="@if ( Request::segment(2)== 'offer' ) current-page @endif"><a href="{{ url('tutor/offer') }}">{{ __('layouts.Offer') }}</a></li>
								<li class="@if ( Request::segment(2)== 'student-request' ) current-page @endif"><a href="{{ url('tutor/student-request') }}">{{ __('layouts.Request') }}</a></li>
								<li class="@if ( Request::segment(2)== 'course' ) current-page @endif"><a href="{{ url('tutor/course') }}">{{ __('layouts.Course') }}</a></li>
								<li class="@if ( Request::segment(2)== 'new-course' ) current-page @endif"><a href="{{ url('tutor/new-course') }}">{{ __('layouts.Publish_New_Course') }}</a></li>
								<li class="@if ( Request::segment(2)== 'earning' ) current-page @endif"><a href="{{ url('tutor/earning')}}">{{ __('layouts.Earning') }}</a></li>
								<li class="@if ( Request::segment(2) == 'notification' ) current-page @endif"><a href="{{ url('tutor/notification') }}">{{ __('layouts.Notification') }}</a></li>
							</ul>
						</div>

					@endif
						 {{-- Teacher [Tutor] Menu End --}}

						<!-- mobile menu button -->
						<span class="loggedin-menu-button">
							<button type="button" id="loggedin-menu-opener">
								<span class="icon"><i class="fas fa-bars"></i></span>
								<span class="text ml-1">{{ __('layouts.Menu') }}</span>
							</button>
							<button type="button" id="loggedin-menu-closer">x</button>
						</span>
					</div>
				</div>

				<div class="col-12 col-md-6 col-lg-auto flex-grow-1 mt-3 mt-md-0">
					<div class="lang-and-status d-flex align-items-center justify-content-between justify-content-sm-end">
						<div class="language-search">
							<select class="form-control" id="change-language">
								<option {{ (\Session::get('locale') == 'en') ? 'selected' : '' }} value="{{ url('locale/en') }}">{{ __('layouts.English') }}</option>
								<option {{ (\Session::get('locale') == 'ch') ? 'selected' : '' }} value="{{ url('locale/ch') }}">{{ __('layouts.Chinese') }}</option>
							</select>
						</div>

						<div class="user-status">
							<a href="#" class="user-options-toggler d-flex align-items-center justify-content-end">
								<span class="user-img active">
									<img src="{!! Auth::user()->getImage() !!}" alt="{{ Auth::user()->name }}">
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
									<li><a href="{{ url('admin/country') }}">Country</a></li>

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

					</div>
				</div>
			</div>
		</div>
	</header>
	<!-- end: logged in header -->
