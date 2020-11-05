<div class="book-form-check custom">
	<h5 class="label">Available Time</h5>
	<p class="time-picker-desc">{{ __('auth.Time_zone_changed_automatically') }}</p>
	@if(!empty(count($getdate)))
		@foreach($getdate as $value)
			<div class="form-group d-inline-flex align-items-center mb-0 mr-4">
				<input type="radio" name="lesson_id" required id="get_course_lesson_time{{ $value->id }}" class="reg-check form-check-input" value="{{ $value->id }}">
				<label for="get_course_lesson_time{{ $value->id }}" class="form-check-label">
					{{ date('h:i A',$value->lesson_time) }} - Duration({{ $value->duration }} Minutes)
				</label>
			</div>
		@endforeach
	@endif
</div>