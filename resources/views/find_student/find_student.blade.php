@extends('layouts.app')
{{-- @section('stylesheet')
<style type="text/css"></style>
@endsection  --}}
@section('content')
<!-- start: hero area -->
<section class="hero-area">
   <div class="hero-bg" style="background-image: url({{ url('assets/img/banner-bg/banner-bg-4.jpg')  }});"></div>
   <div class="hero-overlay"></div>
   <div class="container h-100">
      <div class="row justify-content-center align-items-lg-center h-100">
         <!-- hero main content -->
         <div class="col-12 h-100">
            <!-- hero main content -->
            <div class="hero-main-content">
               <h2 class="hero-title text-capitalize">{{ __('find_student.Find_your_students_here') }}</h2>
               <div class="find-multi-search-box">
                  <form action="" class="multi-search-form d-flex align-items-end" id="filter-form" method="get">
                     <input type="hidden" id="get_price_id" name="price_id" value="{{ Request::get('price_id') }}">
                     <input type="hidden" id="get_sort_id" name="sort_id" value="{{ Request::get('sort_id') }}">
                     <input type="hidden" id="get_find_by_date" name="find_by_date" value="{{ Request::get('find_by_date') }}">
                     <input type="hidden" id="get_online" name="online" value="{{ Request::get('online') }}">

                     <div class="input-group">
                        <div class="form-group">
                           <label for="subject-multi">
                           {{ __('find_student.Language') }}
                           </label>
                           <select name="language_id" class="subject-multi form-control">
                              <option value="">{{ __('find_student.Select_Language') }}</option>
                              @foreach ($getlanguge as $value_l)
                              <option {{ (Request()->language_id == $value_l->id) ? 'selected' : '' }} value="{{ $value_l->id }}">{{ $value_l->getlanguagename() }}</option>
                              @endforeach
                           </select>
                        </div>
                        <div class="form-group">
                           <label for="level-multi">{{ __('find_student.Level') }}</label>
                           <select name="level_of_student_id" class="level-multi form-control">
                              <option value="">{{ __('find_student.Select_Level') }}</option>
                              @foreach ($getlevel as $value_level)
                              <option {{ (Request()->level_of_student_id == $value_level->id) ? 'selected' : '' }} value="{{ $value_level->id }}">{{ $value_level->getlevelofstudentname() }}</option>
                              @endforeach
                           </select>
                        </div>
                        <div class="form-group">
                           <label for="lang-multi">{{ __('find_student.Request_Type') }}</label>
                           <select name="request_type_id" class="lang-multi form-control">
                              <option value="">{{ __('find_student.Select_Request_Type') }}</option>
                              @foreach ($getrequesttype as $value_request)
                              <option {{ (Request()->request_type_id == $value_request->id) ? 'selected' : '' }} value="{{ $value_request->id }}">{{ $value_request->getrequesttypename() }}</option>
                              @endforeach
                           </select>
                        </div>
                     </div>
                     <button type="submit" class="multi-search-submit d-inline-flex align-items-center justify-content-between">
                     <span class="btn-text">{{ __('find_student.Search') }}</span>
                     <i class="fas fa-search"></i>
                     </button>
                  </form>
               </div>
               <!-- status search -->
               <div class="status-search">
                  <p class="status-text">
                     {{ __('find_student.Click_Here_to_See') }}
                    
                  </p>
                  <a href="#" id="click-online" class="button online-check-btn">
               {{ __('find_student.Online') }}
                  </a>
               </div>


                     <div class="advaned-filter-box d-flex justify-content-between align-items-end">
                  <!-- date selection -->
                  <div class="date-selection status-search">
                     <p class="date-select-text status-text">
                      
                        {{ __('find_student.Choose_your_available') }}
                     </p>
                     <form action="index.html" class="date-select-form">
                        <input type="date" value="{{ Request::get('find_by_date') }}" id="find_by_date" style="padding: 0px;padding-left: 10px;" class="find-by-date form-control">
                     </form>
                  </div>
                  <!-- tutor count filter -->
                  <div class="search-count-filter-box">
                     <form action="index.html" class="search-count-filter d-flex">
                        <div class="form-group">
                           <label for="price-count">{{ __('find_student.Price') }}</label>
                           <select name="price-count" id="price-count" class="price-count form-control">
                              <option value="">{{ __('find_student.Select_Price') }}</option>
                              @foreach($getprice as $value_p)
                                 <option {{ (Request::get('price_id') == $value_p->id) ? 'selected' : '' }} value="{{ $value_p->id }}">&#36;{{ $value_p->min_price }} - &#36;{{ $value_p->max_price }}</option>
                              @endforeach
                              
                              
                           </select>
                        </div>
                        <div class="form-group">
                           <label for="name-sort">{{ __('find_student.Sort_by') }}</label>
                           <select name="name-sort" id="name-sort" class="name-sort form-control">
                              <option value="">{{ __('find_student.Select') }}</option>
                              <option {{ (Request::get('sort_id') == '1') ? 'selected' : '' }} value="1">{{ __('find_student.Latest_published') }}</option>
                              <option {{ (Request::get('sort_id') == '2') ? 'selected' : '' }} value="2">{{ __('find_student.Most_reviews') }}</option>
                              <option {{ (Request::get('sort_id') == '3') ? 'selected' : '' }} value="3">{{ __('find_student.High_price') }}</option>
                           </select>
                        </div>
                     </form>
                  </div>
               </div>
            </div>
         </div>
      </div>
   </div>
</section>
<!-- end: hero area -->
<!-- start: main content -->
<div id="main-content" class="main-content">
   <div class="container">
      <div class="row">
         <div class="col-lg-8 mx-auto">
            <!-- start: all students -->
            <section class="morestudents all-students">
               <div class="section-content">
                  <!-- profile list -->
                  <div class="profile-list">
                     @include('find_student._find_student_html')
                  </div>
                  <div style="margin-top: 30px; float: right;">
                     {{ $getrecord->appends(Illuminate\Support\Facades\Input::except('page'))->links() }}   
                  </div>
               </div>
            </section>
            <!-- end: all students -->
         </div>
      </div>
   </div>
</div>

<div class="modal fade getSetudentData" id="getSetudentData" tabindex="-1" role="dialog" aria-labelledby="studentPop1Title" aria-hidden="true"></div>


<!-- end: main content -->
@endsection
@section('script')
<script type="text/javascript">
   $('#price-count').change(function(){
         var price_id = $(this).val();
         $('#get_price_id').val(price_id);
         $('#filter-form').submit();
   });

   $('#name-sort').change(function(){
         var sort_id = $(this).val();
         $('#get_sort_id').val(sort_id);
         $('#filter-form').submit();
   });

   $('#find_by_date').change(function(){
         var find_by_date = $(this).val();
         $('#get_find_by_date').val(find_by_date);
         $('#filter-form').submit();
   });

   $('#click-online').click(function(){
         $('#get_online').val('1');
         $('#filter-form').submit();
   });
</script>
@endsection
