@foreach ($getrecord as $value)
<div class="row single-profile-list wow fadeInUp">
   <div class="col-lg-12 col-xl-8">
      <div class="profile-list-bio">
         <div class="bio-image">
            <div class="profile-image">
               <img src="{!! $value->getusers->getImage() !!}" alt="{{ $value->getusers->getName() }}">

               @if($value->getusers->OnlineUser())    
                  <span class="online-status d-flex align-items-center">
                     <span><i class="fas fa-circle"></i></span>{{ __('find_student.Online') }}
                  </span>
               @endif
               
               <span class="lesson-rate">
                  <span class="price">${{ $value->rate_per_hour }}</span>
                  <span class="text">/{{ __('find_student.Lesson') }}</span>
               </span>

            </div>
            <p class="local-time thin-colored-text">
               <span class="flag"><img src="{!! $value->getusers->getcountry->getImage() !!}" style="height: 15px;" alt="flag-china"></span>
               <span class="time"> {{ $value->getusers->gettimezonedate() }}</span>
            </p>
         </div>
         <div class="bio-desc">
            <h3 class="profile-name">{{ $value->getusers->getName() }}</h3>
            <h5 class="subtitle">{{ $value->request_title }}</h5>
            <h6 class="request-label">{{ __('find_student.Request_Description') }}</h6>
            <p class="request-desc">{{ strip_tags(substr($value->request_description,0,700)) }}...</p>
            @if(!empty(Auth::check()) && Auth::user()->is_admin == 2)
               @if(empty($value->checkAlreadySent(Auth::user()->id)))
                <a style="cursor: pointer;color: #fff" class="button send-offer-btn deep-bg SendofferStudent" id="{{ $value->id }}" >{{ __('find_student.Send_offer') }}</a>
             @endif
            @else
            <a style="color: #fff" href="{{ url('login')  }}" class="button send-offer-btn deep-bg" >{{ __('find_student.Send_offer') }}</a>
            @endif
         </div>
         <!-- send offer popup -->
      </div>
   </div>
   <div class="col-lg-12 col-xl-4 mt-3 mt-xl-0">
      <div class="lesson-history h-100 d-flex flex-column justify-content-between">
         <div class="lesson-history-items-box">
            <p class="lesson-history-item">
               <span class="history-label text-capitalize d-flex align-items-center">
               <i class="far fa-edit"></i>
             {{ __('find_student.Lesson_Language') }}

               </span>
               <span class="history-info">{{ !empty($value->getlanguage->getlanguagename())?$value->getlanguage->getlanguagename(): '' }}</span>
            </p>
            <p class="lesson-history-item">
               <span class="history-label text-capitalize d-flex align-items-center">
               <i class="fas fa-user"></i>
             
                 {{ __('find_student.Request_Type') }}
               
               </span>
               <span class="history-info">{{ !empty($value->getrequesttype->getrequesttypename())?$value->getrequesttype->getrequesttypename(): '' }}</span>
            </p>
            <p class="lesson-history-item">
               <span class="history-label text-capitalize d-flex align-items-center">
               <i class="fas fa-signal"></i>
               
                {{ __('find_student.Level_of_Student') }}
               </span>
               <span class="history-info">{{ !empty($value->getlevelofstudent->getlevelofstudentname())?$value->getlevelofstudent->getlevelofstudentname(): '' }}</span>
            </p>
            <p class="lesson-history-item">
               <span class="history-label text-capitalize d-flex align-items-center">
               <i class="fas fa-list"></i>
                {{ __('find_student.Category') }}
               
               </span>
               <span class="history-info">{{ !empty($value->getcategory->getcategoryname())?$value->getcategory->getcategoryname(): '' }}</span>
            </p>
            <p class="lesson-history-item">
               <span class="history-label text-capitalize d-flex align-items-center">
               <i class="fas fa-clipboard-list"></i>
            
               {{ __('find_student.Lesson_Date') }}
               </span>
               <span class="history-info">{{ date('Y-m-d', $value->lesson_date) }}</span>
            </p>
            <p class="lesson-history-item">
               <span class="history-label text-capitalize d-flex align-items-center">
               <i class="far fa-calendar-alt"></i>
                 {{ __('find_student.Lesson_Start_Time') }}
           
               </span>
               <span class="history-info">{{ date('h:i:A', $value->lesson_time) }}</span>
            </p>
            <p class="lesson-history-item">
               <span class="history-label text-capitalize d-flex align-items-center">
               <i class="far fa-calendar-minus"></i>
               
                {{ __('find_student.Lesson_Duration') }}
               </span>
               <span class="history-info">{{ $value->duration }}   {{ __('find_student.munites') }}</span>
            </p>
            <p class="lesson-history-item">
               <span class="history-label text-capitalize d-flex align-items-center">
               <i class="fas fa-calendar-alt"></i>
               {{ __('find_student.Published_Date') }}
               </span>
               <span class="history-info">{{ date('Y-m-d h:i A', strtotime($value->created_at)) }}</span>
            </p>
         </div>
         <a href="{{ url('student-profile/'.$value->id) }}" class="button view-profile-btn thin-bg text-capitalize">
            {{ __('find_student.View_Profile') }}
         </a>
      </div>
   </div>
</div>
@endforeach