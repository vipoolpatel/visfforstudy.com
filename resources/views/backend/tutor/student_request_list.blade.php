@extends('backend.layouts.app')
@section('style')
  <style type="text/css">
      .modal-dialog {
          max-width: 95%;
      }
   </style>
@endsection 
@section('content')



    <!-- start: request filter/breadcrumb area -->
    <div class="request-filter-area breadcrumb-area">
      <div class="container">
        <div class="row align-items-end justify-content-between flex-lg-nowrap">
          <div class="col-12 col-lg-auto col-xl-auto flex-grow-1 mb-3 mb-lg-0">
            <div class="title-and-status d-md-flex justify-content-between justify-content-lg-start align-items-center">
              <h3 class="page-title breadcrumb-trail">{{ __('tutor.Student_request') }}</h3>
              <div class="status-search">
                <p class="status-text">
                {{-- Add Menu --}}
                </p>
                
              </div>
            </div>
          </div>
          <div class="col-12 col-lg-auto col-xl-auto flex-lg-fill">
            <div class="find-multi-search-box">
              <form action="" class="multi-search-form d-flex align-items-end justify-content-end">
                <div class="form-group price-filter-box">
                  <label for="price-count">{{ __('tutor.Price') }}</label>
                  <select name="price_id" class="price-count form-control">
                    <option value="">{{ __('tutor.Select_Price') }}</option>
                    @foreach($getprice as $value_p) 
                    <option {{ (Request::get('price_id') == $value_p->id) ? 'selected' : '' }} value="{{ $value_p->id }}"> &#36;{{ $value_p->min_price }} - &#36;{{ $value_p->max_price }}</option>
                    @endforeach
                  </select>
                </div>
                <div class="input-group">
                  <div class="form-group">
                    <label for="subject-multi">{{ __('tutor.Select_Subject') }}</label>
                    <select name="category_id" class="subject-multi form-control">
                        <option value="">{{ __('tutor.Subject') }}</option>
                         @foreach ($getcategory as $value_ca)
                        <option {{ (Request()->category_id == $value_ca->id) ? 'selected' : '' }} value="{{ $value_ca->id }}">{{ $value_ca->getcategoryname() }}</option>
                        @endforeach
                    </select>
                  </div>
                  <div class="form-group">
                    <label for="level-multi">{{ __('tutor.Select_Level') }}</label>
                    <select name="level_of_student_id" class="level-multi form-control">
                      <option value="">{{ __('tutor.Select_Level') }}</option>
                        @foreach ($getlevel as $value_level)
                        <option {{ (Request()->level_of_student_id == $value_level->id) ? 'selected' : '' }} value="{{ $value_level->id }}">{{ $value_level->getlevelofstudentname() }}</option>
                        @endforeach
                    </select>
                  </div>
                  <div class="form-group">
                    <label for="lang-multi">{{ __('tutor.Select_Language') }}</label>
                    <select name="language_id" class="lang-multi form-control">
                      <option value="">{{ __('tutor.Language') }}</option>
                      @foreach ($getlanguge as $value_l)
                        <option {{ (Request()->language_id == $value_l->id) ? 'selected' : '' }} value="{{ $value_l->id }}">{{ $value_l->getlanguagename() }}</option>
                      @endforeach
                    </select>
                  </div>
                </div>
                <button type="submit" class="multi-search-submit d-inline-flex align-items-center justify-content-between">
                  <span class="btn-text">{{ __('tutor.Search') }}</span>
                  <i class="fas fa-search"></i>
                </button>
                <a href="{{ url('tutor/student-request') }}" class="multi-search-submit d-inline-flex align-items-center justify-content-between" style="margin-left: 10px;color: #fff;">{{ __('tutor.Reset') }}</a>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
    <!-- end: request filter/breadcrumb area -->



    <!-- start: main content -->
    <div class="main-content view-offer-content">
      <div class="container">
        <div class="row">
          <div class="col-12">
            <!-- start: view offers section -->
            <section class="student-request-section">
              <!-- start: all student request -->
              <div class="section-content all-student-requests">

                {{-- Start --}}
              @foreach($getrecord as $value)
                <div class="single-student-request">
                  <div class="active-request-view d-md-flex justify-content-between">
                    <div class="bio-image">
                      <div class="profile-image text-center text-md-left">
                        <img src="{!! $value->getusers->getImage() !!}" alt="profile-picture">
                      </div>

                    @if(!empty($value->getusers->OnlineUser()))  
                      <p class="local-time thin-colored-text">
                          <span class="text-center online-user-part">
                            <span><i class="fas fa-circle"></i></span>{{ __('tutor.Online') }}
                          </span>
                      </p>
                    @endif

                      <p class="local-time thin-colored-text">
                        <span class="flag"><img src="{{ url('assets/img/iconic-flag-china.png') }}" alt="flag-china"></span>
                        <span class="time">{{ $value->getusers->gettimezonedate() }}</span>
                      </p>
                    </div>
                    <div class="offer-detail">
                      <div class="heading d-xl-flex justify-content-between">
                        <div class="receiver-info">
                          <h3 class="name">
                             {{ ucfirst(!empty($value->getusers->name)?$value->getusers->name: '') }}
                                    {{ ucfirst(!empty($value->getusers->last_name)?$value->getusers->last_name: '') }}
                            <span class="level-name">({{ ucfirst(!empty($value->getlevelofstudent->level_of_student_name)?$value->getlevelofstudent->level_of_student_name: '') }})</span>
                          </h3>
                          <p class="subtitle">{{ $value->request_title }}</p>
                        </div>
                        <div class="rate-time d-flex flex-wrap flex-sm-nowrap justify-content-between align-items-end d-xl-block">
                          <p class="rate text-lg-right">
                            <span class="price">${{ $value->rate_per_hour }}</span>
                            <span class="text">/{{ __('tutor.Lesson') }}</span>
                          </p>
                          <div class="metadata-action-buttons d-flex align-items-center text-capitalize">
                            @if(empty($value->checkAlreadySent(Auth::user()->id)))
                            <a style="cursor: pointer;" id="{{ $value->id }}" class="button message-btn SendofferStudent">{{ __('tutor.Send_offer') }}</a>
                            @endif

                            <a href="{!! $value->getProfileRequestLink() !!}" class="button view-btn">{{ __('tutor.View_profile') }}</a>
                          </div>
                        </div>
                      </div>
                      <p class="description">
                        {!! strip_tags(substr($value->request_description,0,500)) !!}...
                      </p>
                      <div class="metadata d-md-flex flex-wrap justify-content-lg-between">
                        <p class="meta-item">
                          <span class="label">{{ __('tutor.Lesson_type') }}</span>
                          <span class="desc">{{ ucfirst(!empty($value->getrequesttype->request_type_name)?$value->getrequesttype->request_type_name: '') }}
                          </span>
                        </p>
                        <p class="meta-item">
                          <span class="label">{{ __('tutor.Subject') }}:</span>
                          <span class="desc">{{ ucfirst(!empty($value->getcategory->category_name)?$value->getcategory->category_name: '') }}</span>
                        </p>
                        <p class="meta-item">
                          <span class="label">{{ __('tutor.Language') }}:</span>
                          <span class="desc">{{ ucfirst(!empty($value->getlanguage->language_name)?$value->getlanguage->language_name: '') }}</span>
                        </p>
                        <p class="meta-item">
                          <span class="label">{{ __('tutor.Available_time') }}:</span>
                          <span class="desc">{{ date('h:i A',strtotime($value->lesson_start_time)) }}</span>
                        </p>
                        <p class="meta-item">
                          <span class="label">{{ __('tutor.Available_date') }}:</span>
                          <span class="desc">
                          {{ date('Y-m-d',strtotime($value->lesson_start_date)) }}
                        
                        </span>
                        </p>
                        <p class="meta-item">
                          <span class="icon">
                            <img src="{{ url('assets/img/iconic-time-clock.png') }}" alt="clock-icon">
                          </span>
                          <span class="desc"> {{ $value->duration }} {{ __('tutor.Duration') }}</span>
                        </p>
                      </div>
                    </div>
                  </div>
                </div>
                @endforeach
                {{-- End --}}
                <div style="float: right;margin-top: 20px;">
                   {{ $getrecord->appends(Illuminate\Support\Facades\Input::except('page'))->links() }}  
                </div>
                <div style="clear: both;"></div>
                <br />
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
