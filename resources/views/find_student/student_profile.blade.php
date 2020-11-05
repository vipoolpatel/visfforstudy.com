@extends('layouts.app')
@section('content')
<section class="hero-area">
   <div class="hero-bg" style="background-image: url({{ url('assets/img/banner-bg/banner-bg-3.jpg')  }});"></div>
   <div class="hero-overlay"></div>
   <div class="container h-100">
      <div class="row justify-content-center align-items-lg-center h-100">
         <!-- user profile summery -->
         <div class="col-12 col-lg-4 profile-summary order-2 order-lg-1">
            <div class="user-profile text-center text-capitalize">
               <div class="profile-image">
                  <img src="{!! $getrecord->getusers->getImage() !!}" alt="{{ $getrecord->getusers->getName() }}">
                  <span class="lesson-rate">
                  <span class="price">${{ $getrecord->rate_per_hour }}</span>
                  <span class="text">/{{ __('find_student.Lesson') }}</span>
                  </span>
               </div>
               <h3 class="profile-name">{{ $getrecord->getusers->getName() }}</h3>
               <p class="local-time thin-colored-text">
                  <span class="flag"><img src="{{ url('assets/img/iconic-flag-china.png') }}" alt="flag-china"></span>
                  <span class="time">{{ $getrecord->getusers->gettimezonedate() }}</span>
               </p>
               <div class="rating">
                  <span class="stars">
                  {!! $getrecord->getusers->getHTMLRating() !!}
                  </span>
                  <span class="point">{!! $getrecord->getusers->averageRating() !!}</span>
                  <span class="text">{{ __('find_student.Rating') }}</span>
               </div>
               <div class="lesson-history">
                  <p class="lesson-history-item">
                     <span class="history-label text-capitalize d-flex align-items-center">
                     <i class="fas fa-user"></i>{{ __('find_student.Request_Type') }}
                     </span>
                     <span class="history-info">{{ !empty($getrecord->getrequesttype->getrequesttypename())?$getrecord->getrequesttype->getrequesttypename(): '' }}</span>
                  </p>
                  <p class="lesson-history-item">
                     <span class="history-label text-capitalize d-flex align-items-center">
                     <i class="fas fa-signal"></i>
                     {{ __('find_student.Level_of_Student') }}

                     </span>
                     <span class="history-info">{{ !empty($getrecord->getlevelofstudent->getlevelofstudentname())?$getrecord->getlevelofstudent->getlevelofstudentname(): '' }}</span>
                  </p>
                  <p class="lesson-history-item">
                     <span class="history-label text-capitalize d-flex align-items-center">
                     <i class="fas fa-list"></i>
                     {{ __('find_student.Category') }}
                     </span>
                     <span class="history-info">{{ !empty($getrecord->getcategory->getcategoryname())?$getrecord->getcategory->getcategoryname(): '' }}</span>
                  </p>
                   <p class="lesson-history-item">
                     <span class="history-label text-capitalize d-flex align-items-center">
                     <i class="fas fa-list"></i>
                      {{ __('find_student.Lesson_Language') }}
                     </span>
                     <span class="history-info">{{ !empty($getrecord->getlanguage->getlanguagename())?$getrecord->getlanguage->getlanguagename(): '' }}</span>
                  </p>


                  <p class="lesson-history-item">
                     <span class="history-label text-capitalize d-flex align-items-center">
                     <i class="fas fa-clipboard-list"></i>
                       {{ __('find_student.Lesson_Date') }}
                     </span>
                     <span class="history-info">{{ date('Y-m-d', $getrecord->lesson_date) }}</span>
                  </p>
                  <p class="lesson-history-item">
                     <span class="history-label text-capitalize d-flex align-items-center">
                     <i class="far fa-calendar-alt"></i>
  {{ __('find_student.Lesson_Start_Time') }}

                     </span>
                     <span class="history-info">{{ date('h:i:A', $getrecord->lesson_time) }}</span>
                  </p>
                  <p class="lesson-history-item">
                     <span class="history-label text-capitalize d-flex align-items-center">
                     <i class="far fa-calendar-minus"></i>
                     {{ __('find_student.Lesson_Duration') }}

                     </span>
                     <span class="history-info">{{ $getrecord->duration }}  {{ __('find_student.munites') }}</span>
                  </p>
                  <p class="lesson-history-item">
                     <span class="history-label text-capitalize d-flex align-items-center">
                     <i class="fas fa-calendar-alt"></i>
                     {{ __('find_student.Published_Date') }}
                     </span>
                     <span class="history-info">{{ date('Y-m-d h:i A', strtotime($getrecord->created_at)) }}</span>
                  </p>
               </div>

           @if(!empty(Auth::check()) && Auth::user()->is_admin == 2)
               @if(empty($getrecord->checkAlreadySent(Auth::user()->id)))
                   <a style="cursor: pointer;color: #fff" class="button send-offer-btn deep-bg SendofferStudent" id="{{ $getrecord->id }}" >
  {{ __('find_student.Send_offer') }}
                   </a>
               @endif
            @else
                  <a style="color: #fff" href="{{ url('login')  }}" class="button send-offer-btn deep-bg">
                    {{ __('find_student.Send_offer') }}</a>
            @endif
                          
            </div>
            <!-- send offer popup -->
         </div>
         <!-- hero main content -->
         <div class="col-12 col-lg-8 ml-lg-auto order-1 order-lg-2 h-100">
            <!-- hero main content -->
            <div class="hero-main-content">
               <h1 class="hero-title-name text-capitalize">{{ $getrecord->getusers->getName() }}</h1>
               <h3 class="hero-subtitle text-capitalize">${{ $getrecord->rate_per_hour }}  {{ __('find_student.Lesson') }}</h3>
               <div class="rating">
                  <span class="stars">
                 {!! $getrecord->getusers->getHTMLRating() !!}
                  </span>
                  <span class="point">{!! $getrecord->getusers->averageRating() !!}</span>
                  <span class="text">{{ __('find_student.Rating') }}</span>
               </div>
               <h3 class="hero-subtitle text-capitalize">{{ $getrecord->request_title }}</h3>
            </div>
            <!-- profile hero menu -->
            <nav class="hero-menu-tabs-container">
               <a class="hero-menu-tab" href="#bio">{{ __('find_student.Bio') }}</a>
               <a class="hero-menu-tab" href="#description">{{ __('find_student.Description') }}</a>
               <a class="hero-menu-tab" href="#rating">{{ __('find_student.Rating') }}</a>
               <a class="hero-menu-tab" href="#reviews">{{ __('find_student.Reviews') }}</a>
               <span class="hero-menu-tab-slider"></span>
               <button type="button" id="mobile-menu-closer">x</button>
            </nav>
            <!-- mobile menu button -->
            <span class="mobile-menu-button sticky-head">
            <button type="button" id="mobile-menu-opener">
            <span class="icon"><i class="fas fa-bars"></i></span>
            <span class="text ml-1">{{ __('find_student.Menu') }}</span>
            </button>
            </span>
         </div>
      </div>
   </div>
