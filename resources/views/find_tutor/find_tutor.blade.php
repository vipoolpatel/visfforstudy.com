@extends('layouts.app')
@section('content')
<section class="hero-area">
   <div class="hero-bg" style="background-image: url({{ url('assets/img/banner-bg/banner-bg-6.jpg')  }});"></div>
   <div class="hero-overlay"></div>
   <div class="container h-100">
      <div class="row justify-content-center align-items-lg-center h-100">
         <!-- hero main content -->
         <div class="col-12 h-100">
            <!-- hero main content -->
            <div class="hero-main-content">
               <h2 class="hero-title text-capitalize">
{{ __('find_tutor.Find_The_Tutor_That_Best_Match_For_You') }}
               </h2>
               <!-- find multi search form -->
               <div class="find-multi-search-box">
                  <form action="" id="filter-form" class="multi-search-form d-flex align-items-end" method="get">
                     <input type="hidden" name="category_id" value="{{ Request::get('category_id') }}">
                     <input type="hidden" id="get_price_id" name="price_id" value="{{ Request::get('price_id') }}">
                     <input type="hidden" id="get_sort_id" name="sort_id" value="{{ Request::get('sort_id') }}">
                     <input type="hidden" id="get_find_by_date" name="find_by_date" value="{{ Request::get('find_by_date') }}">
                     
                     
                     <div class="input-group">
                        <div class="form-group">
                           <label for="subject-multi">{{ __('find_tutor.Keyword') }}</label>
                           <input type="text" name="category" placeholder="{{ __('find_tutor.Try_Search_Math_or_English') }}" value="{{ Request()->get('category') }}" class="level-multi form-control">
                        </div>
                        <div class="form-group">
                           <label for="level-multi">{{ __('find_tutor.Level') }}</label>
                           <select name="level_of_teacher" class="level-multi form-control">
                              <option value="">{{ __('find_tutor.Select_Level') }}</option>
                              @foreach ($getlevel as $value_level)
                              <option {{ (Request()->level_of_teacher == $value_level->id) ? 'selected' : '' }} value="{{ $value_level->id }}">{{ $value_level->getlevelofstudentname() }}</option>
                              @endforeach
                           </select>
                        </div>
                        <div class="form-group">
                           <label for="lang-multi">{{ __('find_tutor.Languge') }}</label>
                           <select name="languge_id" class="lang-multi form-control">
                              <option value="">{{ __('find_tutor.Select_Languge') }}</option>
                              @foreach ($getlanguge as $value_l)
                              <option {{ (Request()->languge_id == $value_l->id) ? 'selected' : '' }} value="{{ $value_l->id }}">{{ $value_l->getlanguagename() }}</option>
                              @endforeach
                           </select>
                        </div>
                     </div>
                     <button type="submit" class="multi-search-submit d-inline-flex align-items-center justify-content-between">
                     <span class="btn-text">{{ __('find_tutor.Search') }}</span>
                     <i class="fas fa-search"></i>
                     </button>
                  </form>
               </div>
               <!-- status search -->
               <div class="category-search status-search">
                  <p class="category-text status-text">
                     
                     {{ __('find_tutor.Click_Here_to_Select_Categories') }}
                  </p>
                  @foreach ($getcategory as $value_category)
                     @php
                        $button_active = '';
                     @endphp
                     @if(Request::get('category_id') == $value_category->id)
                        @php
                           $button_active = 'button-active';
                        @endphp
                     @endif

                  <a href="{{ url('find-tutor?category_id='. $value_category->id) }}" class="button category-btn {{$button_active}}">{!! $value_category->getcategoryname() !!}</a>
                  @endforeach
               </div>
               <!-- date selection and count filter -->
               <div class="advaned-filter-box d-flex justify-content-between align-items-end">
                  <!-- date selection -->
                  <div class="date-selection status-search">
                     <p class="date-select-text status-text">
                {{ __('find_tutor.Choose_your_available') }}
                     </p>
                     <form action="index.html" class="date-select-form">
                        <input type="date" value="{{ Request::get('find_by_date') }}" id="find_by_date" style="padding: 0px;padding-left: 10px;" class="find-by-date form-control">
                     </form>
                  </div>
                  <!-- tutor count filter -->
                  <div class="search-count-filter-box">
                     <form action="index.html" class="search-count-filter d-flex">
                        <div class="form-group">
                           <label for="price-count"> {{ __('find_tutor.Price') }}</label>
                           <select name="price-count" id="price-count" class="price-count form-control">
                              <option value="">{{ __('find_tutor.Select_Price') }}</option>
                              @foreach($getprice as $value_p)
                                 <option {{ (Request::get('price_id') == $value_p->id) ? 'selected' : '' }} value="{{ $value_p->id }}">&#36;{{ $value_p->min_price }} - &#36;{{ $value_p->max_price }}</option>
                              @endforeach
                              
                              
                           </select>
                        </div>
                        <div class="form-group">
                           <label for="name-sort">{{ __('find_tutor.Sort_by') }}</label>
                           <select name="name-sort" id="name-sort" class="name-sort form-control">
                              <option value="">{{ __('find_tutor.Select') }}</option>
                              <option {{ (Request::get('sort_id') == '1') ? 'selected' : '' }} value="1">{{ __('find_tutor.Latest_published') }}</option>
                              <option {{ (Request::get('sort_id') == '2') ? 'selected' : '' }} value="2">{{ __('find_tutor.Most_reviews') }}</option>
                              <option {{ (Request::get('sort_id') == '3') ? 'selected' : '' }} value="3">{{ __('find_tutor.High_price') }}</option>
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
            <!-- start: all teachers -->
            <section class="morestudents all-students all-teachers">
               <div class="section-content">
                  <!-- profile list -->
                  <div class="profile-list">
                     @include('find_tutor._find_tutor_html')
                  </div>
                  <div style="margin-top: 30px; float: right;">
                     {{ $getrecord->appends(Illuminate\Support\Facades\Input::except('page'))->links() }}   
                  </div>
               </div>
            </section>
            <!-- end: all teachers -->
         </div>
      </div>
   </div>
</div>
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

   
   
</script>
@endsection 
