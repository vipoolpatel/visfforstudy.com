@extends('backend.layouts.app')
@section('style')
<style type="text/css">
      .all-course-table tr > th {
            text-align: left;
      }
      .all-course-table tr > td {
            text-align: left;
      }
</style>
@endsection 
@section('content')
<!-- start: breadcrumb area -->



<div class="request-filter-area breadcrumb-area">
   <div class="container">
      <div class="row align-items-end justify-content-between flex-lg-nowrap">
         <div class="col-12 col-lg-auto col-xl-auto flex-grow-1 mb-3 mb-lg-0">
            <div class="title-and-status d-md-flex justify-content-between justify-content-lg-start align-items-center">
               <h3 class="page-title breadcrumb-trail">{{ __('admin.Offer_List') }}</h3>
               
            </div>
         </div>
         <div class="col-12 col-lg-auto col-xl-auto flex-lg-fill">
            <div class="find-multi-search-box">
               <form action="" id="filter-form" method="get" class="multi-search-form d-flex align-items-end justify-content-end">
                
          
                  <div class="form-group price-filter-box">
                     <label for="price-count">{{ __('admin.Price') }}</label>
                     <select  name="price_id" id="price-count" class="price-count form-control">
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
                           <option {{ (Request()->category_id == $value_ca->id) ? 'selected' : '' }} value="{{ $value_ca->id }}">{{ $value_ca->getcategoryname() }}</option>
                           @endforeach
                       </select>
                     </div>
                      <div class="form-group">
                       <label for="lang-multi">{{ __('admin.Select_Language') }}</label>
                       <select name="language_id" class="lang-multi form-control">
                         <option value="">{{ __('admin.Language') }}</option>
                         @foreach ($getlanguge as $value_l)
                           <option {{ (Request()->language_id == $value_l->id) ? 'selected' : '' }} value="{{ $value_l->id }}">{{ $value_l->getlanguagename() }}</option>
                         @endforeach
                       </select>
                     </div>
                     <div class="form-group">
                       <label for="level-multi">{{ __('admin.Select_Level') }}</label>
                       <select name="level_id" class="level-multi form-control">
                         <option value="">{{ __('admin.Select_Level') }}</option>
                           @foreach ($getlevel as $value_level)
                           <option {{ (Request()->level_id == $value_level->id) ? 'selected' : '' }} value="{{ $value_level->id }}">{{ $value_level->getlevelofstudentname() }}</option>
                           @endforeach
                       </select>
                     </div>   

                     <div class="form-group">
                        <label for="level-multi">{{ __('admin.Select_Status') }}</label>
                        <select name="status" class="level-multi form-control">
                          <option value="">{{ __('admin.Select_Status') }}</option>
                          @foreach ($getstatus as $value_s)
                          <option {{ (Request()->status == $value_s->id) ? 'selected' : '' }} value="{{ $value_s->id }}">{{ $value_s->getstatusname() }}</option>
                          @endforeach
                        </select>
                      </div>

                      <div class="form-group">
                        <label for="level-multi">{{ __('admin.Title') }}</label>
                        <input type="text" name="title" value="{{ Request()->title }}" class="form-control" placeholder="{{ __('admin.Enter_a_name') }}" style="width: 174px;height: 35px;">
                     </div>
                    

                   </div>
                  <button type="submit" class="multi-search-submit d-inline-flex align-items-center justify-content-between">
                     <span class="btn-text">{{ __('admin.Search') }}</span>
                     <i class="fas fa-search"></i>
                  </button>

                  <a href="{{ url('admin/offer') }}" class="multi-search-submit d-inline-flex align-items-center justify-content-between" style="margin-left: 10px;color: #fff;">{{ __('admin.Reset') }}</a>
               </form>
            </div>
         </div>
      </div>
   </div>
