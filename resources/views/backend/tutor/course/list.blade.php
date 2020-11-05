@extends('backend.layouts.app')
@section('style')
<style type="text/css">
   .all-course-table tr > th {
   text-align: left;
   }
   .all-course-table tr > td {
   text-align: left !important;
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
                  <h3 class="page-title breadcrumb-trail"> {{ __('tutor.Course_List') }}</h3>
                  <div class="status-search">
                     <p class="status-text">
                        <a href="{{ url('tutor/new-course') }}" style="margin-left: 10px;" class="btn btn-danger"> {{ __('tutor.Add_new_Course') }}</a>
                     </p>
                  </div>
               </div>
            </div>
            <div class="col-12 col-lg-auto col-xl-auto flex-lg-fill">
               <div class="find-multi-search-box">
                  <form action="" id="filter-form"  class="multi-search-form d-flex align-items-end justify-content-end" method="get">
                     
                     <div class="form-group price-filter-box">
                        <label for="price-count">{{ __('tutor.Price') }}</label>
                        <select name="price_id" id="price-count" class="price-count form-control">
                           <option value="">{{ __('tutor.Select_Price') }}</option>
                           @foreach( $getprice as $value_p )
                           <option {{ (Request::get('price_id') == $value_p->id) ? 'selected' : '' }} value="{{ $value_p->id}}">&#36;{{ $value_p->min_price }} - &#36;{{ $value_p->max_price }}</option>
                          @endforeach
                        </select>
                     </div>
                     <div class="input-group">
                        

                        <div class="form-group">
                          <label for="subject-multi">{{ __('tutor.Select_Category') }}</label>
                          <select name="category_id" class="subject-multi form-control">
                              <option value="">{{ __('tutor.Select_Category') }}</option>
                               @foreach ($getcategory as $value_ca)
                              <option {{ (Request()->category_id == $value_ca->id) ? 'selected' : '' }} value="{{ $value_ca->id }}">{{ $value_ca->getcategoryname() }}</option>
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
                           <label for="lang-multi">{{ __('tutor.Course_Title') }}</label>
                           <input type="text" name="course_title" value="{{ Request()->course_title }}" class="form-control" placeholder="{{ __('tutor.Enter_a_name') }}" style="width: 140px;height: 35px;">
                         </div> 
                       

                      </div>
                     <button type="submit" class="multi-search-submit d-inline-flex align-items-center justify-content-between">
                        <span class="btn-text">{{ __('tutor.Search') }}</span>
                        <i class="fas fa-search"></i>
                     </button>

                       <a href="{{ url('tutor/course') }}" class="multi-search-submit d-inline-flex align-items-center justify-content-between" style="margin-left: 10px;color: #fff;">{{ __('tutor.Reset') }}</a>

                       
                  </form>
               </div>
            </div>
         </div>
      </div>
   </div>
   <!-- end: request filter/breadcrumb area -->




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
                         <th>{{ __('tutor.Course_ID') }}</th>
                         <th>{{ __('tutor.Image') }}</th>
                         <th>{{ __('tutor.Course_Title') }}</th>
                         <th>{{ __('tutor.Category') }}</th>
                         <th>{{ __('tutor.Language') }}</th>
                         <th>{{ __('tutor.Price_For_Each_Lesson') }} </th>
                         <th>{{ __('tutor.Status') }}</th>
                         <th>{{ __('tutor.Action') }}</th>
                      </tr>
                   </thead>
                           <tbody>
                              @forelse ($getrecord as $value)
                              <tr class="single-course-item">
                                 <td>{{ $value->id }}</td>
                                 <td>                            
                                    @if(!empty($value->image) && file_exists('upload/course/'.$value->image) )
                                    <img style="height: 100px;" src="{{ url('upload/course/'.$value->image) }}" alt="tutor-image">
                                    @endif
                                 </td>
                                 <td>{{ $value->course_title }}</td>
                                 <td>{{ ucfirst(!empty($value->getcategory->category_name)?$value->getcategory->category_name: '') }}</td>
                                 <td>{{ ucfirst(!empty($value->getlanguage->language_name)?$value->getlanguage->language_name: '') }}</td>
                                 <td>${{ $value->lesson_per_rate }}</td>
                                 <td>
                                      @if($value->status == 1)
                                        <span>{{ __('tutor.Pending') }}</span>
                                      @elseif($value->status == 2) 
                                        <span style="color: green">{{ __('tutor.Approved') }}</span>
                                      @elseif($value->status == 3)
                                        <span style="color: red">{{ __('tutor.Rejected') }}</span>
                                      @endif
                                 </td>

                                 <td class="action" data-title="Action">
                                    <span class="action-btn-wrap">

                                        <a href="{{ url('tutor/course/view/'.$value->id) }}" class="btn btn-success"><i class="far fa-eye"></i></a>

                                        <a href="{{ url('tutor/course/edit/'.$value->id) }}" class="btn btn-primary"> <i class="fas fa-edit"></i></a>
                                        @if(!empty($value->course_video))
                                        <a href="{{ url('upload/course/'.$value->course_video) }}" target="_blank" class="button video-btn"><img src="{{ url('assets/img/iconic-video-recorder.png') }}" alt="video-icon"></a>
                                        @endif

                                        <button onclick="delete_record('{{ url('tutor/course/delete/'.$value->id) }}')" class="btn btn-danger"><i class="far fa-trash-alt"></i></button>
                                        
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
                        <div style="float: right">
                           {{ $getrecord->appends(Illuminate\Support\Facades\Input::except('page'))->links() }}
                        </div>
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
<script type="text/javascript">
 

</script>
@endsection
