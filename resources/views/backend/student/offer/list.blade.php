@extends('backend.layouts.app')
@section('style')
<style type="text/css">
   .all-course-table tr > th {
   text-align: left;
   }
   .all-course-table tr > td {
   text-align: left !important;
   }
   .small-btn 
   {
      padding: 1px 5px;font-size: 12px;line-height: 1.5;border-radius: 3px;
   }
</style>
@endsection 
@section('content')
<div class="request-filter-area breadcrumb-area">
   <div class="container">
      <div class="row align-items-end justify-content-between flex-lg-nowrap">
         <div class="col-12 col-lg-auto col-xl-auto flex-grow-1 mb-3 mb-lg-0">
            <div class="title-and-status d-md-flex justify-content-between justify-content-lg-start align-items-center">
               <h3 class="page-title breadcrumb-trail">{{ __('student.Offer_List') }}</h3>
            </div>
         </div>
         <div class="col-12 col-lg-auto col-xl-auto flex-lg-fill">
            <div class="find-multi-search-box">
               <form action="" method="get" class="multi-search-form d-flex align-items-end justify-content-end">
                  <div class="form-group price-filter-box">
                     <label for="price-count">{{ __('student.Price') }}</label>
                     <select  name="price_id" id="price-count" class="price-count form-control">
                        <option value="">{{ __('student.Select_Price') }}</option>
                        @foreach($getprice as $value_p)
                        <option {{ (Request::get('price_id') == $value_p->id) ? 'selected' : '' }} value="{{ $value_p->id }}">&#36;{{ $value_p->min_price }} - &#36;{{ $value_p->max_price }}</option>
                        @endforeach
                     </select>
                  </div>
                  <div class="input-group">
                     <div class="form-group">
                        <label for="subject-multi">{{ __('student.Select_Category') }}</label>
                        <select name="category_id" class="subject-multi form-control">
                           <option value="">{{ __('student.Category') }}</option>
                           @foreach ($getcategory as $value_ca)
                           <option {{ (Request()->category_id == $value_ca->id) ? 'selected' : '' }} value="{{ $value_ca->id }}">{{ $value_ca->getcategoryname() }}</option>
                           @endforeach
                        </select>
                     </div>
                     <div class="form-group">
                        <label for="lang-multi">{{ __('student.Select_Language') }}</label>
                        <select name="language_id" class="lang-multi form-control">
                           <option value="">{{ __('student.Language') }}</option>
                           @foreach ($getlanguge as $value_l)
                           <option {{ (Request()->language_id == $value_l->id) ? 'selected' : '' }} value="{{ $value_l->id }}">{{ $value_l->getlanguagename() }}</option>
                           @endforeach
                        </select>
                     </div>
                     <div class="form-group">
                        <label for="level-multi">{{ __('student.Select_Level') }}</label>
                        <select name="level_id" class="level-multi form-control">
                           <option value="">{{ __('student.Select_Level') }}</option>
                           @foreach ($getlevel as $value_level)
                           <option {{ (Request()->level_id == $value_level->id) ? 'selected' : '' }} value="{{ $value_level->id }}">{{ $value_level->getlevelofstudentname() }}</option>
                           @endforeach
                        </select>
                     </div>
                     <div class="form-group">
                        <label for="level-multi">{{ __('student.Title') }}</label>
                        <input type="text" name="title" value="{{ Request()->title }}" class="form-control" placeholder="{{ __('student.Enter_a_name') }}" style="width: 174px;height: 35px;">
                     </div>
                  </div>
                  <button type="submit" class="multi-search-submit d-inline-flex align-items-center justify-content-between">
                  <span class="btn-text">{{ __('student.Search') }}</span>
                  <i class="fas fa-search"></i>
                  </button>
                  <a href="{{ url('student/offer-page') }}" class="multi-search-submit d-inline-flex align-items-center justify-content-between" style="margin-left: 10px;color: #fff;">{{ __('student.Reset') }}</a>
               </form>
            </div>
         </div>
      </div>
   </div>