</div>
<!-- end: breadcrumb area -->
<!-- start: main content -->
<div class="main-content withdraw-request-content">
   <div class="container">
      <div class="row">
         <div class="col-12">
            <!-- start: all offer content -->
            <section class="all-withdraw-request-section all-offer-section">
               <div class="all-course-view all-withdraw-request">
                  <div class="course-tabulation w-100">
                     <div class="tab-content all-course-list-box">
                        {{-- Start --}}
                        <div class="tab-pane in active pending-withdraw" style="overflow: auto;">
                           <table class="all-course-table">
                              <thead>
                                 <tr class="course-list-heading">
                                    <th>{{ __('admin.ID') }}</th>
                                    <th>{{ __('admin.Teacher_Name') }}</th>
                                    <th>{{ __('admin.Student_Name') }}</th>
                                    <th>{{ __('admin.Title') }}</th>
                                    <th>{{ __('admin.Subject') }}</th>
                                    <th>{{ __('admin.Level') }}</th>
                                    <th>{{ __('admin.Language') }}</th>
                                    <th>{{ __('admin.Lesson_Date_Time') }}</th>
                                    <th>{{ __('admin.Duration') }}</th>
                                    <th>{{ __('admin.Price') }} </th>
                                    <th>{{ __('admin.Status') }}</th>
                                    <th>{{ __('admin.Created_Date') }}</th>
                                    <th>{{ __('admin.Action') }}</th>
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
                                       <span class="name">
                                       {{ ucfirst(!empty($value->getusers->name)?$value->getusers->name: '') }}
                                       {{ ucfirst(!empty($value->getusers->last_name)?$value->getusers->last_name: '') }}
                                       </span>
                                       </span>
                                    </td>
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
                                    <td>{{ $value->title }}  </td>
                                    <td>{{ ucfirst(!empty($value->getcategory->category_name)?$value->getcategory->category_name: '') }}</td>
                                    <td>{{ ucfirst(!empty($value->getlevel->level_of_student_name)?$value->getlevel->level_of_student_name: '') }}</td>                                  
                                    <td>{{ ucfirst(!empty($value->getlanguage->language_name)?$value->getlanguage->language_name: '') }}</td>
                                    <td>{{ $value->start_date }} - {{ date('h:i A', strtotime($value->start_time)) }}</td>
                                    <td>{{ $value->duration }} {{ __('admin.Minutes') }}</td>
                                    <td>${{ $value->lesson_per_rate }}</td>

                                    <td>
                                    <select class="form-control ChangeRequestStatus" id="{{ $value->id }}" style="width: 150px;">
                                       @foreach ($getstatus as $value_s)
                                       <option {{ ($value_s->id == $value->status) ? 'selected' : '' }} value="{{ $value_s->id }}">{{ $value_s->getstatusname() }}</option>
                                       @endforeach
                                    </select>
                                    </td>
                                    <td>{{ date('d-m-Y h:i A', strtotime($value->created_at)) }}</td>
                                    

                                    <td class="action" data-title="Action">
                                       <span class="action-btn-wrap">
                                          <a href="{{ url('admin/offer/view/'.$value->id) }}" class="button view-btn"><i class="far fa-eye"></i></a>

                                          <a onclick="delete_record('{{ url('admin/offer/delete/'.$value->id) }}')" class="button trash-btn"><i class="far fa-trash-alt"></i></a>

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
                        {{-- End --}}
                     </div>
                  </div>
               </div>
            </section>
            <!-- end: all offer content -->
         </div>
      </div>
   </div>
</div>

@endsection

@section('script')
<script type="text/javascript">



   $('.ChangeRequestStatus').change(function(){
      var id = $(this).attr('id');
      var status = $(this).val();
      $.ajax({
         type: 'GET',
         url:"{{url('admin/offer/change_offer_status')}}",
         data: {id:id,status:status},
         dataType: 'JSON',
         success:function(data){
           alert(data.success);
         }
      });
   });
</script>
@endsection
