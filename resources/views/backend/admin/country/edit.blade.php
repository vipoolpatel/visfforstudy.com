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
               <h2 class="hero-title text-capitalize">Edit Country</h2>

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
                        <form action="{{ url('admin/country/edit/'. $record->id) }}" method="post" class="booking-form request-form" enctype="multipart/form-data">

                           {{ csrf_field() }}

                           <div class="multi-search-form d-flex align-items-end">
                              <div class="input-group">
                                 {{-- <div class="form-group">
                                    <label style="font-size: 18px;">Name</label>
                                    <input type="text" class="form-control" name="name" value="{{ old('name',$record->name) }}">
                                 </div> --}}
                                 <div class="form-group">
                                    <label style="font-size: 18px;">Nicename</label>
                                    <input type="text" class="form-control" name="nicename" required value="{{ old('nicename',$record->nicename) }}">
                                 </div>
                                 <div class="form-group">
                                    <label style="font-size: 18px;">Chinese Name</label>
                                    <input name="ch_nicename" required type="text" class="form-control" value="{{ old('ch_nicename',$record->ch_nicename) }}" >

                                 </div>

                              </div>
                           </div>

                           {{-- <div class="multi-search-form d-flex align-items-end">
                              <div class="input-group">
                                 <div class="form-group">
                                    <label style="font-size: 18px;">Code</label>
                                    <input type="text" class="form-control" name="code" value="{{ old('code',$record->code) }}">
                                 </div>
                                 <div class="form-group">
                                    <label style="font-size: 18px;"> Code 2</label>
                                    <input type="text" class="form-control" name="code2" value="{{ old('code2',$record->code2) }}">
                                 </div>
                                 <div class="form-group">
                                    <label style="font-size: 18px;">Number Code</label>
                                    <input type="text" class="form-control" name="numcode" value="{{ old('numcode',$record->numcode) }}">
                                 </div>
                              </div>
                           </div>
 --}}



                         {{--   <div class="form-group" style="max-width: 700px !important;">
                              <label>Phone Code</label>
                               <input type="text" name="phonecode" value="{{ old('phonecode',$record->phonecode) }}"  class="form-control">
                           </div>
 --}}


        <div class="form-group publish-course-image" style="max-width: 700px !important;">
         <label for="publish-course-image">Country Flag</label>
         <div class="upload-file-wrap form-control">
            <input type="file" name="image_name"  accept="image/*" class="publish-course-image upload-field">
         </div>
         
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
