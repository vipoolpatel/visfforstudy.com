<div class="modal-dialog" role="document">
   <div class="modal-content">
      <div class="modal-header">
         <h2 class="modal-title send-offer-main-title" id="studentPop1Title">
            {{ __('find_student.Send_offer') }}
         </h2>
         <button type="button" class="close" data-dismiss="modal" aria-label="Close">
         <span aria-hidden="true">&times;</span>
         </button>
      </div>
      <div class="modal-body send-offer-wrapper main-content profile">
         <div class="container">
            <div class="row">
               <div class="col-lg-8 mx-auto">
                  <!-- start: student profile summary -->
                  <section class="morestudents all-students">
                     <div class="section-content">
                        <!-- profile list -->
                        <div class="profile-list">
                           <div class="row single-profile-list">
                              <div class="col-lg-12 col-xl-8">
                                 <div class="profile-list-bio">
                                    <div class="bio-image">
                                       <div class="profile-image">
                                          <img src="{!! $value->getusers->getImage() !!}" alt="{{ $value->getusers->getName() }}">
                                          @if($value->getusers->OnlineUser())
                                          <span class="online-status d-flex align-items-center">
                                          <span><i class="fas fa-circle"></i></span>
                                          {{ __('find_student.Online') }}
                                          </span>
                                          @endif
                                          <span class="lesson-rate">
                                          <span class="price">${{ $value->rate_per_hour }}</span>
                                          <span class="text">/ {{ __('find_student.Lesson') }}</span>
                                          </span>
                                       </div>
                                       <p class="local-time thin-colored-text">
                                          <span class="flag"><img src="{!! $value->getusers->getcountry->getImage() !!}" style="height: 15px;"></span>
                                          <span class="time">{{ $value->getusers->gettimezonedate() }}</span>
                                       </p>
                                    </div>
                                    <div class="bio-desc">
                                       <h3 class="profile-name">{{ $value->getusers->getName() }}</h3>
                                       <h5 class="subtitle">{{ $value->request_title }}</h5>
                                       <h6 class="request-label">
                                          {{ __('find_student.Request_Description') }}
                                       </h6>
                                       <p class="request-desc">
                                          {{ strip_tags(substr($value->request_description,0,700)) }}...
                                       </p>
                                    </div>
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
                                          <span class="history-info">{{ !empty($value->getlanguage->language_name)?$value->getlanguage->language_name: '' }}</span>
                                       </p>
                                       <p class="lesson-history-item">
                                          <span class="history-label text-capitalize d-flex align-items-center">
                                          <i class="fas fa-user"></i>
                                          {{ __('find_student.Request_Type') }}
                                          </span>
                                          <span class="history-info">{{ !empty($value->getrequesttype->request_type_name)?$value->getrequesttype->request_type_name: '' }}</span>
                                       </p>
                                       <p class="lesson-history-item">
                                          <span class="history-label text-capitalize d-flex align-items-center">
                                          <i class="fas fa-signal"></i>
                                          {{ __('find_student.Level_of_Student') }}
                                          </span>
                                          <span class="history-info">{{ !empty($value->getlevelofstudent->level_of_student_name)?$value->getlevelofstudent->level_of_student_name: '' }}</span>
                                       </p>
                                       <p class="lesson-history-item">
                                          <span class="history-label text-capitalize d-flex align-items-center">
                                          <i class="fas fa-list"></i>
                                          {{ __('find_student.Category') }}
                                          </span>
                                          <span class="history-info">{{ !empty($value->getcategory->category_name)?$value->getcategory->category_name: '' }}</span>
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
                                          <span class="history-info">{{ $value->duration }}  {{ __('find_student.munites') }}</span>
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
                        </div>
                     </div>
                  </section>
                  <!-- end: student profile summary -->
                  <!-- start: send offer form box -->
                  <section class="send-offer-form-box">
                     <div class="student-breif d-flex flex-wrap justify-content-between ">
                        <p class="offer single-item w-100 course-title">
                           <span class="label">{{ __('find_student.Course_title') }}</span>
                           <span class="desc">{{ $value->request_title }}</span>
                        </p>
                        <p class="offer single-item">
                           <span class="label">{{ __('find_student.Category_s') }}</span>
                           <span class="desc">{{ !empty($value->getcategory->category_name)?$value->getcategory->category_name: '' }}</span>
                        </p>
                        <p class="offer single-item">
                           <span class="label">
                           {{ __('find_student.Lesson_start_time_s') }}
                           </span>
                           <span class="desc">{{ date('h:i:A', $value->lesson_time) }}</span>
                        </p>
                        <p class="offer single-item">
                           <span class="label">{{ __('find_student.Lesson_date_s') }}</span>
                           <span class="desc">{{ date('Y-m-d', $value->lesson_date) }}</span>
                        </p>
                        <p class="offer single-item">
                           <span class="label">{{ __('find_student.Lesson_duration_s') }}</span>
                           <span class="desc">{{ $value->duration }} {{ __('find_student.minutes') }}</span>
                        </p>
                     </div>
                     <!-- send offer form -->
                     <form action="{{ url('findstudent/sendoffer') }}" method="post" enctype="multipart/form-data" class="send-offer-form">
                        {{ csrf_field() }}
                        <input type="hidden" value="{{ $value->id }}"  required name="request_id">
                        <div class="form-check-inline offer single-item reg-form-check custom">
                           <input type="checkbox" name="free_lesson" id="offer-first-fee-free" class="offer-first-fee-free">
                           <label for="offer-first-fee-free" class="form-check-label">{{ __('find_student.First_Lesson_Free') }}</label>
                           <span class="desc">
                           {{ __('find_student.If_not') }}
                           </span>
                        </div>
                        <div class="form-check-inline offer single-item offer-price hide-offer-price">
                           <label for="offer-first-fee-amount">
                           {{ __('find_student.Set_up_your_offer_Price') }}
                           </label>
                           <span class="currency-sign ml-2">&#36;</span>
                           <input type="number" name="lesson_per_rate" required id="offer-first-fee-amount" class="offer-first-fee-amount">
                           <span class="per-lesson">/{{ __('find_student.Lesson') }}</span>
                        </div>
                        <div class="form-group offer single-item text-message">
                           <label for="offer-text-message">{{ __('find_student.Leave_message_to_this_student') }}</label>
                           <textarea name="description" id="offer-text-message" required class="offer-text-message form-control" cols="10" rows="5"></textarea>
                        </div>
                        <!-- offer tutor info -->
                        <div class="offer-tutor-info offer single-item">
                           <div class="row">
                              <div class="col-xl-5 profile-summary">
                                 <div class="user-profile text-center text-capitalize">
                                    <div class="profile-image">
                                       <img src="{!! $user->getImage() !!}" alt="{{ $user->getName() }}">
                                       @if($user->OnlineUser())
                                       <span class="online-status d-flex align-items-center">
                                       <i class="fas fa-circle"></i> 
                                       {{ __('find_student.Online') }}
                                       </span>
                                       @endif
                                       @if(!empty($user->hour_per_rate))
                                       <span class="lesson-rate">
                                       <span class="price">${{ $user->hour_per_rate }}</span>
                                       <span class="text">/  {{ __('find_student.Lesson') }}</span>
                                       </span>
                                       @endif
                                    </div>
                                    <h3 class="profile-name">{{ $user->getName() }}</h3>
                                    <p class="profile-designation">{{ !empty($user->getcategory->category_name)? $user->getcategory->category_name : '' }}</p>
                                    <div class="rating">
                                       <span class="stars">
                                          {!! $user->getHTMLRating() !!}
                                       </span>
                                       <span class="point">{!! $user->averageRating() !!}</span>
                                       <span class="text">{{ __('find_student.Rating') }}</span>
                                    </div>
                                    <a href="{{ url('tutor-profile/'.$user->id) }}" class="button scrolls view-bio thin-bg">
                                    {{ __('find_student.View_my_bio') }}
                                    </a>
                                    <div class="short-info">
                                       <p class="d-flex justify-content-between">
                                          <span class="label">
                                          {{ __('find_student.Repeat_student') }}
                                          </span>
                                          <span class="value">15</span>
                                       </p>
                                       <p class="d-flex justify-content-between">
                                          <span class="label">
                                          {{ __('find_student.Average_reply_time') }}
                                          </span>
                                          <span class="value">1 {{ __('find_student.Hour') }}</span>
                                       </p>
                                       <p class="d-flex justify-content-between">
                                          <span class="label">
                                          {{ __('find_student.Local_time') }}
                                          </span>
                                          <span class="value">{{ $user->gettimezonedate() }}</span>
                                       </p>
                                    </div>
                                    @if(Auth::user()->is_admin == 3)
                                    <a href="{!! $user->getbooklessonlink() !!}" class="button book-lesson deep-bg">
                                    {{ __('find_student.Book_a_Lesson') }} 
                                    </a>
                                    @endif
                                 </div>
                              </div>
                              <div class="col-xl-7">
                                 <div class="current-lecture">
                                    <label style="margin-bottom: 5px;">
                                    {{ __('find_student.Course') }}
                                    </label>
                                    <select class="form-control" id="get_course_id" required name="course_id">
                                       <option value="">{{ __('find_student.Select_Course') }}</option>
                                       @foreach($user->get_course as $value_c)
                                       <option data-url="{{ $value_c->getVideoCourse() }}" value="{!! $value_c->id !!}">{!! $value_c->course_title !!}</option>
                                       @endforeach
                                    </select>
                                    <br />
                                    <div class="current-lecture-player" id="getVideoURLOffer" style="height: auto;"></div>
                                    <br />
                                    <label style="margin-bottom: 10px;">
                                    {{ __('find_student.Upload_New_Video') }}
                                    </label>
                                    <br />
                                    <input class="form-control" accept="video/*" name="course_video" type="file">
                                 </div>
                              </div>
                           </div>
                        </div>
                        <!-- offer submit button -->
                        <div class="offer-submit-btn-box text-right">
                           <button type="submit" class="booking-submit-btn reg-signup-btn text-capitalize">{{ __('find_student.Send_offer') }}</button>
                        </div>
                     </form>
                  </section>
               </div>
            </div>
         </div>
      </div>
   </div>
</div>