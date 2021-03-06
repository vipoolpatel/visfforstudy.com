@extends('backend.layouts.app')

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
               <h2 class="hero-title text-capitalize">{{ __('admin.Add_Seo') }}</h2>

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
                        <form action="{{ url('admin/seo/add') }}" method="post" class="booking-form request-form" enctype="multipart/form-data">

                           {{ csrf_field() }}

                           <div class="text-message">
                            <div class="form-group">
                               <label>Slug</label>
                               <input value="{{ old('slug') }}" required type="text" name="slug" class="form-control"/>
                               <span style="color:red">{{  $errors->first('slug') }}</span>
                            </div>
                          </div>

                           <div class="text-message">
                            <div class="form-group">
                               <label>{{ __('admin.Title') }}</label>
                               <input type="text" value="{{ old('title') }}" required name="title" class="form-control"/>

                            </div>
                         </div>

                         <div class="text-message">
                            <div class="form-group">
                               <label>{{ __('admin.Keyword') }}</label>
                               <input type="text" name="keyword" value="{{ old('keyword') }}" class="form-control"/>

                            </div>
                         </div>

                         <div class="text-message">
                            <div class="form-group">
                               <label>{{ __('admin.Description') }}</label>
                               <textarea name="description" class="booking-message request-message form-control" placeholder="Description... " cols="10" rows="5">{{ old('description') }}</textarea>
                            </div>
                         </div>



                           <button type="submit" class="request-submit-btn reg-signup-btn text-capitalize">{{ __('admin.Submit') }}</button>

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
