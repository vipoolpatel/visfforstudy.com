@extends('backend.layouts.app')

@section('content')
<!-- start: hero area -->
<section class="hero-area loggedin-hero-area">
   <div class="hero-bg" style="background-image: url({{ url('assets/img/banner-bg/banner-bg-5.jpg') }});"></div>
   <div class="hero-overlay"></div>
   <div class="container h-100">
      <div class="row align-items-lg-center h-100">

         <div class="col-12 col-lg-11 offset-lg-1 h-100">

            <div class="hero-main-content">
               <h2 class="hero-title text-capitalize">{{ __('admin.Edit_Social') }}</h2>
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
            <!-- start: request section -->
            <section class="booking-section">
               <div class="row">
                   
                  <div class="col-lg-11 offset-lg-1">
                   
                     <div class="find-multi-search-box booking-form-container">
                        <form action="{{ url('admin/social-icon/edit/'. $record->id) }}" method="post" class="booking-form request-form" enctype="multipart/form-data">

                           {{-- <div class="form-group title-field">
                               @include('message')
                           </div> --}}

                           {{ csrf_field() }}
                          
            
                                 <div class="form-group">
                                    <label style="font-size: 18px;">{{ __('admin.Icon_Name') }}</label>
                                    <input type="text" class="form-control" name="icon_name" value="{{ old('icon_name',$record->icon_name) }}">
                                 </div>
                                 <div class="form-group">
                                    <label style="font-size: 18px;">{{ __('admin.Social_Link') }} </label>
                                    <input type="text" class="form-control" name="social_link" value="{{ old('social_link',$record->social_link) }}">
                                 </div>
                                
                           <button type="submit" class="request-submit-btn reg-signup-btn text-capitalize">{{ __('admin.Update') }}</button>

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

