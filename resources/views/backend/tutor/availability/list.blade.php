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
               <h2 class="hero-title text-capitalize">My Availability</h2>
               <div class="hero-booking-featuers">
                  <ul class="lesson-booking-features reg-form-guide-list">
                     <li class="single-booking-feature">
                        {{ __('tutor.You_will_get_all_Student_reviews') }}
                     </li>
                     <li class="single-feature">
                        {{ __('tutor.You_will_find_your_Student_faster') }}
                     </li>
                     <li class="single-feature">
                        {{ __('tutor.Your_Offer_will_be_seen_by_all_of_Students') }}
                     </li>
                  </ul>
               </div>
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
                     <div class="find-multi-search-box booking-form-container" style="margin-top: 50px;">
                        <form action="" method="post" class="booking-form request-form" enctype="multipart/form-data">
                           {{ csrf_field() }}
                           <div class="multi-search-form d-flex align-items-end">
                              <div class="input-group">
                                 <div class="form-group">
                                    <table class="avail-table">
                                       <thead>
                                          <th></th>
                                          @foreach ($getWeek as $value_week)
                                          <th>{{ $value_week->week_name }}</th>
                                          @endforeach
                                       </thead>
                                       <tbody>
                                          @php
                                          $i = 1;
                                          $j = 1;
                                          @endphp
                                          @foreach ($getWeekSession as $value_week_session)
                                          <tr>
                                             <th>
                                                <div class="day-period d-flex align-items-center">
                                                   <span>
                                                   <img src="{{ url('assets/img/'.$value_week_session->week_session_icon) }}" alt="morning">
                                                   </span>
                                                   <div>
                                                      <p>{{ $value_week_session->week_session_name }}</p>
                                                      <small>{{ $value_week_session->week_session_time }}</small>
                                                   </div>
                                                </div>
                                             </th>
                                             <td>
                                                
                                                <input type="hidden" value="1" name="option[{{ $j++ }}][week_id]">
                                                <input type="checkbox" {{ !empty($value_week_session->getcount(1,Auth::user()->id)) ? 'checked' : '' }} value="{{ $value_week_session->id }}" name="option[{{ $i++ }}][week_session_id]"> 
                                             </td>
                                             <td>
                                                <input type="hidden" value="2" name="option[{{ $j++ }}][week_id]">
                                                <input type="checkbox" {{ !empty($value_week_session->getcount(2,Auth::user()->id)) ? 'checked' : '' }} value="{{ $value_week_session->id }}" name="option[{{ $i++ }}][week_session_id]">
                                             </td>
                                             <td>
                                                <input type="hidden" value="3" name="option[{{ $j++ }}][week_id]">
                                                <input type="checkbox" {{ !empty($value_week_session->getcount(3,Auth::user()->id)) ? 'checked' : '' }} value="{{ $value_week_session->id }}" name="option[{{$i++ }}][week_session_id]">
                                             </td>
                                             <td>
                                                <input type="hidden" value="4" name="option[{{ $j++ }}][week_id]">
                                                <input type="checkbox" {{ !empty($value_week_session->getcount(4,Auth::user()->id)) ? 'checked' : '' }} value="{{ $value_week_session->id }}" name="option[{{ $i++ }}][week_session_id]">
                                             </td>
                                             <td>
                                                <input type="hidden" value="5" name="option[{{ $j++ }}][week_id]">
                                                <input type="checkbox" {{ !empty($value_week_session->getcount(5,Auth::user()->id)) ? 'checked' : '' }} value="{{ $value_week_session->id }}" name="option[{{ $i++ }}][week_session_id]">
                                             </td>
                                             <td>
                                                <input type="hidden" value="6" name="option[{{ $j++ }}][week_id]">
                                                <input type="checkbox" {{ !empty($value_week_session->getcount(6,Auth::user()->id)) ? 'checked' : '' }} value="{{ $value_week_session->id }}" name="option[{{ $i++ }}][week_session_id]">
                                             </td>
                                             <td>
                                                <input type="hidden" value="7" name="option[{{ $j++ }}][week_id]">
                                                <input type="checkbox" {{ !empty($value_week_session->getcount(7,Auth::user()->id)) ? 'checked' : '' }} value="{{ $value_week_session->id }}" name="option[{{ $i++ }}][week_session_id]">
                                             </td>
                                          </tr>
                                          @php
                                          $i++;
                                          $j++;
                                          @endphp
                                          @endforeach
                                       </tbody>
                                    </table>
                                 </div>
                              </div>
                           </div>

                           <button type="submit" class="request-submit-btn reg-signup-btn text-capitalize">Submit</button>

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