</section>
<!-- end: hero area -->
<!-- start: main content -->
<div id="main-content" class="main-content">
   <div class="container">
      <div class="row">
         <div class="col-lg-8 ml-lg-auto pl-lg-0">
            <!-- start: bio -->
            <section id="bio" class="bio wow fadeInUp">
               <div class="section-content">
                  <!-- section heading -->
                  <div class="section-heading">
                     <span class="iconic-image">
                 	<img src="{!! $getrecord->getusers->getImage() !!}" alt="profile-picture">
              
                     <img src="{{ url('assets/img/student-profile/student-profile-1.jpg') }}" alt="profile-picture">
                     </span>
                     <h2 class="section-title">{{ __('find_student.Bio') }}</h2>
                  </div>
                  <!-- inner content -->
                  <div class="inner-content">
          	         <p>{!! $getrecord->getusers->about_us !!}</p>
                  </div>
               </div>
            </section>
            <!-- end: bio -->
            <!-- start: description -->
            <section id="description" class="description wow fadeInUp">
               <div class="section-content">
                  <!-- section heading -->
                  <div class="section-heading">
                     <span class="iconic-image">
                     <img src="{{ url('assets/img/iconic-description.png') }}" alt="description">
                     </span>
                     <h2 class="section-title">
                     {{ __('find_student.Request_Description') }}</h2>
                  </div>
                  <!-- inner content -->
                  <div class="inner-content">
                     <h4 class="bio-subtitle text-capitalize mb-3">{!! $getrecord->request_title !!}</h4>
                     <p>{!! $getrecord->request_description !!}</p>
                  </div>
               </div>
            </section>
            <!-- end: description -->
        
            <!-- start: rating -->
            <section id="rating" class="rating-sec wow fadeInUp">
               <div class="section-content">
                  <!-- section heading -->
                  <div class="section-heading">
                     <span class="iconic-image">
                     <img src="{{ url('assets/img/iconic-register.png') }}" alt="rating">
                     </span>
                     <h2 class="section-title">{{ __('find_student.Teachers_Feedback') }}</h2>
                  </div>
                  <!-- inner content -->
                  <div class="inner-content">
                     <div class="rating">
                        <span class="point">{!! $getrecord->getusers->averageRating() !!}</span>
                        <span class="stars">
                       {!! $getrecord->getusers->getHTMLRating() !!}
                        </span>
                     </div>
                       <div class="rating-bars">
                        <div class="single-rating-bar d-flex align-items-center mb-3">
                           <span class="star-label">5 {{ __('find_tutor.Stars') }}</span>
                           <div class="progress">
                              <div class="progress-bar" role="progressbar" style="width: {!! $getrecord->getusers->get_review_percentage(5) !!}%;" aria-valuenow="{!! $getrecord->getusers->get_review_percentage(5) !!}" aria-valuemin="0" aria-valuemax="100"></div>
                           </div>
                           <span class="star-count">({!! $getrecord->getusers->get_review_count(5) !!})</span>
                        </div>
                        <div class="single-rating-bar d-flex align-items-center mb-3">
                           <span class="star-label">4 {{ __('find_tutor.Stars') }}</span>
                           <div class="progress">
                              <div class="progress-bar" role="progressbar" style="width: {!! $getrecord->getusers->get_review_percentage(4) !!}%;" aria-valuenow="{!! $getrecord->getusers->get_review_percentage(4) !!}" aria-valuemin="0" aria-valuemax="100"></div>
                           </div>
                           <span class="star-count">({!! $getrecord->getusers->get_review_count(4) !!})</span>
                        </div>
                        <div class="single-rating-bar d-flex align-items-center mb-3">
                           <span class="star-label">3 {{ __('find_tutor.Stars') }}</span>
                           <div class="progress">
                              <div class="progress-bar" role="progressbar" style="width: {!! $getrecord->getusers->get_review_percentage(3) !!}%;" aria-valuenow="{!! $getrecord->getusers->get_review_percentage(3) !!}" aria-valuemin="0" aria-valuemax="100"></div>
                           </div>
                           <span class="star-count">({!! $getrecord->getusers->get_review_count(3) !!})</span>
                        </div>
                        <div class="single-rating-bar d-flex align-items-center mb-3">
                           <span class="star-label">2 {{ __('find_tutor.Stars') }}</span>
                           <div class="progress">
                              <div class="progress-bar" role="progressbar" style="width: {!! $getrecord->getusers->get_review_percentage(2) !!}%;" aria-valuenow="{!! $getrecord->getusers->get_review_percentage(2) !!}" aria-valuemin="0" aria-valuemax="100"></div>
                           </div>
                           <span class="star-count">({!! $getrecord->getusers->get_review_count(2) !!})</span>
                        </div>
                        <div class="single-rating-bar d-flex align-items-center mb-3">
                           <span class="star-label">1 {{ __('find_tutor.Stars') }}</span>
                           <div class="progress">
                              <div class="progress-bar" role="progressbar" style="width: {!! $getrecord->getusers->get_review_percentage(1) !!}%;" aria-valuenow="{!! $getrecord->getusers->get_review_percentage(1) !!}" aria-valuemin="0" aria-valuemax="100"></div>
                           </div>
                           <span class="star-count">({!! $getrecord->getusers->get_review_count(1) !!})</span>
                        </div>
                     </div>
                  </div>
               </div>
            </section>
            <!-- end: rating -->
            <!-- start: reviews -->
            <section id="reviews" class="reviews wow fadeInUp">
               <div class="section-content">
                  <!-- section heading -->
                  <div class="section-heading">
                     <span class="iconic-image">
                     <img src="{{ url('assets/img/iconic-review.png') }}" alt="review">
                     </span>
                     <h2 class="section-title">{{ __('find_student.Teachers_Reviews') }}</h2>
                  </div>
                  <!-- inner content -->
                  <div class="inner-content">

                    @forelse($getrecord->getusers->get_review as $review)
                     <div class="single-review">
                        <div class="student-img">
                           <img src="{!! $review->getuser->getImage() !!}" alt="student-review">
                        </div>
                        <div class="review-info">
                           <h4 class="student-name" style="text-transform: capitalize;">{!! $review->getuser->name !!} {!! $review->getuser->last_name !!}</h4>
                           <p class="review-text">
                              {!! $review->review !!}
                           </p>
                           <p class="review-meta">
                              <span class="review-date">
                                 {{ Carbon\Carbon::parse($review->created_at)->diffForHumans()}}
                              </span>
                           </p>
                        </div>
                     </div>
                     @empty
                     @endforelse
                  </div>
               </div>
            </section>
            <!-- end: reviews -->
        
         </div>
      </div>
   </div>
</div>

<div class="modal fade getSetudentData" id="getSetudentData" tabindex="-1" role="dialog" aria-labelledby="studentPop1Title" aria-hidden="true"></div>

@endsection
