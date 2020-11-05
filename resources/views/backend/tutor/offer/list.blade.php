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
               <h3 class="page-title breadcrumb-trail"> {{ __('tutor.Offer_List') }}</h3>
               <div class="status-search">
                  <p class="status-text">
                     <a href="{{ url('tutor/offer/add') }}" style="margin-left: 10px;" class="btn btn-danger">{{ __('tutor.Add_new_Offer') }}</a>
                  </p>
               </div>
            </div>
         </div>
         <div class="col-12 col-lg-auto col-xl-auto flex-lg-fill">
            <div class="find-multi-search-box">
               <form action="" id="filter-form" method="get" class="multi-search-form d-flex align-items-end justify-content-end">

                  <div class="form-group price-filter-box">
                     <label for="price-count">{{ __('tutor.Price') }} </label>
                     <select name="price_id" id="price-count" class="price-count form-control">
                        <option value="">{{ __('tutor.Select_Price') }}</option>
                        @foreach($getprice as $value_p)
                        <option {{ (Request::get('price_id') == $value_p->id) ? 'selected' : '' }} value="{{ $value_p->id }}">&#36;{{ $value_p->min_price }} - &#36;{{ $value_p->max_price }}</option>
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
                        <select name="level_id" class="level-multi form-control">
                          <option value="">{{ __('tutor.Select_Level') }}</option>
                            @foreach ($getlevel as $value_level)
                            <option {{ (Request()->level_id == $value_level->id) ? 'selected' : '' }} value="{{ $value_level->id }}">{{ $value_level->getlevelofstudentname() }}</option>
                            @endforeach
                        </select>
                      </div>   
 
                    

                     <div class="form-group">
                        <label for="level-multi">{{ __('tutor.Select_Status') }}</label>
                        <select name="status" class="level-multi form-control">
                          <option value="">{{ __('tutor.Select_Status') }}</option>
                          @foreach ($getstatus as $value_s)
                          <option {{ (Request()->status == $value_s->id) ? 'selected' : '' }} value="{{ $value_s->id }}">{{ $value_s->getstatusname() }}</option>
                          @endforeach
                        </select>
                      </div>

                      <div class="form-group">
                        <label for="level-multi">{{ __('tutor.Offer_Title') }}</label>
                        <input type="text" name="title" value="{{ Request()->title }}" class="form-control" placeholder="{{ __('tutor.Enter_a_name') }}" style="width: 150px;height: 35px;">
                     </div>
                    

                   </div>
                  <button type="submit" class="multi-search-submit d-inline-flex align-items-center justify-content-between">
                     <span class="btn-text">{{ __('tutor.Search') }}</span>
                     <i class="fas fa-search"></i>
                  </button>

                     <a href="{{ url('tutor/offer') }}" class="multi-search-submit d-inline-flex align-items-center justify-content-between" style="margin-left: 10px;color: #fff;">{{ __('tutor.Reset') }}</a>

               </form>
            </div>
         </div>
      </div>
   </div>
</div>
<!-- end: breadcrumb area -->




<div class="main-content all-course-content">
   <div class="container">
      <div class="row">
         <div class="col-12">
            <section class="all-course-section">
               <div class="all-course-view">
                  <div class="course-tabulation w-100">
                     <div class="tab-content all-course-list-box">
                         <table class="all-course-table">
                              <thead>
                                 <tr class="course-list-heading">
                                    <th>{{ __('tutor.ID') }}</th>
                                    <th>{{ __('tutor.Student_Name') }}</th>
                                    <th>{{ __('tutor.Title') }}</th>
                                    <th>{{ __('tutor.Subject') }} </th>
                                    <th>{{ __('tutor.Level') }}</th>
                                    <th>
                                    {{ __('tutor.Lesson_Date_Time') }}</th>
                                    <th>{{ __('tutor.Duration') }}</th>
                                    <th>{{ __('tutor.Price_doler') }}</th>
                                    <th>{{ __('tutor.Status') }}</th>
                                    <th>{{ __('tutor.Payment') }}</th>
                                    <th>{{ __('tutor.Created_Date') }}</th>
                                    <th>{{ __('tutor.Action') }}</th>
                                 </tr>
                              </thead>
                              <tbody>
                                 @forelse($getrecord as $value)
                                 <tr class="single-course-item">
                                    <td>{{ $value->id }}</td>
                                    <td class="teacher-name" data-title="Teacher name">
                                       <span class="info-wrap">
                                       @if($value->getstudent->OnlineUser())
                                       <i class="fa fa-circle online-user"></i>
                                       @endif
                                       <span class="image">
                                       <img src="{!! $value->getstudent->getImage() !!}" alt="tutor-image">
                                       </span>
                                       <span class="name">
                                       {{ ucfirst(!empty($value->getstudent->name)?$value->getstudent->name: '') }}
                                       {{ ucfirst(!empty($value->getstudent->last_name)?$value->getstudent->last_name: '') }}
                                       </span>
                                       </span>
                                    </td>

                                    <td>{{ $value->title }}</td>
                                    <td>
                                       {{ ucfirst(!empty($value->getcategory->category_name)?$value->getcategory->category_name: '') }}
                                    </td>
                                    <td>
                                       {{ ucfirst(!empty($value->getlevel->level_of_student_name)?$value->getlevel->level_of_student_name: '') }}
                                    </td>

                                    
                                    <td>{{ $value->start_date }} - {{ date('h:i A', strtotime($value->start_time)) }}</td>
                                    <td>{{ $value->duration }} {{ __('tutor.Minutes') }}</td>
                                    <td>${{ $value->lesson_per_rate }}</td>
                                    <td><span style="color: {{ $value->getstatus->color_code }}">{{ $value->getstatus->status_name }}</span></td>

                                    <td>
                                     @if(!empty($value->is_payment))
                                       <span class="btn btn-success small-btn">{{ __('tutor.Booked') }}</span>
                                    @else
                                        <span class="btn btn-danger small-btn">{{ __('tutor.Pending') }}</span>
                                    @endif

                                    </td>

                                    <td>{{ date('d-m-Y h:i A', strtotime($value->created_at)) }}</td>
                        

                                    <td class="action" data-title="Action">
                                       <span class="action-btn-wrap">

                                       <a href="{{ url('tutor/offer/view/'.$value->id) }}" class="btn btn-success"><i class="far fa-eye"></i></a>

                                       @if($value->status != 2)
                                       <a href="{{ url('tutor/offer/edit/'.$value->id) }}" class="btn btn-primary"> <i class="fas fa-edit"></i></a>
                                       @endif
                                        @if(empty($value->is_payment))
                                        <button onclick="delete_record('{{ url('tutor/offer/delete/'.$value->id) }}')" class="btn btn-danger"><i class="far fa-trash-alt"></i></button>
                                        @endif

                                        @if(!empty($value->is_payment))
                                        <a href="" class="btn btn-danger">Join Class Room</a>
                                        @endif


                                       </span>
                                    </td>
                                 </tr>
                                 @empty
                                 <tr  class="single-course-item">
                                    <td colspan="100%">{{ __('tutor.Record_not_found') }}</td>
                                 </tr>
                                 @endforelse
                              </tbody>
                           </table>

                        <div style="clear: both;"></div>
                        <div style="float: right;margin-top: 10px;">
                           {{ $getrecord->appends(Illuminate\Support\Facades\Input::except('page'))->links() }}
                        </div>
                        <div style="clear: both;"></div>
                        <br />

                     </div>
                  </div>
               </div>
            </section>
         </div>
      </div>
   </div>
</div>
@endsection

@section('script')

@endsection
