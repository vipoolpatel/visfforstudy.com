@foreach ($getrecord as $value)

<div class="row single-profile-list wow fadeInUp">
  <div class="col-lg-12 col-xl-8">
    <div class="profile-list-bio">
      <div class="bio-image">
        <div class="profile-image">
          <img src="{!! $value->getImage() !!}" alt="{{ $value->getName() }}">          
           @if($value->OnlineUser())    
              <span class="online-status d-flex align-items-center">
                 <span><i class="fas fa-circle"></i></span>{{ __('find_tutor.Online') }}
              </span>
           @endif
           @if(!empty($value->hour_per_rate))
              <span class="lesson-rate">
                <span class="price">${{ $value->hour_per_rate }}</span>
                <span class="text">/{{ __('find_tutor.Lesson') }}</span>
              </span>
           @endif
        </div>
        <p class="local-time thin-colored-text">
          <span class="flag"><img src="{!! $value->getcountry->getImage() !!}"  style="height: 15px;"></span>
          <span class="time">{{ $value->gettimezonedate() }}</span>
        </p>
      </div>
      <div class="bio-desc">
        <h3 class="profile-name">{{ $value->getName() }}</h3>
        <div class="rating justify-content-start">
          <span class="stars">
            {!! $value->getHTMLRating() !!}
          </span>
          <span class="point">{!! $value->averageRating() !!}</span>
          <span class="text">{{ __('find_tutor.Rating') }}</span>
        </div>
      @if (!empty($value->experience_of_teacher))
        <h6 class="request-label">{{ $value->experience_of_teacher }} {{ __('find_tutor.Years_Experienced') }} </h6>
      @endif
        <p class="request-desc">
          {{ strip_tags(substr($value->about_us,0,350)) }}...
        </p>
        <a href="{{ url('tutor-profile/'.$value->id) }}" class="button view-bio-btn send-offer-btn deep-bg">{{ __('find_tutor.View_My_Bio') }}</a>
      </div>
    </div>
  </div>
  <div class="col-lg-12 col-xl-4 mt-3 mt-xl-0">
    <div class="lesson-history h-100 d-flex flex-column justify-content-between">
      <div class="lesson-history-items-box">
        <p class="lesson-history-item">
          <span class="history-label text-capitalize d-flex align-items-center">
            <i class="fas fa-envelope"></i>
             {{ __('find_tutor.Average_Reply_Time') }}
          </span>
          <span class="history-info">1 {{ __('find_tutor.Hour') }}</span>
        </p>
        <p class="lesson-history-item">
          <span class="history-label text-capitalize d-flex align-items-center">
            <i class="fas fa-sync-alt"></i>
            {{ __('find_tutor.Repeat_tudent') }}
          </span>
          <span class="history-info">15</span>
        </p>
        <p class="lesson-history-item">
               <span class="history-label text-capitalize d-flex align-items-center">
                  <i class="fas fa-list"></i>
                  
                      {{ __('find_tutor.Level') }}
               </span>
               <span class="history-info">
                {{-- {{ !empty($value->getlevelofstudent->level_of_student_name) ? ucfirst($value->getlevelofstudent->level_of_student_name) : '-' }} --}}
{{ !empty($value->getlevelofstudent->getlevelofstudentname())? $value->getlevelofstudent->getlevelofstudentname() : '-' }}
               </span>
            </p>
        <p class="lesson-history-item">
          <span class="history-label text-capitalize d-flex align-items-center">
            <i class="fas fa-list"></i>
              {{ __('find_tutor.Category') }}
          </span>
          <span class="history-info">{{ !empty($value->getcategory->getcategoryname())? $value->getcategory->getcategoryname() : '' }}</span>
        </p>
        <p class="lesson-history-item">
          <span class="history-label text-capitalize d-flex align-items-center">
            <i class="far fa-edit"></i>
             {{ __('find_tutor.Lesson_Language') }}
          </span>
          <span class="history-info">
            @php
            $get_langauge = '';
            @endphp
            @foreach($value->get_langauge as $key => $value_l)
                @php
                  $get_langauge .= $value_l->getuserlanguage->getlanguagename().', ';
                @endphp
            @endforeach
            {{ trim($get_langauge,', ') }}
          </span>
        </p>
      </div>
      <a href="{{ url('tutor-profile/'.$value->id) }}" class="button view-profile-btn thin-bg text-capitalize">   {{ __('find_tutor.View_Profile') }}</a>
    </div>
  </div>
</div>

@endforeach
