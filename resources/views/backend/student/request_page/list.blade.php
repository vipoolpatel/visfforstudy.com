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
                  <h3 class="page-title breadcrumb-trail"> {{ __('student.Request_List') }}</h3>
                  <div class="status-search">
                     <p class="status-text">
                        <a href="{{ url('student/request-add') }}" style="margin-left: 10px;" class="btn btn-danger">
                          {{ __('student.Add_new_Request') }}
                        </a>
                     </p>
                  </div>
               </div>
            </div>
            <div class="col-12 col-lg-auto col-xl-auto flex-lg-fill">
               <div class="find-multi-search-box">
                  <form action="" id="filter-form" method="get" class="multi-search-form d-flex align-items-end justify-content-end">
                     
                     

                     <div class="form-group price-filter-box">
                        <label for="price-count">{{ __('student.Price') }}</label>
                        <select name="price_id" id="price-count" class="price-count form-control">
                           <option value="">{{ __('student.Select_Price') }}</option>
                           @foreach($getprice as $value_p)
                           <option {{ (Request::get('price_id') == $value_p->id) ? 'selected' : '' }} value="{{ $value_p->id }}">&#36;{{ $value_p->min_price }} - &#36;{{ $value_p->max_price }}</option>
                        @endforeach
                        </select>
                     </div>
                     <div class="input-group">
                        <div class="form-group">
                          <label for="lang-multi">{{ __('student.Select_Type') }}</label>
                          <select name="request_type_id" class="lang-multi form-control">
                            <option value="">{{ __('student.Type') }}</option>
                            @foreach ($getrequesttype as $value_ty)
                              <option {{ (Request()->request_type_id == $value_ty->id) ? 'selected' : '' }} value="{{ $value_ty->id }}">{{ $value_ty->getrequesttypename() }}</option>
                            @endforeach
                          </select>
                        </div> 

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
                          <label for="level-multi">{{ __('student.Select_Level') }}</label>
                          <select name="level_of_student_id" class="level-multi form-control">
                            <option value="">{{ __('student.Select_Level') }}</option>
                              @foreach ($getlevel as $value_level)
                              <option {{ (Request()->level_of_student_id == $value_level->id) ? 'selected' : '' }} value="{{ $value_level->id }}">{{ $value_level->getlevelofstudentname() }}</option>
                              @endforeach
                          </select>
                        </div>

                        <div class="form-group">
                           <label for="lang-multi">{{ __('student.Request_Title') }}</label>
                           <input type="text" name="request_title" value="{{ Request()->request_title }}" class="form-control" placeholder="{{ __('student.Enter_a_name') }}" style="width: 140px;height: 35px;">
                         </div> 
                       

                      </div>
                     <button type="submit" class="multi-search-submit d-inline-flex align-items-center justify-content-between">
                        <span class="btn-text">{{ __('student.Search') }}</span>
                        <i class="fas fa-search"></i>
                     </button>

                      <a href="{{ url('student/request-page') }}" class="multi-search-submit d-inline-flex align-items-center justify-content-between" style="margin-left: 10px;color: #fff;">{{ __('student.Reset') }}</a>

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
        <section class="total-request-section all-course-section">
          <div class="all-course-view">
            <div class="course-tabulation w-100">
              
              <div class="tab-content all-course-list-box">
        
                  <table class="all-course-table">
                    <thead>
                      <tr class="course-list-heading">
                        <th>{{ __('student.ID') }}</th>
                        <th>{{ __('student.Title') }}</th>
                        <th>{{ __('student.Request_Type') }}</th>
                        <th>{{ __('student.Category') }}</th>
                        <th>{{ __('student.Level_of_Student') }}</th>
                        <th>{{ __('student.Price_For_Each_Lesson') }}</th>
                        <th>{{ __('student.Date') }}</th>
                        <th>{{ __('student.Time') }}</th>
                        <th>{{ __('student.Duration') }}</th>
                        <th>{{ __('student.Status') }}</th>
                        <th class="action">{{ __('student.Action') }}</th>
                      </tr>
                    </thead>

                    <tbody>
                      @forelse($getrecord as $value)

                      <tr class="single-course-item">
                        <td>{{ $value->id }}</td>
                                    <td>{{ $value->request_title }}</td>
                                    <td>{{ ucfirst(!empty($value->getrequesttype->request_type_name)?$value->getrequesttype->request_type_name: '') }}</td>
                                    <td>{{ ucfirst(!empty($value->getcategory->category_name)?$value->getcategory->category_name: '') }}</td>
                                    <td>{{ ucfirst(!empty($value->getlevelofstudent->level_of_student_name)?$value->getlevelofstudent->level_of_student_name: '') }}</td>
                                    <td>{{ $value->rate_per_hour }}</td>
                                    <td>{{ $value->lesson_start_date }}</td>
                                    <td>{{ date('h:i A',strtotime($value->lesson_start_time)) }}</td>
                                    <td>{{ $value->duration }}</td>
                                    <td>
                                       @if($value->status == 1)
                                          <span>{{ __('student.Pending') }}</span>
                                       @elseif($value->status == 2) 
                                          <span style="color: green">{{ __('student.Approved') }}</span>
                                       @elseif($value->status == 3)
                                          <span style="color: red">{{ __('student.Rejected') }}</span>
                                       @endif
                                    </td>
                        <td class="action" data-title="Action">       
                          <span class="action-btn-wrap">
                            
                             <a href="{{ url('student/request-page/view/'.$value->id) }}" class="btn btn-success"><i class="far fa-eye"></i></a>
                             
                            <a href="{{ url('student/request-page/edit/'.$value->id) }}" class="btn btn-primary">
                            <i class="fas fa-edit"></i>
                           </a>

                            <button onclick="delete_record('{{ url('student/request-page/delete/'.$value->id) }}')" class="btn btn-danger"><i class="far fa-trash-alt"></i></button>

                          </span>
                       </td>
                      </tr>
                      @empty
                      <tr class="single-course-item">
                          <td colspan="100%">{{ __('student.Record_not_found') }}</td>
                      </tr>
                      @endforelse                     
                    </tbody>
                  </table>
                  
                   <div style="float: right;margin-top: 20px;">
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
<script type="text/javascript">
</script>

@endsection
