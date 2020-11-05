@extends('backend.layouts.app')
{{-- @section('stylesheet')
<style type="text/css">

</style>
@endsection  --}}
@section('content')


  	<!-- start: hero area -->
  	<section class="hero-area loggedin-hero-area">
  		<div class="hero-bg" style="background-image: url({{ url('assets/img/banner-bg/banner-bg-5.jpg') }});"></div>
  		<div class="hero-overlay"></div>
  		<div class="container h-100">
  			<div class="row align-items-lg-center h-100">
  				<!-- hero main content -->
  				<div class="col-12 col-lg-11 offset-lg-1 h-100">
  					<!-- hero main content -->
  					<div class="hero-main-content">
  						<h2 class="hero-title text-capitalize">
                  {{ __('tutor.Publish_A_New_Course') }}
              </h2>

  						<div class="hero-booking-featuers">
  							<ul class="lesson-booking-features reg-form-guide-list">
  								<li class="single-booking-feature">
  									
                    {{ __('tutor.You_will_get_all_Student_reviews') }}
  								</li>
  								<li class="single-feature">
  									{{ __('tutor.You_will_find_your_Student_faster') }}

  								</li>
  								<li class="single-feature">
                      {{ __('tutor.Your_Offer_will_be_seen_by_all_of_Students') }}
  								
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
  	<div class="main-content">
  		<div class="container">
  			<div class="row">
  				<div class="col-lg-12">
  					<!-- start: publish course section -->
  					<section class="publish-course-section booking-section">
  						<div class="row">
  							<div class="col-lg-11 offset-lg-1">
  								<div class="find-multi-search-box booking-form-container">
									@include('message')
  									<form action="{{ url('tutor/new-course') }}" class="booking-form publish-form" method="post" enctype="multipart/form-data">
										{{ csrf_field() }}  
										<div class="form-group title-field">
  											<label>{{ __('tutor.Add_course_title') }}</label>
  											<input type="text" name="course_title" required class="publish-course-title form-control" placeholder="{{ __('tutor.Enter_your_course_title') }}">
  										</div>

  										<div class="multi-search-form d-flex align-items-end">
  											<div class="input-group">
  												<div class="form-group">
  													<label style="font-size: 18px;">{{ __('tutor.Category') }}</label>
  													<select name="category_id"  required class="category-multi form-control">
														<option value="">{{ __('tutor.Select_Category') }}</option>
														@foreach($getCategory as $value_c) 
  														<option value="{{ $value_c->id }}">{{ $value_c->getcategoryname() }}</option>
  														@endforeach
  													</select>
  												</div>

                          <div class="form-group">
                            <label style="font-size: 18px;">{{ __('tutor.Course_Language') }}</label>
                            <select name="language_id" required class="category-multi form-control">
                            <option value="">{{ __('tutor.Select_Language') }}</option>
                            @foreach($getLanguage as $value_l) 
                              <option value="{{ $value_l->id }}">{{ $value_l->getlanguagename() }}</option>
                              @endforeach
                            </select>
                          </div>
  											
  											</div>
  										</div>

  										<div class="form-group publish-course-subjects">
  											<label for="publish-course-subject">{{ __('tutor.Add_subject') }}</label>
  											<div id="subject-fields-wrap">
  												<div class="initial-field with-btn">
  													<input type="text" required name="subject_name[]" class="publish-course-subject form-control" placeholder="{{ __('tutor.Subject') }}">
  													<button id="add-subject-btn" class="button add-btn">&plus;</button>
  												</div>
  											</div>
  										</div>

  										<div class="form-group publish-course-image">
  											<label for="publish-course-image">{{ __('tutor.Course_image') }}</label>
  											<div class="upload-file-wrap form-control">
  												<input type="file" name="image" required accept="image/*" class="publish-course-image upload-field">
  											</div>
  										</div>

  										<div class="form-group publish-course-video">
  											<label for="publish-course-video">{{ __('tutor.Course_video') }}</label>
  											<div class="upload-file-wrap form-control">
  												<input type="file" name="course_video" accept="video/*" class="publish-course-video upload-field">
  											</div>
										</div>
										  
										<div class="form-group title-field">
											<label>{{ __('tutor.Price_For_Each_Lesson') }}</label>
											<input type="text" name="lesson_per_rate"  required class="publish-course-title form-control" placeholder="{{ __('tutor.Price_For_Each_Lesson') }}">
										</div>
										  
										  <div class="book-form-check custom">
											<h5 class="label">{{ __('tutor.What_type_of_lesson_do_you_Provide') }}</h5>
                      @foreach($getRequestType as $type)

											<div class="form-group d-inline-flex align-items-center mb-0 mr-4">
												<input type="radio" name="lesson_type_id"  required id="getRequestType{{ $type->id }}" class="reg-check form-check-input" value="{{ $type->id }}">
												<label for="getRequestType{{ $type->id }}" class="form-check-label">{{ $type->request_type_name }}</label>
											</div>

                      @endforeach
										
										</div>

  										
									  <div class="custom-date-picker">
											<div id="date-picker-box" class="date-picker-box">
												<input type="text" name="lesson_date" id="book-date" required class="publish-course-date publish-course-date" placeholder="{{ __('tutor.Pick_a_Date') }}">
											</div>
										</div>

  										<div class="form-group time-picker">
  											<label for="publish-start-time">{{ __('tutor.Chose_start_and_duration') }}</label>
  											<p class="time-picker-desc">
                          {{ __('tutor.Time_zone_changed_automatically') }}
  											
  											</p>
  											<div id="time-fields-wrap">
  												<div class="initial-field with-btn form-check-inline">
  													<input type="time" required style="padding: 0px;padding-left: 10px;" required name="lesson_time[]" class="time-from form-control text-left">
  													<span class="time-picker-separator">&amp;</span>
  													<input type="text" name="duration[]" required class="course-duration form-control" placeholder="{{ __('tutor.Duration_Minutes') }}">
  													<button id="add-time-btn" class="button add-btn">&plus;</button>
  												</div>
  											</div>
  										</div>

  										<div class="text-message">
  											<div class="form-group">
  												<label for="publish-course-desc">{{ __('tutor.Describe_your_course') }}</label>
  												<textarea name="description" class="publish-course-desc form-control" placeholder="{{ __('tutor.Type_a_Description') }}" cols="10" rows="5"></textarea>
  											</div>
  										</div>

  										<button type="submit" class="publish-submit-btn reg-signup-btn text-capitalize">{{ __('tutor.Publish_Now') }}</button>
  									</form>
  								</div>
  							</div>
  						</div>
  					</section>
  				</div>
  			</div>
  		</div>
  	</div>

@endsection

@section('script')
<<script type="text/javascript">

</script>
@endsection  
