<div class="book-form-check custom">
	<h5 class="label">Available Date</h5>
	@if(!empty($getcourse->get_course_lesson_date))
		@forelse($getcourse->get_course_lesson_date as $value)
		<div class="form-group d-inline-flex align-items-center mb-0 mr-4">
			<input type="radio" name="lesson_date_id" required="" id="get_course_lesson_date{{ $value->id }}" class="reg-check form-check-input lesson_date_id" value="{{ $value->id }}">
			<label for="get_course_lesson_date{{ $value->id }}" class="form-check-label">
				{{ date('Y-m-d',$value->lesson_time) }}
			</label>
		</div>
		@empty
			<div class="form-group d-inline-flex align-items-center mb-0 mr-4">
				Date not available.
			</div>
		@endforelse
	@else
	<div class="form-group d-inline-flex align-items-center mb-0 mr-4">
		Date not available.
	</div>
	@endif
</div>