</div>

<div class="main-content all-offer-content">
   <div class="container">
      <div class="row">
         <div class="col-12">
            <!-- start: all offer content -->
            <section class="all-offer-section">
               
               <div class="all-course-view">
                  <div class="course-tabulation w-100">
                     <div class="tab-content all-course-list-box">
                        <table class="all-course-table">
                           <thead>
                              <tr class="course-list-heading">
                                 <th>{{ __('student.Offer_ID') }}</th>
                                 <th>{{ __('student.Teacher_name') }}</th>
                                 <th>{{ __('student.Title') }}</th>
                                 <th>{{ __('student.Category') }}</th>
                                 
                                 <th>{{ __('student.Lesson_Date_Time') }}</th>
                                 <th>{{ __('student.Duration') }}</th>
                                 <th>{{ __('student.Price') }} </th>
                                 <th>{{ __('student.Created_Date') }}</th>
                                 <th style="width: 10%">{{ __('student.Payment') }}</th>
                                 <th>{{ __('student.Action') }}</th>
                              </tr>
                           </thead>
                           <tbody>
                              @forelse($getrecord as $value)
                              <tr class="single-course-item">
                                 <td>{{ $value->id }}</td>
                                 <td class="teacher-name" data-title="Teacher name">
                                    <span class="info-wrap">
                                    @if($value->getusers->OnlineUser())
                                    <i class="fa fa-circle online-user"></i>
                                    @endif
                                    <span class="image">
                                    <img src="{!! $value->getusers->getImage() !!}" alt="tutor-image">
                                    </span>

                                    <a href="{!! $value->getusers->getProfileTutorLink() !!}">
                                       <span class="name">
                                       {{ ucfirst(!empty($value->getusers->name)?$value->getusers->name: '') }}
                                       {{ ucfirst(!empty($value->getusers->last_name)?$value->getusers->last_name: '') }}
                                       </span>
                                    </a>
                                    
                                    </span>
                                 </td>
                                 <td>{{ $value->title }}  </td>
                                 
                                 <td>{{ ucfirst(!empty($value->getlanguage->language_name)?$value->getlanguage->language_name: '') }}</td>
                                 <td>{{ date('Y-m-d',$value->lesson_date) }} - {{ date('h:i A', $value->lesson_time) }}</td>
                                 <td>{{ $value->duration }} Minutes</td>
                                 <td>{{ !empty($value->lesson_per_rate) ? '$'.$value->lesson_per_rate : 'Free'  }}</td>
                                 <td>{{ date('Y-m-d h:i A', strtotime($value->created_at)) }}</td>
                                 <td>
                                    @if(!empty($value->is_payment))
                                       <span class="btn btn-success small-btn">{{ __('student.Booked') }}</span>
                                    @else
                                       <a href="{{ url('student/offer/payment/'.$value->id) }}" class="btn btn-danger">{{ __('student.Book_Now') }}</a>
                                    @endif
                                 </td>
                                 <td>
                                    <a href="{{ url('student/offer-page/view/'.$value->id) }}" class="btn btn-primary"><i class="far fa-eye"></i></a>

                                    @if(!empty($value->is_payment))
                                          <a href="" class="btn btn-danger">Join Class Room</a>
                                    @endif

                                 </td>
                              </tr>
                              @empty
                              <tr  class="single-course-item">
                                 <td colspan="100%">{{ __('student.Record_not_found') }}</td>
                              </tr>
                              @endforelse
                           </tbody>
                        </table>
                        <div style="clear: both;"></div>
                        <div style="float: right;margin-top: 20px;">
                           {{ $getrecord->appends(Illuminate\Support\Facades\Input::except('page'))->links() }}  
                        </div>
                        <div style="clear: both;"></div>
                        <br />
                     </div>
                  </div>
               </div>
            </section>
            <!-- end: all offer content -->
         </div>
      </div>
   </div>
</div>
<!-- end: main content -->
@endsection