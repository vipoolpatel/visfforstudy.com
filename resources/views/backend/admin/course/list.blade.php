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
            <h3 class="page-title breadcrumb-trail"> {{ __('admin.Course_List') }}</h3>
            
          </div>
        </div>
        <div class="col-12 col-lg-auto col-xl-auto flex-lg-fill">
          <div class="find-multi-search-box">
            <form action="" method="get" id="filter-form" class="multi-search-form d-flex align-items-end justify-content-end">
             
             <div class="form-group price-filter-box">
              <label for="price-count">{{ __('admin.Price') }}</label>
              <select name="price_id" id="price-count" class="price-count form-control">
                 <option value="">{{ __('admin.Select_Price') }}</option>
                  @foreach($getprice as $value_p)
                    <option {{ (Request::get('price_id') == $value_p->id) ? 'selected' : '' }} value="{{ $value_p->id }}">&#36;{{ $value_p->min_price }} - &#36;{{ $value_p->max_price }}</option>
                  @endforeach
              </select>
           </div>
              <div class="input-group">
                 <div class="form-group">
                          <label for="subject-multi">{{ __('admin.Select_Subject') }}</label>
                          <select name="category_id" class="subject-multi form-control">
                              <option value="">{{ __('admin.Subject') }}</option>
                               @foreach ($getcategory as $value_ca)
                              <option {{ (Request()->category_id == $value_ca->id) ? 'selected' : '' }} value="{{ $value_ca->id }}">{{ $value_ca->category_name }}</option>
                              @endforeach
                          </select>
                        </div>
                      <div class="form-group">
                          <label for="lang-multi">{{ __('admin.Select_Language') }}</label>
                          <select name="language_id" class="lang-multi form-control">
                            <option value="">{{ __('admin.Language') }}</option>
                            @foreach ($getlanguge as $value_l)
                              <option {{ (Request()->language_id == $value_l->id) ? 'selected' : '' }} value="{{ $value_l->id }}">{{ $value_l->language_name }}</option>
                            @endforeach
                          </select>
                        </div>
                <div class="form-group">
                  <label for="lang-multi">{{ __('admin.Course_Title') }}</label>
                <input type="text" name="course_title" value="{{ Request()->course_title }}" class="form-control" style="height: 35px;" placeholder="{{ __('admin.Enter_a_name') }}">
                </div>
              </div>
              <button type="submit" class="multi-search-submit d-inline-flex align-items-center justify-content-between">
                <span class="btn-text">{{ __('admin.Search') }}</span>
                <i class="fas fa-search"></i>
              </button>
               <a href="{{ url('admin/course') }}" class="multi-search-submit d-inline-flex align-items-center justify-content-between" style="margin-left: 10px;color: #fff;">{{ __('admin.Reset') }}</a>
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
               @include('message')
               <div class="all-course-view">
                  <div class="course-tabulation w-100">
                     <div class="tab-content all-course-list-box">
                        <table class="all-course-table">
                           <thead>
                              <tr class="course-list-heading">
                                 <th>{{ __('admin.ID') }}</th>
                                 <th>{{ __('admin.Teacher_Name') }}</th>
                                {{--  <th>Image</th> --}}
                                 <th>{{ __('admin.Course_Title') }}</th>
                                 <th>{{ __('admin.Category') }}</th>
                                 <th>{{ __('admin.Language') }}</th>
                                 <th>{{ __('admin.Price_For_Each_Lesson') }}</th>
                                 <th>{{ __('admin.Status') }}</th>
                                 <th>{{ __('admin.Action') }}</th>
                              </tr>
                           </thead>
                           <tbody>
                              @forelse ($getrecord as $value)
                              <tr class="single-course-item">
                                 <td>{{ $value->id }}</td>
                                 <td>
{{ ucfirst(!empty($value->getusers->name)?$value->getusers->name: '') }}
{{ ucfirst(!empty($value->getusers->last_name)?$value->getusers->last_name: '') }}                                   

                                 </td>
                                {{--  <td>                            
                                    @if(!empty($value->image) && file_exists('upload/course/'.$value->image) )
                                    <img style="height: 100px;" src="{{ url('upload/course/'.$value->image) }}" alt="tutor-image">
                                    @endif
                                 </td> --}}
                                 <td>{{ $value->course_title }}</td>
                                 <td>{{ ucfirst(!empty($value->getcategory->category_name)?$value->getcategory->category_name: '') }}</td>
                                 <td>{{ ucfirst(!empty($value->getlanguage->language_name)?$value->getlanguage->language_name: '') }}</td>
                                 <td>${{ $value->lesson_per_rate }}</td>
   <td>
        <select class="form-control ChangeStatus" id="{{ $value->id }}" style="width: 150px;">
          <option value="1" <?=($value->status == '1') ? 'selected' : '' ?>>{{ __('admin.Pending') }}</option>
          <option value="2" <?=($value->status == '2') ? 'selected' : '' ?>>{{ __('admin.Approved') }}</option>
          <option value="3" <?=($value->status == '3') ? 'selectde' : '' ?>>{{ __('admin.Rejected') }}</option>
        </select>
   </td>

                                 <td class="action" data-title="Action">
                                    <span class="action-btn-wrap">

                                        <a href="{{ url('admin/course/view/'.$value->id) }}" class="button view-btn"><i class="far fa-eye"></i></a>


                                        <a href="{{ url('upload/course/'.$value->course_video) }}" target="_blank" class="button video-btn"><img src="{{ url('assets/img/iconic-video-recorder.png') }}" alt="video-icon"></a>

                                        

                                         <a onclick="delete_record('{{ url('admin/course/delete/'.$value->id) }}')" class="button trash-btn"><i class="far fa-trash-alt"></i></a>


                                        
                                    </span>

                                 </td>

                              </tr>
                              @empty
                              <tr  class="single-course-item">
                                 <td colspan="100%">{{ __('admin.Record_not_found') }}</td>
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
         </div>
      </div>
   </div>
</div>
@endsection

@section('script')
  <script>


   
    $('.ChangeStatus').change(function(){
       var id = $(this).attr('id');
       var status = $(this).val();
       $.ajax({
          type: 'GET',
          url:"{{url('admin/course/change_status')}}",
          data: {id:id,status:status},
          dataType: 'JSON',
          success:function(data){
            alert(data.success);
          }
       });
    });
  </script>
@endsection
